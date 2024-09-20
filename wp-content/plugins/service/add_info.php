<?php 

require( __DIR__ . '/../../../wp-load.php' );

//debug($_POST);

if(!empty($_POST['service-phone'])){
	update_user_meta( 1, 'service_phone', esc_sql(sanitize_text_field($_POST['service-phone'])));
}

if(!empty($_POST['service-email'])){
	update_user_meta( 1, 'service_email', esc_sql(sanitize_text_field($_POST['service-email'])));
}

if(!empty($_POST['service-fee-ukraine'])){
	update_user_meta( 1, 'service-fee-ukraine', ((int) esc_sql(sanitize_text_field($_POST['service-fee-ukraine']))));
}

if(!empty($_POST['service-fee-europe'])){
	update_user_meta( 1, 'service-fee-europe', ((int) esc_sql(sanitize_text_field($_POST['service-fee-europe']))));
}

if(!empty($_POST['service-fee-america'])){
	update_user_meta( 1, 'service-fee-america', ((int) esc_sql(sanitize_text_field($_POST['service-fee-america']))));
}

wp_redirect( admin_url( '/admin.php?page=service_page' ) );
exit;
