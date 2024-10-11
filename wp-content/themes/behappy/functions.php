<?php 

require_once (__DIR__ .'/../../../vendor/autoload.php');

add_action( 'wp_enqueue_scripts', 'behappy_styles');
add_action( 'wp_enqueue_scripts', 'behappy_scripts');
add_action( 'after_setup_theme', 'behappy_register_nav_menu' );
add_action( 'admin_enqueue_scripts', function(){
	wp_enqueue_style( 'my-wp-admin', get_template_directory_uri() .'/assets/css/admin-styles.css' );
}, 99 );


add_theme_support( 'custom-logo');
add_theme_support( 'post-thumbnails', array( 'post' ) );



function behappy_styles(){
	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.css');
	wp_enqueue_style('style.v5', get_template_directory_uri() . '/assets/css/style.v5.css');
	wp_enqueue_style('style-2.v1', get_template_directory_uri() . '/assets/css/style-2.v1.css');
	wp_enqueue_style('responsive', get_template_directory_uri() . '/assets/css/responsive.css');
	wp_enqueue_style('color.v2', get_template_directory_uri() . '/assets/css/color.v2.css');
	wp_enqueue_style('style-override', get_template_directory_uri() . '/assets/css/style-override.css');

	
	
	if(is_page_template( 'post-collection.php' )){
		wp_enqueue_style('splide-style', get_template_directory_uri() . '/assets/css/splide.min.css');
	} 

	if(is_page_template( 'front-page.php' )){
		wp_enqueue_style('splide-style', get_template_directory_uri() . '/assets/css/splide.min.css');
	}
}



function behappy_scripts(){
	
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'popper', get_template_directory_uri() . '/assets/js/popper.min.js', array('jquery'), null, true);
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), null, true );
	wp_enqueue_script( 'jquery-ui', get_template_directory_uri() . '/assets/js/jquery-ui.js', array('jquery'), null, true );
	wp_enqueue_script( 'fancybox', get_template_directory_uri() . '/assets/js/jquery.fancybox.js', array('jquery'), null, true );

	if(!is_page_template( 'post-collection.php' )){
		wp_enqueue_script( 'owl', get_template_directory_uri() . '/assets/js/owl.js', array('jquery'), null, true);
	}

	wp_enqueue_script( 'appear', get_template_directory_uri() . '/assets/js/appear.js', array('jquery'), null, true );
	wp_enqueue_script( 'wow', get_template_directory_uri() . '/assets/js/wow.js', array('jquery'), null, true );	
	wp_enqueue_script( 'lazyload', get_template_directory_uri() . '/assets/js/lazyload.js', array('jquery'), null, true );
	wp_enqueue_script( 'scrollbar', get_template_directory_uri() . '/assets/js/scrollbar.js', array('jquery'), null, true );	
	wp_enqueue_script( 'userscript', get_template_directory_uri() . '/assets/js/script.v1.js', array('jquery'), null, true );


	if(is_page_template( 'post-collection.php' )){
		wp_enqueue_script( 'splide', get_template_directory_uri() . '/assets/js/splide.min.js', array(), null, true );
		wp_enqueue_script( 'postcollection', get_template_directory_uri() . '/assets/js/postcollection.js', array(), null, true );
	} 

	if(is_page_template( 'post-picture.php' )){
		wp_enqueue_script( 'postpicture', get_template_directory_uri() . '/assets/js/postpicture.js', array('jquery'), null, true );
	}

	if(is_page_template( 'page-donate.php' )){
		wp_enqueue_script( 'pagedonate', get_template_directory_uri() . '/assets/js/pagedonate.js', array('jquery'), null, true );
	}	

	if(is_page_template( 'front-page.php' )){
		wp_enqueue_script( 'splide', get_template_directory_uri() . '/assets/js/splide.min.js', array(), null, true );
		wp_enqueue_script( 'frontpage', get_template_directory_uri() . '/assets/js/frontpage.js', array(), null, true );
	}
}


// Календарь для выбора дат в платежах - вкладка "Додатково"

