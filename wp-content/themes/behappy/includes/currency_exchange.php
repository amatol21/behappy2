<?php 

// Обновление курсов валют. Делать 1 раз в сутки по cron.

require( __DIR__ . '/../../../../wp-load.php' );

$all_currency_answer = wp_remote_get( 'https://bank.gov.ua/NBUStatService/v1/statdirectory/exchange?json');

if(!is_wp_error($all_currency_answer)){
	$currency_array = json_decode($all_currency_answer['body']);

	foreach($currency_array as $currency){
		if($currency->cc == 'USD'){
			update_user_meta( 1, 'service_currency_usd', esc_sql(sanitize_text_field($currency->rate)));
		}
		if($currency->cc == 'EUR'){
			update_user_meta( 1, 'service_currency_euro', esc_sql(sanitize_text_field($currency->rate)));
		}
	}

} 






