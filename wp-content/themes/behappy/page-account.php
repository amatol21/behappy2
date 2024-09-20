<?php
/*
Template Name: Аккаунт
*/

get_header(); 
?>

    
    <section class="page-banner page-banner-small">
        <div class="bottom-rotten-curve"></div>

        <div class="auto-container">
            <h1><?= the_field('acf_account_title'); ?></h1>
        </div>
    </section>


	<section class="account-section">		
		<div class="auto-container">
			<?php the_content(); ?>

		</div>
	</section>


<?php get_footer(); ?>



