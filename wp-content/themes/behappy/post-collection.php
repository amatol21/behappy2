<?php
/*
Template Name: Збір
Template post type: post
*/

get_header(); 

$collection_post_id = $post->ID;
$collection_post_author = $post->post_author;
//$collection_qr_raw_data = get_post_meta( $collection_post_id, 'collection_qr_url_100_uah', true );
//debug($collection_post_id);

function receive_new_qr($collection_post_id){
		
	function post_service($collection_post_id){

		$transaction_number = (int) get_option( 'transaction_number');
		update_option('transaction_number', ++$transaction_number);
		$time = time();
		$wfp_key = get_option('wfp_key');
	
		$sign = hash_hmac('md5', "behappyua_com;{$_SERVER["HTTP_HOST"]};qr100_{$collection_post_id}_{$transaction_number};$time;1;UAH;collection_$collection_post_id;1;1", $wfp_key);
		return [
			'transaction_number' => $transaction_number,
			'time' => $time,
			'sign' => $sign
		];
	}
	
	$collection_service = post_service($collection_post_id);
	//debug($collection_service ); 
	
	$collection_ch = curl_init();
	$collection_params = [
		'transactionType' => "CREATE_QR",
		'merchantAccount' => 'behappyua_com',
		'merchantAuthType' => 'SimpleSignature',
		'merchantDomainName' => $_SERVER["HTTP_HOST"],
		'apiVersion' => 1,
		'orderReference' => "qr100_{$collection_post_id}_{$collection_service['transaction_number']}",
		'orderDate' => $collection_service['time'],
		'amount' =>  1,
		'currency' => 'UAH',
		'orderTimeout' => 14400,
		'productName' => ["collection_$collection_post_id"],
		'productPrice' => ['1'],
		'productCount' => ['1'],
		'merchantSignature' => $collection_service['sign'],
		'returnUrl' => get_page_link( 524) 
	];
	//debug($collection_params);
	
	curl_setopt($collection_ch, CURLOPT_URL, "https://api.wayforpay.com/api");
	curl_setopt($collection_ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	curl_setopt($collection_ch, CURLOPT_POST, 1);
	curl_setopt($collection_ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($collection_ch, CURLOPT_CONNECTTIMEOUT, 3);
	curl_setopt($collection_ch, CURLOPT_POSTFIELDS, json_encode($collection_params));
	
	$collection_response = curl_exec($collection_ch);
	$collection_result = json_decode($collection_response);
	dump($collection_result);
	curl_close($collection_ch); 

	if(!empty($collection_result) && !empty($collection_result->imageUrl)){
		//$collection_new_data = serialize(['qr' => $collection_result->imageUrl, 'change_time' => ($collection_service['time'] + 2500000)]);
		//update_post_meta( $collection_post_id, 'collection_qr_url_100_uah', $collection_new_data);
		//$collection_qr_url = $collection_result->imageUrl;

		return $collection_result->imageUrl;
	}
}

	$collection_qr_url = receive_new_qr($collection_post_id);


?>

    
    <section class="page-banner page-banner-small">
        <div class="bottom-rotten-curve"></div>

        <div class="auto-container">
            <h1><?= the_field('acf_collection_title'); ?></h1>
        </div>
    </section>


	<section class="collection-section">		
		<div class="auto-container">
			<h2 class="collection-header">
				<?php 
					if(!empty(get_user_meta( $collection_post_author, 'collection_title', true))){
						echo get_user_meta( $collection_post_author, 'collection_title', true);
					}
				 ?>
			</h2>
			<div class="collection-content">

				
			
				<?php 
					the_content(); 
					
					$collection_img_id_array = $wpdb->get_results( 
					"SELECT ID FROM $wpdb->posts  
					WHERE $wpdb->posts.post_author = $collection_post_author 
					AND $wpdb->posts.post_mime_type 
					IN ('image/jpeg', 'image/jpg', 'image/jpe', 'image/gif', 'image/png', 'image/bmp', 'image/webp')", 
					ARRAY_A);
				
					if(!empty($collection_img_id_array)){ ?>
						<br>
						<section class="splide collection-splide" aria-label="Splide Basic HTML Example">
							<div class="splide__track">
									<ul class="splide__list">
										<?php 
											foreach($collection_img_id_array as $elem){?> 
												<li class="splide__slide" style="display:flex; justify-content: center;">
													<?= the_attachment_link( ((int)$elem['ID']), true, [], true); ?>
												</li>
										<?php } ?>
									</ul>
							</div>
						</section>
				<?php } 
				
					$collection_youtube_link = get_user_meta( $collection_post_author, 'youtube', true );
					if(!empty($collection_youtube_link)){
						$collection_youtube_link_part = strchr($collection_youtube_link, '?v=');
						$collection_youtube_pure_link_part = substr_replace($collection_youtube_link_part, '', 0, 3); 
				?>

						<h3 class="collection-secondary-header">Відео установи</h3>
						<div class="collection-video">
							
							<iframe src="https://www.youtube.com/embed/<?= $collection_youtube_pure_link_part ?>?si=" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
						</div>
				<?php } ?>
				
				<h3 class="collection-secondary-header">Сума зборів</h3>
				<div class="collection-amount-content">
					<p class="collection-goal">
						<?php if(!empty(get_user_meta( $collection_post_author, 'collection_amount', true))) {?>
							<span class="collection-text">Потрібно зібрати: &nbsp;&nbsp;<strong><?= number_format(get_user_meta( $collection_post_author, 'collection_amount', true), 0, ',', ' '); ?> грн. </strong></span> 
						<?php } ?>
					</p>
					<p class="collection-have">
						<span class="collection-text">Зараз зібрано: &nbsp;&nbsp;<strong><?= number_format(get_post_meta( $collection_post_id, 'collection_amount_collected', true), 0, ',', ' '); ?> грн. </strong></span>
					</p>
				</div>

				<?php if(!empty($collection_qr_url)){ ?>
					<h3 class="collection-secondary-header">Швидко пожертвувати 100 грн.</h3>
					<div class="collection-content">
						Ви можете зробити швидку пожертву за допомогою мобільного додатку 
						<a href="https://qr.wayforpay.com/" class="collection-link" alt="mobile app link">wayforpay.qr</a>. Для цього вам потрібно лише навести qr-сканер додатку на qr-код. <br><br> 

						<img class="collection-qr" src="<?= $collection_qr_url ?>" alt="payment qr-code">
					</div>
				<?php } ?> 
			</div>
			
		</div>
	</section>

	


<?php 

get_footer(); ?>



