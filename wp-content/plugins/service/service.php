<?php 

/*
 * Plugin Name: Service
 * Description: Додаткові налаштування для власника
 * Version: 1.0
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 *
 */

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

	if(!empty($_POST) && !empty($_POST["payment_id"])){

		wp_update_post( [
			'ID' => $_POST["payment_id"],
			'post_excerpt' => 'finished'
		]);
	
	}

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




 
		
 <?php 
	global $wpdb;

	$admin_payments_for_picture_arr = $wpdb->get_results( "SELECT * FROM $wpdb->posts WHERE post_title = 'donate_fee' AND post_status = 'paid' AND post_excerpt = ''", ARRAY_A); 
	//debug($admin_payments_for_picture_arr);

	
?>

		<br><br>
		<h2>Перелік людей, що зробили пожертву і хочуть отримати малюнок.</h2>

		<div class="admin-users">
			<div class="admin-users__header admin-users__helper">
				<div class="admin-users__name admin-users__cell">Ім'я</div>
				<div class="admin-users__collection admin-users__cell">Збір</div>
				<div class="admin-users__picture admin-users__cell">Малюнок</div>
				<div class="admin-users__amount admin-users__cell">Пожертва / Збір</div>
				<div class="admin-users__contacts admin-users__cell">Контакти</div>
				<div class="admin-users__address admin-users__cell">Адреса</div>
				<div class="admin-users__actions admin-users__cell">Дії</div>
			</div>
			<div class="admin-users__row admin-users__helper">

				<?php foreach($admin_payments_for_picture_arr as $elem){ 
					$data = unserialize($elem['post_content']);	
				?>

					<form action="" method="POST" class="admin-users__row admin-users__helper" >
						<input type="hidden" name="payment_id" value="<?= $elem['ID']; ?>">
						<div class="admin-users__name admin-users__cell">
							<?= $data['name']; ?> <br>
							<?= $data['lastname']; ?>
						</div>
						<div class="admin-users__collection admin-users__cell"><a href="<?= get_page_link($data['collection']); ?>"><?= $data['collection']; ?></a></div>
						<div class="admin-users__picture admin-users__cell">
							<a href="<?= get_page_link( $data['post_picture_id']); ?>"><?= $data['post_picture_id']; ?></a>
						</div>
						<div class="admin-users__amount admin-users__cell"><?= $data['donate_amount']; ?> грн. / <?= $data['fee']; ?> грн.</div>
						<div class="admin-users__contacts admin-users__cell">
							<?= $data['phone']; ?> <br>
							<?= $data['email']; ?>
						</div>
						<div class="admin-users__address admin-users__cell"><?= $data['address']; ?></div>
						<div class="admin-users__actions admin-users__cell"><button type="submit">Видалити</button></div>
					</form>


				<?php	} ?>

				
			</div>
		</div>



		

	<?php 
 	}