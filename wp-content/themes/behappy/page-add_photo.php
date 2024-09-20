<?php
/*
Template Name: Додати зображення
*/

get_header(); 
?>

    
    <section class="page-banner page-banner-small">
        <div class="bottom-rotten-curve"></div>

        <div class="auto-container">
            <h1><?= the_field('acf_account_title'); ?></h1>
        </div>
    </section>


	<section class="add-section">		
		<div class="auto-container">
			<?php if(um_profile_id()){
				the_content(); 	
			?>
			<a class="account-link" href="<?= get_page_link( 48, true ); ?>">До облікового запису</a>

			<?php 
				echo do_shortcode("[forminator_form id='92']");

				$ultimate_member_account_owner = um_profile_id();
				$photos_arr = $wpdb->get_results( 
					"SELECT * FROM $wpdb->posts  
					WHERE $wpdb->posts.post_author = $ultimate_member_account_owner 
					AND $wpdb->posts.post_mime_type 
					IN ('image/jpeg', 'image/jpg', 'image/jpe', 'image/gif', 'image/png', 'image/bmp', 'image/webp')", 
					ARRAY_A);
				//debug($photos_arr);
			?>

			<p class="add-delete-header">Вже завантажені фото</p>

			<form action="<?= get_template_directory_uri() ?>/includes/delete_photos.php" method="POST" class="add-delete">
				<select name="delete_photos[]" id="" multiple class="add-choose">
					<?php 
						if(!empty($photos_arr)){
							foreach($photos_arr as $elem) {?>
								<option value="<?= $elem['ID']; ?>" class="add-option"><?= $elem['post_title']; ?></option>
					<?php } 
					}?>
				</select>
				<button type="submit" class="add-submit">Видалити обрані</button>
			</form>
			
			<?php 
				} else echo 'Будь ласка увійдіть, або зареєструйтесь.';
			?>
		</div>
	</section>


<?php get_footer(); ?>



