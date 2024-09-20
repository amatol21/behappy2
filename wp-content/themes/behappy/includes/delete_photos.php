<?php 
require( __DIR__ . '/../../../../wp-load.php' );

if(!empty($_POST['delete_photos'])){
	foreach($_POST['delete_photos'] as $photo){
		wp_delete_post(esc_sql(sanitize_text_field($photo)));	
	}
}

wp_redirect( get_page_link( 112, true ));
exit;