add_action( 'admin_enqueue_scripts', function(){		
	wp_enqueue_style('daterangepicker', "//cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css");
	wp_enqueue_script( 'momentscript', '//cdn.jsdelivr.net/momentjs/latest/moment.min.js', array('jquery'), null, true );
	wp_enqueue_script( 'daterangepickerscript', '//cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js', array('jquery'), null, true );
	wp_enqueue_script( 'datepickerscript', plugins_url() . '/service/datepicker.js', array('jquery'), null, true );
}, 99 );



function behappy_register_nav_menu() {
	register_nav_menu( 'primary', 'Primary Menu' );
}




function debug($variable){
	echo'<pre>';
	var_dump($variable);
	echo'</pre>';
}

function um_account_tab_general_fields( $args, $shortcode_args ) {

	$args .= ',phone_number';
	$args .= ',youtube';

	return $args;
}
add_filter( 'um_account_tab_general_fields', 'um_account_tab_general_fields', 10, 2 );

add_action('um_after_account_general', 'showUMExtraFields', 100);

function showUMExtraFields() {
  $id = um_user('ID');
  $output = '';
  $names = array('organization');

  $fields = array(); 
  foreach( $names as $name )
    $fields[ $name ] = UM()->builtin()->get_specific_field( $name );
  $fields = apply_filters('um_account_secure_fields', $fields, $id);
  foreach( $fields as $key => $data )
    $output .= UM()->fields()->edit_field( $key, $data );

  echo $output;  
}

add_action('um_account_pre_update_profile', 'getUMFormData', 100);

function getUMFormData(){
	$id = um_user('ID');
	$names = array('organization');

	foreach( $names as $name ){
		if( isset( $_POST[ $name ] ) && !(UM()->form()->has_error( $name )) ) {
			update_user_meta( $id, $name, esc_sql(sanitize_text_field($_POST[$name])) );
			
		}
	}
}












add_filter('um_account_page_default_tabs_hook', 'my_custom_tabs_in_um', 100 );
function my_custom_tabs_in_um( $tabs ) {
	$tabs[110]['photos']['icon'] = 'far fa-images';
	$tabs[110]['photos']['title'] = __( 'Додати фото', 'ultimate-member' );
	$tabs[110]['photos']['submit_title'] = 'Add photo button';
	$tabs[110]['photos']['custom'] = true;

	$tabs[120]['collection']['icon'] = 'fas fa-hand-holding-heart';
	$tabs[120]['collection']['title'] = __( 'Збір', 'ultimate-member' );
	$tabs[120]['collection']['submit_title'] = __( 'Зберегти зміни', 'ultimate-member' );
	$tabs[120]['collection']['custom'] = true;

	return $tabs;
}
	
/* make new tab hookable */

add_action('um_account_tab__photos', 'um_account_tab__photos');
function um_account_tab__photos( $info ) {
	global $ultimatemember;
	extract( $info );

	$output = $ultimatemember->account->get_tab_output('photos');
	if ( $output ) { echo $output; }
}

add_action('um_account_tab__collection', 'um_account_tab__collection');
function um_account_tab__collection( $info ) {
	global $ultimatemember;
	extract( $info );

	$output = $ultimatemember->account->get_tab_output('collection');
	if ( $output ) { echo $output; }
	
}

/* Add some content in the tabs */

add_filter('um_account_content_hook_photos', 'um_account_content_hook_photos');
function um_account_content_hook_photos( $output ){
	ob_start();
	?>
		
	<div class="um-field">
		<?php if( um_profile_id()){ ?>

			<a href="<?= get_page_link(112) ?>" style="display: block; margin: 20px 0; font-size: 25px; text-decoration: underline;">Додати/Видалити зображення</a>

		<?php } ?>
		
	</div>
	<?php
		
	$output .= ob_get_contents();
	ob_end_clean();
	return $output;
}


