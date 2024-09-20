<?php
/*
Template Name: Головна 
*/

get_header(); 
?>
       
	<section class="banner-section">
		<div class="banner-carousel love-carousel owl-theme owl-carousel"
				data-options='{"loop": true, "margin": 0, "autoheight":true, "lazyload":true, "nav": true, "dots": true, "autoplay": false, "autoplayTimeout": 6000, "smartSpeed": 300, "responsive":{ "0" :{ "items": "1" }, "768" :{ "items" : "1" } , "1000":{ "items" : "1" }}}'>
			<div class="slide-item">
					
				<div class="image-layer lazy-image" data-bg="url('<?= the_field('acf_first_slider_one'); ?>')" style="background-image: url('<?= the_field('acf_first_slider_one'); ?>');"></div>

				<div class="auto-container">
					<div class="content-box">
						<h2><?= the_field('acf_main_first_header'); ?></h2>
						<div class="text text-center">
							<?= the_field('acf_main_first_text'); ?>
						</div>
						<div class="btn-box">
							<a data-target="#what-we-do"
								class="theme-btn btn-style-one scroll-to-target">
								<span class="btn-title">Більше</span>
							</a>
						</div>
					</div>
				</div>
			</div>

			<!-- Slide Item -->
			<div class="slide-item">
					
				<div class="image-layer lazy-image" data-bg="url('<?= the_field('acf_first_slider_two'); ?>')"></div>

				<div class="auto-container">
					<div class="content-box">
						<h2><?= the_field('acf_main_second_header'); ?></h2>
						<div class="text text-center">
							<?= the_field('acf_main_second_text'); ?>
						</div>
						<div class="btn-box">
							<a data-target="#what-we-do"
								class="theme-btn btn-style-one scroll-to-target">
								<span class="btn-title">Більше</span>
							</a>
						</div>
					</div>
				</div>
			</div>

			<!-- Slide Item -->
			<div class="slide-item">
					
				<div class="image-layer lazy-image" data-bg="url('<?= the_field('acf_first_slider_three'); ?>')"></div>

				<div class="image-layer lazy-image" data-bg="url('<?= the_field('acf_first_slider_three'); ?>')"></div>

				<div class="auto-container">
					<div class="content-box">
						<h2><?= the_field('acf_main_third_header'); ?></h2>
						<div class="text">
							<?= the_field('acf_main_third_text'); ?>
						</div>
						<div class="btn-box">
							<a data-target="#what-we-do"
								class="theme-btn btn-style-one scroll-to-target">
								<span class="btn-title">Більше</span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

   



