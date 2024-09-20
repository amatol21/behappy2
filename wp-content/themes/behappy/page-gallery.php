<?php
/*
Template Name: Галерея
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
										$gallery_all_pictures = $wpdb->get_results( "SELECT * FROM $wpdb->posts WHERE post_status = 'inherit' AND post_type = 'attachment' AND post_content = 'gift'", ARRAY_A);

										//debug($gallery_all_pictures);

										if(!empty($gallery_all_pictures)){
											foreach($gallery_all_pictures as $gallery_picture){

												if(!$gallery_picture['post_parent']){
													$gallery_post_id = wp_insert_post( [
														'comment_status' => 'closed', 
														'ping_status'    => 'closed',
														'post_author'    => 1,
														'post_title'   => "Малюнок {$gallery_picture['ID']}",
														'post_content'   => "Кожен малюнок має формат А4, намальований руками. Учнями початкових класів або дітьми, які відвідують дитячий садок. Всі малюнки автентичні. Авторські права передані та належать благодійному фонду «Крок до щастя». Кожен малюнок має унікальну рамку, і коробку, в якій буде доставлений як подарунок тому, хто його замовив за стандартними тарифами міжнародної пошти. Відправлення здійснюється з України, наземним транспортом. <br><br>Ми дякуємо за підтримку нашого проєкту, ми дуже раді, що вам сподобалися малюнки українських дітей. Ми будемо вдячні, якщо надішлете фотографію, де ви розмістили малюнок у вашому будинку або офісі, якщо поділитеся цією фотографією на Facebook або Instagram.",
														'post_status'    => 'publish',
														'post_type'      => 'post',
														'post_category'  => [18]
													], true );
													update_post_meta( $gallery_post_id, '_wp_page_template', 'post-picture.php');

													wp_update_post( [
														'ID' => $gallery_picture['ID'],
														'post_parent' => $gallery_post_id
													]);
													update_post_meta( $gallery_post_id, '_thumbnail_id', $gallery_picture['ID'] );  
												}
											}
										}

										//echo get_the_post_thumbnail( 329, 'medium');
											
										$gallery_all_posts = get_posts([
											'category'		=> 18,
											'numberposts'	=> -1
										]);  

										//debug($gallery_all_posts);

										if(!empty($gallery_all_posts)){
											foreach($gallery_all_posts as $gallery_post){

												$gallery_post_picture_id = get_post_thumbnail_id( $gallery_post->ID );
												$gallery_post_picture= get_post($gallery_post_picture_id);		
												$gallery_post_link = get_permalink($gallery_post->ID);
											?>
											<div class="shop-item col-xl-4 col-lg-6 col-md-6 col-sm-12 wow fadeInUp">
												<div class="inner-box">
													<a href="<?= $gallery_post_link; ?>"> <!-- <a href="48738573/index.html"> --> 
														<div class="image">
															<?= get_the_post_thumbnail( $gallery_post->ID, 'medium', ['class' => 'lazy-image', 'data-src' => "{$gallery_post_link}"]); ?>

															<div class="overlay-box"></div>
															<?php if($gallery_post_picture->post_excerpt) {?>
																<div class="tag-banner">Подарована</div>
															<?php } ?>
														</div>
													</a>

													
												</div>
											</div>

									<?php } }?>
                            
                                
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










