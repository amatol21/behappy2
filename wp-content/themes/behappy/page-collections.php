<?php
/*
Template Name: Збори 
*/

get_header(); 
?>


<section class="page-banner page-banner-small">
	<div class="image-layer lazy-image" data-bg="url('/static/images/background/bg-banner-1.jpg')"></div>
	<div class="bottom-rotten-curve"></div>

	<div class="auto-container">
		<h1><?= the_title(); ?></h1>
		<p class="text-justify">
		<?= the_content(); ?>
		</p>
	</div>
</section>

<div class="sidebar-page-container shop-page">
	<div class="auto-container">
		<div class="row clearfix">

			<div class="content-side col-xl-12 col-lg-12 col-md-12 col-sm-12">
				<div class="our-shop">
					<div class="row clearfix">

						<?php 
							
							$active_collections = get_posts([
								'post_type' 	=> 'post',
								'category'		=> 17,
								'numberposts' 	=> -1, 
								'orderby' 		=> 'date', 
								'order' 			=> 'DESC',
							]);

							//debug($gallery_all_posts);

							if(!empty($active_collections)){
								foreach($active_collections as $collection){		
									$collection_link = get_permalink($collection->ID);
						?>
									<div class="shop-item col-xl-4 col-lg-6 col-md-6 col-sm-12 wow fadeInUp">
										<div class="inner-box">
											<a href="<?= $collection_link; ?>" target="_blank" class="shop-image">
												<span class="shop-image-text"><?= $collection->post_title; ?></span>
											</a>					

											<div class="lower-content">
												<h3><a href="<?= $collection_link; ?>" target="_blank"><?= $collection->post_title; ?></a>
												</h3>
												<p><?= get_the_excerpt($collection); ?></p>
											</div>
											
										</div>
									</div>

						<?php }
							}
						?>
									
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



<section class="call-to-action-two">
    <div class="auto-container">
        <div class="inner clearfix">
            
            
            <div class="link-box">
                <a href="<?= get_page_link( 17, true ); ?>" class="theme-btn btn-style-five" onclick="fbq('track', 'Donate');">
                    <span class="btn-title">Підтримати</span>
                </a>
            </div>
        </div>
    </div>
</section>



<?php get_footer(); ?>