<section class="upcoming-events">
    <div class="circle-one"></div>
    <div class="circle-two"></div>

	<div class="auto-container">



		
		<div class="auto-container "> 

			<?php 
				// Приоритетные проекты

				$main_collections_arr = explode(',', get_field( 'acf_main_collections'));
				//debug($main_collections_arr);

			?>
			<section class="splide collection-splide" id="splide1" aria-label="Splide Basic HTML Example">
				<div class="splide__track">
						<ul class="splide__list">
							<?php 
								if(!empty($main_collections_arr)){
									foreach($main_collections_arr as $main_collection_id){
										$collection = get_post($main_collection_id);
										$collection_img_id = $wpdb->get_results( 
											"SELECT ID FROM $wpdb->posts  
											WHERE $wpdb->posts.post_author = $collection->post_author 
											AND $wpdb->posts.post_mime_type 
											IN ('image/jpeg', 'image/jpg', 'image/jpe', 'image/gif', 'image/png', 'image/bmp', 'image/webp') LIMIT 1", 
											ARRAY_A); 
							?>
								<li class="splide__slide collection-item" >
										
									<a href="<?= get_permalink($collection->ID); ?>" target="_blank" class="collection-image">
										<?php if(!empty($collection_img_id)){
											$img_link = wp_get_attachment_url( $collection_img_id[0]['ID'] );
											echo "<img src=\"$img_link\" alt=\"image background\" class=\"collection-image-item\">";
										} ?>
										<span class="collection-image-title" ><?= $collection->post_title; ?></span>
									</a>					
									
									<div class="lower-content">
										<h3><a href="<?= get_permalink($collection->ID); ?>" class="shop-image-title" target="_blank"><?= $collection->post_title; ?></a>
										</h3>
										<p class="shop-image-excerpt"><?= get_the_excerpt($collection); ?></p>
									</div>

								</li>
							<?php } }?>	
						</ul>
				</div>
			</section>
			<br>

			<?php 
				// Сборы с меньшими собранными суммами
				
				$all_collections = get_posts([
					'post_type' 	=> 'post',
					'category'		=> 17,
					'numberposts' 	=> 5,
				]); 

				
				$all_collections_ids = [];
				foreach($all_collections as $collection){
					$all_collections_ids[] = $collection->ID;
				}

				$all_collections_keys = [];
				$all_collections_values = [];
				foreach($all_collections_ids as $elem){
					$all_collections_keys[] = $elem;
					$all_collections_values[] = get_post_meta( $elem, 'collection_amount_collected', true);
				}
				//debug($all_collections_keys);
				//debug($all_collections_values);
 
				$lowest_collections_data = [];
				for($i = 0; $i <= 5; $i++){
					if((count($all_collections_values)) <= 0){
						break;
					}
					$min = min($all_collections_values);
					foreach($all_collections_values as $key => $value){
						if($value == $min){
							$lowest_collections_data[$all_collections_keys[$key]] = $all_collections_values[$key];
							unset($all_collections_values[$key]);
							unset($all_collections_keys[$key]);
							break;
						}
					}
				}
			
				foreach($lowest_collections_data as $key => $value){
					
					$lowest_amounts_collected_collections[] = get_post($key);
				}

				//debug($lowest_amounts_collected_collections);
			?>

			<section class="splide collection-splide" id="splide2" aria-label="Splide Basic HTML Example">
				<div class="splide__track">
						<ul class="splide__list">
							<?php 
								if(!empty($lowest_amounts_collected_collections)){
									foreach($lowest_amounts_collected_collections as $collection){

										$collection_img_id = $wpdb->get_results( 
											"SELECT ID FROM $wpdb->posts  
											WHERE $wpdb->posts.post_author = $collection->post_author 
											AND $wpdb->posts.post_mime_type 
											IN ('image/jpeg', 'image/jpg', 'image/jpe', 'image/gif', 'image/png', 'image/bmp', 'image/webp') LIMIT 1", 
											ARRAY_A);
							?>
								<li class="splide__slide collection-item" >
										
									<a href="<?= get_permalink($collection->ID); ?>" target="_blank" class=" collection-image">
										<?php if(!empty($collection_img_id)){
											$img_link = wp_get_attachment_url( $collection_img_id[0]['ID'] );
											echo "<img src=\"$img_link\" alt=\"image background\" class=\"collection-image-item\">";
										} ?>
										<span class="collection-image-title" ><?= $collection->post_title; ?></span>
									</a>					
									
									<div class="lower-content">
										<h3><a href="<?= get_permalink($collection->ID); ?>" class="shop-image-title" target="_blank"><?= $collection->post_title; ?></a>
										</h3>
										<p class="shop-image-excerpt"><?= get_the_excerpt($collection); ?></p>
									</div>

								</li>
							<?php } }?>	
						</ul>
				</div>
			</section>
								

					
			<?php 
				// последние добавленные сборы
				$active_collections = get_posts([
					'post_type' 	=> 'post',
					'category'		=> 17,
					'numberposts' 	=> 5, 
					'orderby' 		=> 'date', 
					'order' 			=> 'DESC',
				]); 
			?>

			<br>
			<section class="splide collection-splide" id="splide3" aria-label="Splide Basic HTML Example">
				<div class="splide__track">
						<ul class="splide__list">
							<?php 
								if(!empty($active_collections)){
									foreach($active_collections as $collection){

										$collection_img_id = $wpdb->get_results( 
											"SELECT ID FROM $wpdb->posts  
											WHERE $wpdb->posts.post_author = $collection->post_author 
											AND $wpdb->posts.post_mime_type 
											IN ('image/jpeg', 'image/jpg', 'image/jpe', 'image/gif', 'image/png', 'image/bmp', 'image/webp') LIMIT 1", 
											ARRAY_A);
							?>
								<li class="splide__slide collection-item" >
										
									<a href="<?= get_permalink($collection->ID); ?>" target="_blank" class=" collection-image">
										<?php if(!empty($collection_img_id)){
											$img_link = wp_get_attachment_url( $collection_img_id[0]['ID'] );
											echo "<img src=\"$img_link\" alt=\"image background\" class=\"collection-image-item\">";
										} ?>
										<span class="collection-image-title" ><?= $collection->post_title; ?></span>
									</a>					
									
									<div class="lower-content">
										<h3><a href="<?= get_permalink($collection->ID); ?>" class="shop-image-title" target="_blank"><?= $collection->post_title; ?></a>
										</h3>
										<p class="shop-image-excerpt"><?= get_the_excerpt($collection); ?></p>
									</div>

								</li>
							<?php } }?>	
						</ul>
				</div>
			</section>

		</div>

	</div>
		
	</div>
