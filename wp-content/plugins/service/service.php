<?php 
//

/*
 * Plugin Name: Service
 * Description: Додаткові налаштування для власника
 * Version: 1.0
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 *
 */

require_once (__DIR__ .'/../../../vendor/autoload.php');
session_start();

add_action( 'admin_menu', 'service_menu_page', 25 );

function service_menu_page(){

	add_menu_page(
		'Додаткові налаштування',
		'Додатково',
		'edit_pages',
		'service_page',
		'service_menu_working',
		'dashicons-admin-page',
		98
	);
}
 
function service_menu_working(){
	
	global $wpdb;

	//dump($_SESSION);
	//dump($_POST);

	if(!empty($_POST['daterange']) && !empty($_POST['daterange_choose'])){				// выбрать даты
		$date = explode(' - ', esc_sql(sanitize_text_field($_POST['daterange'])));
		$date_from = $_SESSION['date_from'] = $date[0];
		$date_to = $_SESSION['date_to'] = $date[1];
		unset($_SESSION['current_page']);
		//dump( $date[0]);
		//dump( $date[1]);
	} elseif(empty($_POST['daterange_choose']) && !empty($_SESSION['date_from']) && !empty($_SESSION['date_to'])){
		$date_from = $_SESSION['date_from'];
		$date_to = $_SESSION['date_to'];
	} else{
		$today = time();
		$yesterday = $today - 86400;
		$today = date('Y-m-d');
		$yesterday = date('Y-m-d', $yesterday);
		
		$date_from = $yesterday;
		$date_to = $today;
	}
	
	//dump($_POST['elements_number']);

	if(!empty($_POST['elements_number'])){									// выбрать количество элементов 
		$_SESSION['elements_number'] = $_POST['elements_number'];	// на странице для таблицы
	} elseif(empty($_SESSION['elements_number'])){
		$_SESSION['elements_number'] = 10;
	}

	if($_SESSION['elements_number'] == 10){
		$button_number = 0;
	} elseif($_SESSION['elements_number'] == 20){
		$button_number = 1;
	} elseif($_SESSION['elements_number'] == 50){
		$button_number = 2;
	}

	//dump($_SESSION['elements_number']);



	if(!empty($_POST) && !empty($_POST["payment_id"])){			// удалить заявку на фото и 
		// отметка, что фото отправлено
		wp_update_post( [
		'ID' => $_POST["payment_id"],
		'post_excerpt' => 'finished'
		]);
	}



	$admin_payments_for_picture_arr = $wpdb->get_results( "SELECT * FROM $wpdb->posts WHERE post_title IN ('donate', 'donate_fee') AND post_status = 'paid' AND post_type = 'payment' AND post_date >= '$date_from' AND post_date < '$date_to'", ARRAY_A); 
	//dump($admin_payments_for_picture_arr);



	$elements_on_page = (int) $_SESSION['elements_number'];				// сформировать массив данных для выдачи
	$elements_on_this_page = 1;
	$page_number = 1;
	$all_pages_elements = [];

	//dump($elements_on_page);

	while(count($admin_payments_for_picture_arr) > 0){

		if($elements_on_this_page > $elements_on_page){
			++$page_number;
			$elements_on_this_page = 1;
		}

		$all_pages_elements[$page_number][$elements_on_this_page] = array_shift($admin_payments_for_picture_arr);
		++$elements_on_this_page;
	}
	//dump($all_pages_elements);

	if(!empty($_POST['page']) && ($_POST['page'] > 0) && ($_POST['page'] <= $page_number)){
		//dump($_POST['page']);
		$current_page = (int) $_POST['page'];
	} elseif(!empty($_POST['page']) && ($_POST['page'] <= 0)){
		$current_page = 1; 
	} elseif(!empty($_POST['page']) && ($_POST['page'] > $page_number)){
		$current_page = $page_number;
	} else {
		$current_page = $_SESSION['current_page'] ?? 1;
	}

	//dump($current_page);

	$previous_page = $next_page = $_SESSION['current_page'] = $current_page;
	$previous_page--;
	$next_page++;
	//dump($previous_page);
	//dump($_SESSION['current_page']);
	//dump($next_page);

	
	
	
	?>
		<br>
		<div class="wrap">
			<form action="<?= content_url(); ?>/plugins/service/add_info.php" class="service" method="POST"> 
				<h2>Номер телефону та email - відображається в заголовку та підвалі сайту.</h2>
				<table class="form-table">
					<tbody>
						<tr>
							<th><label for="service-phone">Номер телефона: </label></th>
							<td><input id="service-phone" type="text" class="regular-text" name="service-phone" value="<?= get_user_meta( 1, 'service_phone', true );?>"></td> 
						</tr>
						<tr>
							<th><label for="service-email">Адреса електронної пошти: </label></th>
							<td><input id="service-email" type="text" class="regular-text" name="service-email" value="<?= get_user_meta( 1, 'service_email', true );?>"></td>
						</tr>
					</tbody>
				</table>
				<br>
				<h2>Вартість поштової доставки малюнка (грн.) - відображається на сторінці малюнку.</h2>
				<table class="form-table">
					<tbody>
					<tr>
							<th><label for="service-fee-europe">Вартість для України (грн.): </label></th>
							<td><input id="service-fee-europe" type="number" min="0" class="regular-text" name="service-fee-ukraine" value="<?= get_user_meta( 1, 'service-fee-ukraine', true );?>"></td>
						</tr>
						<tr>
							<th><label for="service-fee-europe">Вартість для Європи (грн.): </label></th>
							<td><input id="service-fee-europe" type="number" min="0" class="regular-text" name="service-fee-europe" value="<?= get_user_meta( 1, 'service-fee-europe', true );?>"></td>
						</tr>
						<!--<tr>
							<th><label for="service-fee-asia">Вартість для Азії: </label></th>
							<td><input id="service-fee-asia" type="number" min="0" class="regular-text" name="service-fee-asia" value="<?= get_user_meta( 1, 'service-fee-asia', true );?>"></td>
						</tr>-->
						<tr>
							<th><label for="service-fee-america">Вартість для Америки (грн.): </label></th>
							<td><input id="service-fee-america" type="number" min="0" class="regular-text" name="service-fee-america" value="<?= get_user_meta( 1, 'service-fee-america', true );?>"></td>
						</tr>
					</tbody>
				</table>
				<p class="submit">
					<button class="button button-primary" type="submit">Оновити дані</button>
				</p>
			</form>
		</div>
		<br>


		<br><br>
		<h2>Перелік людей, що зробили пожертву.</h2>
		<form action="" method="POST" class="admin-users__pages-buttons-container">
			<div class="admin-users__choose-page">
				<button type="submit" name="page" value="<?= $previous_page; ?>" class="admin-users__pages-button">Назад</button>

				<?php if($page_number <= 3){
					for($i = 1; $i <= $page_number; $i++){ 
						if($i === $current_page){ ?>

							<button type="button" class="admin-users__pages-button__active"><?= $i ?></button>

						<?php } else{ ?>
							<button type="submit" name="page" value="<?= $i ?>" class="admin-users__pages-button"><?= $i ?></button>
						<?php }
					}
				} else{ ?>
					<button type="submit" name="page" value="1" class="admin-users__pages-button">Перша: 1</button>
					&nbsp;&nbsp;
					<button type="button" class="admin-users__pages-button__active"><?= $_SESSION['current_page']; ?></button>
					&nbsp;&nbsp;
					<button type="submit" name="page" value="<?= count($all_pages_elements); ?>" class="admin-users__pages-button">Остання: <?= count($all_pages_elements); ?></button>
				<?php } ?>
				<button type="submit" name="page" value="<?= $next_page; ?>" class="admin-users__pages-button">Далі</button>
			</div>

			<div class="admin-users__pages-elements">
				<button class="admin-users__pages-button elements_number" value="10" name="elements_number">10</button>
				<button class="admin-users__pages-button elements_number" value="20" name="elements_number">20</button>
				<button class="admin-users__pages-button elements_number" value="50" name="elements_number">50</button>
			</div>

			<div class="admin-users__dates-number">
				<input type="text" name="daterange" placeholder="Обрати дати" class="admin-users__daterange" value="<?php 
					if(!empty($date_from) && !empty($date_to)){
						echo "$date_from - $date_to";
					} 
				?>"/>
				<button type="submit" name="daterange_choose" value="true" class="admin-users__pages-button">Обрати дати</button>
			</div>
		</form>

		<div class="admin-users">
			<div class="admin-users__header admin-users__helper">
				<div class="admin-users__date admin-users__cell">Дата</div>
				<div class="admin-users__name admin-users__cell">Ім'я</div>
				<div class="admin-users__collection admin-users__cell">Збір</div>
				<div class="admin-users__picture admin-users__cell">Малюнок</div>
				<div class="admin-users__amount admin-users__cell">Пожертва / Збір</div>
				<div class="admin-users__contacts admin-users__cell">Контакти</div>
				<div class="admin-users__address admin-users__cell">Адреса</div>
				<div class="admin-users__actions admin-users__cell">Дії</div>
			</div>
			<div class="admin-users__row admin-users__helper">

				<?php 
				//dump($all_pages_elements);
				if(!empty($all_pages_elements[$current_page])){
					foreach($all_pages_elements[$current_page] as $elem){ 
							$data = unserialize($elem['post_content']);
						
					?>
						<form action="" method="POST" class="admin-users__row admin-users__helper" >
							<input type="hidden" name="payment_id" value="<?= $elem['ID']; ?>">
							<div class="admin-users__date admin-users__cell">
								<?php 
									$picked_date = explode(' ', $elem['post_date'])[0]; 
									echo $picked_date;
								?>
							</div>

							<div class="admin-users__name admin-users__cell">
								<?php if(!empty($data['name']) && !empty($data['lastname'])){ ?>
									<?= $data['name']; ?> <br>
									<?= $data['lastname']; ?> <br>
								<?php } else{
									echo '&mdash;';
								} ?>
							</div>

							<div class="admin-users__collection admin-users__cell">
								<a href="<?= get_page_link($data['collection']); ?>">
									<?= $data['collection']; ?>
								</a>
							</div>

							<div class="admin-users__picture admin-users__cell">
								<?php if(!empty($data['post_picture_id'])){ ?>
									<a href="<?= get_page_link( $data['post_picture_id']); ?>">
										<?= $data['post_picture_id']; ?>
									</a>
								<?php } else{
									echo '&mdash;';
								}?>

							</div>

							<div class="admin-users__amount admin-users__cell">
								<?= $data['donate_amount']; ?> грн.
								<?php if(!empty( $data['fee'])){ 
									echo "&nbsp;/&nbsp; {$data['fee']} грн.";
								} else{
									echo '&nbsp;/&nbsp; &mdash;';
								}?>
							</div>
							<div class="admin-users__contacts admin-users__cell">
								<?php if(!empty($data['phone']) && !empty($data['email'])) {
									echo "{$data['phone']} <br> {$data['email']}"; 
								} else{
									echo '&mdash;';
								}?>
							</div>
							<div class="admin-users__address admin-users__cell">
								<?php if(!empty($data['phone']) && !empty($data['email'])) {
									echo "{$data['address']}"; 
								} else{
									echo '&mdash;';
								}?>
							</div>
							<div class="admin-users__actions admin-users__cell">
								<?php if(!empty($data['post_picture_id']) && empty($elem['post_excerpt'])){ ?>
									<button type="submit" class="admin-users__sent__no" >Малюнок <br>не надіслано</button>
								<?php } elseif(!empty($data['post_picture_id']) && !empty($elem['post_excerpt'])) {?>
									<button type="button" class="admin-users__sent__yes">Малюнок <br>надіслано</button>
								<?php }?>
							</div>
						</form>

					<?php	} 
				}?>

			</div>
		</div>

		<form action="" method="POST" class="admin-users__pages-buttons-container">
		<div class="admin-users__choose-page">
				<button type="submit" name="page" value="<?= $previous_page; ?>" class="admin-users__pages-button">Назад</button>

				<?php if($page_number <= 3){
					for($i = 1; $i <= $page_number; $i++){ 
						if($i === $current_page){ ?>

							<button type="button" class="admin-users__pages-button__active"><?= $i ?></button>

						<?php } else{ ?>
							<button type="submit" name="page" value="<?= $i ?>" class="admin-users__pages-button"><?= $i ?></button>
						<?php }
					}
				} else{ ?>
					<button type="submit" name="page" value="1" class="admin-users__pages-button">Перша: 1</button>
					&nbsp;&nbsp;
					<button type="button" class="admin-users__pages-button__active"><?= $_SESSION['current_page']; ?></button>
					&nbsp;&nbsp;
					<button type="submit" name="page" value="<?= count($all_pages_elements); ?>" class="admin-users__pages-button">Остання: <?= count($all_pages_elements); ?></button>
				<?php } ?>
				<button type="submit" name="page" value="<?= $next_page; ?>" class="admin-users__pages-button">Далі</button>
			</div>

		</form>
		
		<script>
			let button_arr = document.querySelectorAll('.elements_number');
			button_arr[<?= $button_number; ?>].classList.add('admin-users__pages-button__active');
		</script>

	<?php 
 	}