function um_account_content_collection( $output = '' ) {

	global $wpdb;
	
	$collection_user_id = um_profile_id();
	$collection_user_post_data = $wpdb->get_results( "SELECT * FROM $wpdb->posts WHERE post_author = $collection_user_id AND post_status IN ('publish', 'pending', 'draft')", ARRAY_A);
	$collection_user_url_data = $wpdb->get_results( "SELECT * FROM $wpdb->usermeta WHERE user_id = $collection_user_id AND meta_key = 'user_url'", ARRAY_A);

	if(empty($collection_user_post_data) && !empty($collection_user_url_data[0]['meta_value'])){
		update_user_meta( $collection_user_id, 'user_url', '' );
	}




	// List of fields you want to display.
	$fields = array(
		'collection_title',
		'collection_description',
		'collection_amount',
		//'user_url',
		'collection_show'
	);

	ob_start();
	foreach( $fields as $key ) {
		$data = UM()->builtin()->get_a_field( $key );
		echo UM()->fields()->edit_field( $key, $data );
	} ?>

	<div id="um_field_0_user_url" class="um-field um-field-url  um-field-user_url um-field-url um-field-type_url" data-key="user_url">
		<div class="um-field-label">
			<label for="user_url">URL сторінки збору</label>
			<div class="um-clear"></div>
		</div>
		<div class="um-field-area">
			<div class="um-form-field um-page-url" type="text" name="user_url" id="user_url" data-key="user_url" aria-invalid="false">
				<a href="<?= get_user_meta( $collection_user_id, 'user_url', true ); ?>"><?= get_user_meta( $collection_user_id, 'user_url', true ); ?></a>
			</div>

		</div>
	</div>

	<?php return ob_get_clean();
}
add_filter( 'um_account_content_hook_collection', 'um_account_content_collection', 20 );


/**
 * Validate custom fields in collections.
 *
 * @param array $post_args Input data.
 */
function um_account_errors_collection( $post_args ) {
	if( ! isset( $post_args[ 'um_account_submit' ] ) ) {
		return;
	}

	// List of fields you want to validate.
	$fields = array(
		'collection_title',
		'collection_description',
		'collection_amount',
		'collection_show'
	);

	foreach( $fields as $key ) {
		$data = UM()->builtin()->get_a_field( $key );
		if( empty( $post_args[ $key ] ) && ! empty( $data['required'] ) ) {
			UM()->form()->add_error( $key, __( 'This field is required.', 'ultimate-member' ) );
		}
	}
}

add_action( 'um_submit_account_errors_hook', 'um_account_errors_collection', 20 );


/**
 * Save custom fields in collections.
 *
 * @param int $user_id User ID.
 */

add_action( 'um_submit_account_errors_hook', 'um_account_errors_collection', 20 );