</section>




	<section class="what-we-do" id="what-we-do">
		<div class="auto-container">
			<div class="inner-box">
					<div class="image w-25 mr-3 float-left">
							<img src="<?= the_field('acf_description_photo'); ?>" alt="fund logo image">
					</div>
					<div class="sub-title"></div>
					<h2></h2>
					<div class="text"><?= the_field('acf_what_we_do'); ?></div>
			</div>
			<div class="clearfix"></div>
		</div>
	</section>

    <!--Mission Vision Section-->
	<section class="mission-vision">
		<div class="circle-one"></div>
		<div class="circle-two"></div>

		<div class="auto-container">
			<div class="mission">
				<div class="row clearfix">
					<div class="text-column col-lg-6 col-md-12 col-sm-12">
						<div class="inner">
							<div class="sec-title">
								<div class="sub-title"><?= the_field('acf_sub_title'); ?></div>
								<h2><?= the_field('acf_mission_header'); ?></h2>
								<div class="text">
									<?= the_field('acf_mission_text'); ?>
								</div>
								<div class="link-box">
									<a href="<?= get_page_link( 17, true ); ?>"
										class="theme-btn btn-style-one" onclick="fbq('track', 'Donate');">
											<span class="btn-title">
												Підтримати
											</span>
									</a>
								</div>
							</div>
						</div>
					</div>
					<div class="image-column col-lg-6 col-md-12 col-sm-12">
						<div class="inner">
							<div class="row clearfix">
								<div class="col-6">
									<div class="fadeInUp m-auto" data-wow-delay="0ms">
										<img class="lazy-image"
											src="<?= get_template_directory_uri(); ?>/assets/images/mission/1_1.jpg"
											data-src="<?= get_template_directory_uri(); ?>/assets/images/mission/1_1.jpg"
											alt="">
									</div>
									<span>Майбутній садочок, місто Ворзель, Бучанський район, Київська область</span>
								</div>
								<div class="col-6">
									<div class="fadeInUp m-auto" data-wow-delay="0ms">
										<img class="lazy-image"
											src="<?= get_template_directory_uri(); ?>/assets/images/mission/1_2.jpg"
											data-src="<?= get_template_directory_uri(); ?>/assets/images/mission/1_2.jpg"
											alt="">
									</div>
									<span>Майбутній садочок, місто Ворзель, Бучанський район, Київська область</span>
								</div>
							</div>
							<div class="row clearfix mt-2">
								<div class="col-6">
									<div class="fadeInUp m-auto" data-wow-delay="0ms">
										<img class="lazy-image"
											src="<?= get_template_directory_uri(); ?>/assets/images/mission/2_1.jpg"
											data-src="<?= get_template_directory_uri(); ?>/assets/images/mission/2_1.jpg"
											alt="">
									</div>
									<span></span>
								</div>
								<div class="col-6">
									<div class="fadeInUp m-auto" data-wow-delay="0ms">
										<img class="lazy-image"
											src="<?= get_template_directory_uri(); ?>/assets/images/mission/2_2.jpg"
											data-src="<?= get_template_directory_uri(); ?>/assets/images/mission/2_2.jpg"
											alt="">
									</div>
									<span></span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

    <section class="causes-section-three">
        <div class="circle-one"></div>
        <div class="circle-two"></div>

        <div class="auto-container">

            <div class="sec-title centered">
                <div class="sub-title text-justify"><?= the_field('acf_causes_sub_title'); ?></div>
                <h2><?= the_field('acf_causes_header'); ?></h2>
                <div class="text text-justify"><?= the_field('acf_causes_past_header'); ?></div>
            </div>

            <div class="carousel-box">
                <div class="slide-item">
                    <div class="cause-block-three">
                        <div class="inner-box clearfix">

                            <div class="image-column">
                                <div class="row" style="height: 100%">
                                    <div class="col-6">
                                        <div class="image-box">
                                            <img class="lazy-image owl-lazy"
                                                 src="<?= the_field('acf_project_first'); ?>"
                                                 data-src="<?= the_field('acf_project_first'); ?>" alt="">
                                        </div>
                                        <div class="bg-image-layer lazy-image"
                                             data-bg="url('<?= the_field('acf_project_first'); ?>"></div>
                                    </div>
                                    <div class="col-6">
                                        <div class="image-box">
                                            <img class="lazy-image owl-lazy"
                                                 src="<?= the_field('acf_project_second'); ?>"
                                                 data-src="<?= the_field('acf_project_second'); ?>" alt="">
                                        </div>
                                        <div class="bg-image-layer lazy-image"
                                             data-bg="url('<?= the_field('acf_project_second'); ?>"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-column">
                                <div class="inner">
                                    <h3>
                                        
                                    </h3>
                                    <div class="text">
													<?= the_field('acf_project_description'); ?>
                                        
                                    </div>
                                    <div class="link-box">
                                        <a href="<?= get_page_link( 17, true ); ?>" class="theme-btn btn-style-one"
                                           onclick="fbq('track', 'Donate');">
                                            <span class="btn-title">Підтримати</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mission-vision">
        <div class="circle-one"></div>
        <div class="circle-two"></div>

        <div class="auto-container">
            <div class="vision">
                <div class="row clearfix">
                    <div class="text-column col-lg-6 col-md-12 col-sm-12">
                        <div class="inner">
                            <div class="sec-title">
                                <div class="sub-title"></div>
                                <h2></h2>
                                <div class="text">
										  		<?= the_field('acf_mission_second_text'); ?>
                                    
                                </div>
                                <div class="link-box">
                                    <a href="<?= get_page_link( 17, true ); ?>"
                                       class="theme-btn btn-style-one" onclick="fbq('track', 'Donate');">
                                        <span class="btn-title">
                                            Підтримати
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="image-column col-lg-6 col-md-12 col-sm-12">
                        <div class="inner p-5">
                            <div class="image wow fadeInLeft" data-wow-delay="0ms">
                                <img class="lazy-image"
                                     src="<?= the_field('acf_collage'); ?>"
                                     data-src="<?= the_field('acf_collage'); ?>"
                                     alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="inner-box">
                <div class="row">
                    <div class="service-block col-xl-3 col-lg-6 col-md-6 col-sm-12">
                        <div class="inner-box">
                            <img src="<?= get_template_directory_uri(); ?>/assets/images/service-1.png" alt="">
                            <div class="text">
									 	<?= the_field('acf_service_block_one'); ?>
                                
                            </div>
                        </div>
                    </div>

                    <!--Service Block-->
                    <div class="service-block col-xl-3 col-lg-6 col-md-6 col-sm-12">
                        <div class="inner-box">
                            <img src="<?= get_template_directory_uri(); ?>/assets/images/service-2.png" alt="">
                            <div class="text">
									 	<?= the_field('acf_service_block_two'); ?>
                            </div>
                        </div>
                    </div>

                    <!--Service Block-->
                    <div class="service-block col-xl-3 col-lg-6 col-md-6 col-sm-12">
                        <div class="inner-box">
                            <img src="<?= get_template_directory_uri(); ?>/assets/images/service-3.png">
                            <div class="text">
									 	<?= the_field('acf_service_block_three'); ?>
                            </div>
                        </div>
                    </div>

                    <!--Service Block-->
                    <div class="service-block col-xl-3 col-lg-6 col-md-6 col-sm-12">
                        <div class="inner-box">
                            <img src="<?= get_template_directory_uri(); ?>/assets/images/service-4.png">
                            <div class="text">
									 	<?= the_field('acf_service_block_four'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="team-section">
        <div class="bottom-rotten-curve"></div>

        <div class="auto-container">

            <div class="sec-title centered">
                <div class="sub-title"></div>
                <h2></h2>
                <div class="text"></div>
            </div>

            <div class="row clearfix">
                
                    <div class="team-block col-xl-4 col-lg-4 col-md-6 col-sm-12">
                        <div class="inner-box wow fadeInUp" data-wow-delay="0ms">
                            <figure class="image-box">
                                <img class="lazy-image"
                                     src="<?= the_field('acf_team_first'); ?>"
                                     data-src="<?= the_field('acf_team_first'); ?>"
                                     alt="">
                            </figure>
                            <div class="lower-box">
                                <div class="content">
                                    
                                    <div class="designation">
												<?= the_field('acf_team_one'); ?>
												
                                    </div>
                                    <div class="social-links">
                                        <ul class="clearfix">
                                            
                                            
                                            
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <div class="team-block col-xl-4 col-lg-4 col-md-6 col-sm-12">
                        <div class="inner-box wow fadeInUp" data-wow-delay="0ms">
                            <figure class="image-box">
                                <img class="lazy-image"
                                     src="<?= the_field('acf_team_second'); ?>"
                                     data-src="<?= the_field('acf_team_second'); ?>"
                                     alt="">
                            </figure>
                            <div class="lower-box">
                                <div class="content">
                                    
                                    <div class="designation">
													<?= the_field('acf_team_two'); ?>
													
                                    </div>
                                    <div class="social-links">
                                        <ul class="clearfix">
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
            </div>
        </div>
    </section>

    
    



<section class="upcoming-events">
    <div class="circle-one"></div>
    <div class="circle-two"></div>

    <div class="auto-container">

        <div class="sec-title centered">
            <div class="sub-title"></div>
            <h2></h2>
            <div class="text"></div>
        </div>

        <div class="related-products-carousel love-carousel owl-theme owl-carousel"
             data-options='{"loop": false, "margin": 30, "autoheight":true, "lazyload":true, "nav": true, "dots": true, "autoplay": true, "autoplayTimeout": 5000, "smartSpeed": 500, "responsive":{ "0" :{ "items": "1" },"600" :{ "items": "1" }, "800" :{ "items" : "2" }, "1024":{ "items" : "3" }, "1366":{ "items" : "3" }}}'>

				 	<?php 
						$front_all_posts = get_posts([
							'numberposts'	=> 15,
							'category'		=> 18
						]);

						if(!empty($front_all_posts)){
							foreach($front_all_posts as $front_post){
	
								$front_post_picture_id = get_post_thumbnail_id( $front_post->ID );
								$front_post_picture= get_post($front_post_picture_id);
								$front_post_link = get_permalink($front_post_picture->ID);
					?>
            
								<div class="shop-item">
									<div class="inner-box">
											<div class="image">
												<a href="<?= get_permalink($front_post->ID); ?>">

												<?= get_the_post_thumbnail( $front_post->ID, 'medium', ['class' => 'lazy-image owl-lazy', 'data-src' => "{$front_post_link}"]); ?>

													<div class="overlay-box">
															<ul class="option-box"></ul>
													</div>
												</a>
												
											</div>
											
									</div>
								</div>
					 <?php }} ?>
           
        </div>
    </div>
</section>

    

    <section class="what-we-do" id="what-we-do">
        <div class="auto-container">
            <div class="inner-box">
                <div class="clearfix"></div>
                
                <div class="bottom-image">
                    <img class="lazy-image mb-4" src="<?= the_field('what_we_do_second_two'); ?>" data-src="<?= the_field('what_we_do_second_two'); ?>" alt="">
                </div>
            </div>
        </div>
    </section>

    <section class="call-to-action">
        <div class="image-layer lazy-image" data-bg="url('<?= get_template_directory_uri(); ?>/images/background/call-to-action-1.jpg')"></div>

        <div class="auto-container">
            <div class="inner">
                <div class="sec-title centered">
                    <div class="sub-title"></div>
                    <h2></h2>
                    <div class="text">
						  		<?= the_field('acf_support_text'); ?>
                        
                    </div>
                    <div class="link-box clearfix">
                        <a href="<?= get_page_link( 17, true ); ?>l" class="theme-btn btn-style-three"
                           onclick="fbq('track', 'Donate');">
                            <span class="btn-title">Підтримати</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>


	 



<?php get_footer(); ?>





