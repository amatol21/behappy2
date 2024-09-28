<?php
/*
Template Name: Після сплати
*/

//debug($_POST);

get_header(); 
//dump ($_POST);

if(!empty($_POST)){
	function sanitize_data(){

		foreach($_POST as $key => $value){
			$sanitized_key = esc_sql(sanitize_text_field($key));
			$sanitized_post[$sanitized_key] = esc_sql(sanitize_text_field($value));
		}

		//debug($sanitized_post);
	
		return $sanitized_post;
	}
	
	$after_payment_sanitized_post = sanitize_data();
	//dump($after_payment_sanitized_post);

	if(!empty($after_payment_sanitized_post['orderReference']) && !empty($after_payment_sanitized_post["transactionStatus"]) ){

		if($after_payment_sanitized_post["transactionStatus"] == 'Approved'){

			if(substr($after_payment_sanitized_post['orderReference'], 0, 6) == 'bhwad_'){
				
				//debug($after_payment_sanitized_post['orderReference']);
				$after_payment_payment_id = (int) str_replace('bhwad_', '', $after_payment_sanitized_post['orderReference']);
				wp_update_post( [
					'ID' => $after_payment_payment_id,
					'post_status' => 'paid'
				]); 
				$after_payment_payment_data = get_post($after_payment_payment_id, ARRAY_A);    // получил массив данных платежа

				$after_payment_collected_amount = (int) get_post_meta( ((int)$after_payment_payment_data['post_parent']),    'collection_amount_collected', true );		// достали собранную сумму сбора

				$after_payment_collected_amount += (unserialize($after_payment_payment_data['post_content'])['donate_amount']);
				update_post_meta( ((int)$after_payment_payment_data['post_parent']), 'collection_amount_collected', $after_payment_collected_amount );

				$after_payment_text = 'Ми отримали вашу пожертву. Дякуємо вам за небайдужість.';
				
			} elseif(substr($after_payment_sanitized_post['orderReference'], 0, 6) == 'qr100_'){

				$after_payment_array = explode('_', $after_payment_sanitized_post['orderReference']);
				
				$after_payment_payment_id = wp_insert_post( [
					'comment_status' => 'closed', 
					'ping_status'    => 'closed',
					'post_author'    => 1,
					'post_content'   => serialize([
						'collection' => $after_payment_array[1], 
						'donate_amount' => 1
					]),
					'post_status'    => 'paid',
					'post_title'     => 'qr100',
					'post_type'      => 'payment',
					'post_parent'	  => $after_payment_array[1],
					'post_category'  => [20]
				], true );

				$after_payment_collected_amount = (int) get_post_meta( $after_payment_array[1], 'collection_amount_collected', true );
				$after_payment_collected_amount += 1;
				update_post_meta( $after_payment_array[1], 'collection_amount_collected', $after_payment_collected_amount );

				$after_payment_text = 'Ми отримали вашу пожертву. Дякуємо вам за небайдужість.';
				 
			}
	
			

		} else {
			$after_payment_text = 'Сума не перерахована. Будь ласка, проведіть операцію ще раз, або зв\'яжіться з нами.';
		}
		

	}
	
	
	
}

?>

    
    <section class="page-banner page-banner-small">
        <div class="bottom-rotten-curve"></div>

        <div class="auto-container">
            <h1><?= the_field('acf_after_payment_header'); ?></h1>
        </div>
    </section>


    <section class="faq-section">
        <div class="auto-container">
            
				<?= the_content(); ?>

				<p>&nbsp;</p>

				<h2 class="after-payment-message"><?= $after_payment_text; ?></h2>

				<div>&nbsp;</div>



        </div>
    </section>


<?php get_footer(); ?>