function um_account_update_collection( $user_id ) {

	global $wpdb;

	// List of fields you want to update.
	$fields = array(
		'collection_title',
		'collection_description',
		'collection_amount',
		'collection_show'
	);

	foreach( $fields as $key ) {
		if( isset( $_POST[ $key ] ) && (! UM()->form()->has_error( $key )) ) {
			update_user_meta( $user_id, $key, esc_sql(sanitize_text_field(wp_unslash( $_POST[ $key ] ))) );
			
		}
	}

	
	$collection_posts = get_posts([
		'author' => $user_id,
		'post_status' => ['publish', 'pending', 'draft'],
		'numberposts' => -1
	]);

	//debug($collection_posts);

	if($_POST['collection_show'] && (!$collection_posts)){
		$collection_post_id = wp_insert_post( [
			'comment_status' => 'closed', 
			'ping_status'    => 'closed',
			'post_author'    => $user_id,
			'post_content'   => esc_sql(sanitize_text_field($_POST['collection_description'])),
			'post_status'    => 'pending',
			'post_title'     => esc_sql(sanitize_text_field($_POST['collection_title'])),
			'post_type'      => 'post',
			'post_category'  => [17]
		], true );
		update_post_meta( $collection_post_id, '_wp_page_template', 'post-collection.php');
		update_post_meta( $collection_post_id, 'collection_amount_collected', 0 );

		$collection_post = get_post($collection_post_id);
		update_user_meta( $user_id, 'user_url', ((string)get_permalink($collection_post_id)) );		

	} elseif((!$_POST['collection_show']) && ($collection_posts)){

		if($collection_posts[0]->post_status == 'publish'){

			$collection_post_id = wp_update_post( [
				'ID' => $collection_posts[0]->ID,
				'post_status'    => 'draft',
			]);
		} 

	} elseif($_POST['collection_show'] && ($collection_posts)){

		if($collection_posts[0]->post_status == 'draft'){

			$collection_post_id = wp_update_post( [
				'ID' =>$collection_posts[0]->ID,
				'post_content'   => esc_sql(sanitize_text_field($_POST['collection_description'])),
				'post_title'     => esc_sql(sanitize_text_field($_POST['collection_title'])),
				'post_status'    => 'publish'
			]);

		} elseif($collection_posts[0]->post_status == 'publish') {

			$collection_post_id = wp_update_post( [
				'ID' =>$collection_posts[0]->ID,
				'post_content'   => esc_sql(sanitize_text_field($_POST['collection_description'])),
				'post_title'     => esc_sql(sanitize_text_field($_POST['collection_title'])),
				'post_status'    => 'publish',
			]);

		} elseif($collection_posts[0]->post_status == 'pending'){
			$collection_post_id = wp_update_post( [
				'ID' =>$collection_posts[0]->ID,
				'post_content'   => esc_sql(sanitize_text_field($_POST['collection_description'])),
				'post_title'     => esc_sql(sanitize_text_field($_POST['collection_title'])),
				'post_status'    => 'pending',
			]);
		}
	} 
}
add_action( 'um_after_user_account_updated', 'um_account_update_collection', 8 );























// Forms. Work with photos

add_filter( 'forminator_custom_upload_subfolder', function( $sub_folder, $module_id, $dir ) {
	if( um_profile_id()) {
		$user_id = um_profile_id();
		
		if ( $user_id ) {
			$dir = $user_id . '/' . $dir;
		}
	}
	return 'collections/' . $dir;
}, 10, 3 );



// Logged in users content

add_shortcode('member', 'loggedInUserContent');

function loggedInUserContent($atts, $content = null){

	if( um_profile_id()) {
		return do_shortcode($content);
	}

	return 'Будь ласка увійдіть, або зареєструйтесь.';
}


add_filter( 'excerpt_length', function(){
	return 10;
} );








function payment_statuses(){										// регистрация новых статусов постов для донатов: "оплачено" и "не оплачено" 
	register_post_status( 'not_paid', array(
		'label'                     => 'not_paid',
		'public'                    => true,
		'exclude_from_search'       => true,
		'public'                    => false,
		'label_count'               => false,
		'internal'                  => true,
		'publicly_queryable'        => false
	) );

	register_post_status( 'paid', array(
		'label'                     => 'paid',
		'public'                    => true,
		'exclude_from_search'       => true,
		'public'                    => false,
		'label_count'               => false,
		'internal'                  => true,
		'publicly_queryable'        => false
	) );
}

add_action( 'init', 'payment_statuses' );



$picture_fee = [
	'ukraine' => [
		'UAH' => (int) get_user_meta( 1, 'service-fee-ukraine', true )
	], 
	'europe' => [
		'UAH' => (int) get_user_meta( 1, 'service-fee-europe', true )
	], 
	'america' => [
		'UAH' => (int) get_user_meta( 1, 'service-fee-america', true )
	]
];



// daily currency rate update

$today_time = time();	
//debug($today_time);
$service_currency_array = unserialize(get_user_meta( 1, 'service_currency_usd', true ));
$last_update_time = $service_currency_array['last_update_time']; 
if($today_time > ($last_update_time + 86400)){

	$all_currency_answer = wp_remote_get( 'https://bank.gov.ua/NBUStatService/v1/statdirectory/exchange?json');

	if(!is_wp_error($all_currency_answer)){
		$currency_array = json_decode($all_currency_answer['body']);
	
		foreach($currency_array as $currency){
			if($currency->cc == 'USD'){
				$usd_rate = esc_sql(sanitize_text_field($currency->rate));
				update_user_meta( 1, 'service_currency_usd', serialize(['usd_rate' => $usd_rate, 'last_update_time' => $today_time]));
			}
			if($currency->cc == 'EUR'){
				$euro_rate = esc_sql(sanitize_text_field($currency->rate));
				update_user_meta( 1, 'service_currency_euro', serialize(['euro_rate' => $euro_rate, 'last_update_time' => $today_time]));
			}
		}
	
	}
}

$usd_array = unserialize(get_user_meta( 1, 'service_currency_usd', true ));
$eur_array = unserialize(get_user_meta( 1, 'service_currency_euro', true ));

$one_usd = floor($usd_array['usd_rate']);
$one_eur = floor($eur_array['euro_rate']);

$picture_fee['ukraine']['EUR'] = ceil($picture_fee['ukraine']['UAH'] / $one_eur);
$picture_fee['ukraine']['USD'] = ceil($picture_fee['ukraine']['UAH'] / $one_usd);

$picture_fee['europe']['EUR'] = ceil($picture_fee['europe']['UAH'] / $one_eur);
$picture_fee['europe']['USD'] = ceil($picture_fee['europe']['UAH'] / $one_usd);

$picture_fee['america']['EUR'] = ceil($picture_fee['america']['UAH'] / $one_eur);
$picture_fee['america']['USD'] = ceil($picture_fee['america']['UAH'] / $one_usd);

//debug($picture_fee);


add_action( 'rest_api_init', function(){
	global $one_usd;
	global $one_eur;
	global $picture_fee;

	register_rest_route( 'prepare/v1', '/get_sign/(?P<amount>.+)/(?P<currency>.+)/(?P<collection_id>.+)', [
		'methods'  => 'POST',
		'callback' => 'receive_sign',
		'permission_callback' => '__return_true',
		'args' => array(
			'amount' => array(
				'type'		=> 'integer',
				'required' 	=> true
			),
			'currency' => array(
				'type' 		=> 'string',
				'required'	=> true
			),
			'collection_id' => array(
				'type' 		=> 'integer',
				'required'	=> true
			)
		) 
	]);

	function receive_sign(WP_REST_Request $request){

		global $one_usd;
		global $one_eur;

		$amount = esc_sql(sanitize_text_field($request-> get_param('amount')));
		$currency = esc_sql(sanitize_text_field($request-> get_param('currency')));
		$collection_id = esc_sql(sanitize_text_field($request-> get_param('collection_id')));
		//$transaction_number = (int) get_option( 'transaction_number');
		//update_option('transaction_number', ++$transaction_number);
		if($currency == 'USD'){
			$uah_amount = $amount * $one_usd;
		} elseif($currency == 'EUR'){
			$uah_amount = $amount * $one_eur;
		} else{
			$uah_amount = $amount;
		}
		$time = time();
		$wfp_key = get_option('wfp_key');

		$payment_post_id = wp_insert_post( [
			'comment_status' => 'closed', 
			'ping_status'    => 'closed',
			'post_author'    => 1,
			'post_content'   => serialize(['collection' => $collection_id, 'donate_amount' => $uah_amount]),
			'post_status'    => 'not_paid',
			'post_title'     => 'donate',
			'post_type'      => 'payment',
			'post_parent'	  => $collection_id,
			'post_category'  => [20]
		], true );

		$sign = hash_hmac('md5', "behappyua_com;{$_SERVER["HTTP_HOST"]};bhwad_{$payment_post_id};$time;$amount;$currency;collection_$collection_id;1;$amount", $wfp_key);

		return json_encode([
			'sign' => $sign, 
			'payment_post_id' => $payment_post_id, 
			'time' => $time, 
			'collection_id' => $collection_id,
			'return_url' => get_page_link( 524)
			], 
		JSON_UNESCAPED_UNICODE);
		 
	}

	register_rest_route( 'prepare/v1', '/get_complex_sign/(?P<amount>.+)/(?P<currency>.+)/(?P<name>.+)/(?P<lastname>.+)/(?P<email>.+)/(?P<phone>.+)/(?P<address>.+)/(?P<collection_id>.+)/(?P<region>.+)/(?P<post_picture_id>.+)', [
		'methods'  => 'POST',
		'callback' => 'receive_complex_sign',
		'permission_callback' => '__return_true',
		'args' => array(
			'amount' => array(
				'type'		=> 'integer',
				'required' 	=> true
			),
			'currency' => array(
				'type' 		=> 'string',
				'required'	=> true
			),
			'name' => array(
				'type' 		=> 'string',
				'required'	=> true
			),
			'lastname' => array(
				'type' 		=> 'string',
				'required'	=> true
			),
			'email' => array(
				'type' 		=> 'string',
				'required'	=> true
			),
			'phone' => array(
				'type' 		=> 'string',
				'required'	=> true
			),
			'address' => array(
				'type' 		=> 'string',
				'required'	=> true
			),
			'collection_id' => array(
				'type' 		=> 'integer',
				'required'	=> true
			),
			'region' => array(
				'type' 		=> 'string',
				'required'	=> true,
			),
			'post_picture_id' => array(
				'type' 		=> 'integer',
				'required'	=> true
			)
		) 
	]);

	function receive_complex_sign(WP_REST_Request $request){

		global $one_usd;
		global $one_eur;
		global $picture_fee;

		$amount = esc_sql(sanitize_text_field($request-> get_param('amount')));
		$currency = esc_sql(sanitize_text_field($request-> get_param('currency')));
		$name = esc_sql(sanitize_text_field($request-> get_param('name')));
		$lastname = esc_sql(sanitize_text_field($request-> get_param('lastname')));
		$email = esc_sql(sanitize_text_field($request-> get_param('email')));
		$phone = esc_sql(sanitize_text_field($request-> get_param('phone')));
		$address = esc_sql(sanitize_text_field($request-> get_param('address')));

		$collection_id = esc_sql(sanitize_text_field($request-> get_param('collection_id')));
		$region = esc_sql(sanitize_text_field($request->get_param('region')));
		$post_picture_id = esc_sql(sanitize_text_field($request-> get_param('post_picture_id')));
		$full_amount = $amount + $picture_fee[$region][$currency];
		if($currency == 'USD'){
			$uah_full_amount = $full_amount * $one_usd;
			$uah_amount = $amount * $one_usd;
		} elseif($currency == 'EUR'){
			$uah_full_amount = $full_amount * $one_eur;
			$uah_amount = $amount * $one_eur;
		} else{
			$uah_full_amount = $full_amount;
			$uah_amount = $amount;
		}

		$time = time();
		$wfp_key = get_option('wfp_key');

		$payment_post_id = wp_insert_post( [
			'comment_status' => 'closed', 
			'ping_status'    => 'closed',
			'post_author'    => 1,
			'post_content'   => serialize([
				'collection' => $collection_id, 
				'post_picture_id' => $post_picture_id,
				'donate_amount' => $uah_amount, 
				'fee' => $picture_fee[$region]['UAH'], 
				'full_amount' => $uah_full_amount,
				'name' => $name,
				'lastname' => $lastname,
				'email' => $email,
				'phone' => $phone,
				'address' => $address
			]),
			'post_status'    => 'not_paid',
			'post_title'     => 'donate_fee',
			'post_type'      => 'payment',
			'post_parent'	  => $collection_id,
			'post_category'  => [20]
		], true );
		
		$sign = hash_hmac('md5', "behappyua_com;{$_SERVER["HTTP_HOST"]};bhwad_$payment_post_id;$time;$full_amount;$currency;collection_$collection_id;picture_$post_picture_id;1;1;$amount;{$picture_fee[$region][$currency]}", $wfp_key);

		return json_encode([
			'sign' => $sign, 
			'payment_post_id' => $payment_post_id, 
			'time' => $time, 
			'full_amount' => $full_amount,
			'picture_fee' => $picture_fee[$region][$currency],
			'return_url' => get_page_link( 524),
			'uah_full' => $uah_full_amount,
			'uah' => $uah_amount,
			'currency' => $currency
		], JSON_UNESCAPED_UNICODE);
		 
	}

});


