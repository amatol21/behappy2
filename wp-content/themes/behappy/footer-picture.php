
<footer class="main-footer">
            <div class="auto-container">
                <!--Widgets Section-->
                <div class="widgets-section">
                    <div class="row clearfix">
                        <div class="column col-lg-3 col-md-6 col-sm-12">
                            <div class="footer-widget logo-widget">
                                <div class="widget-content text-center">
                                    <div class="footer-logo">
                                        <a href="index.html">
													 	<?php the_custom_logo(); ?>
                                        </a>
                                    </div>
                                    <div class="donate-link">
                                        <a href="<?= get_page_link( 17, true ); ?>" class="theme-btn btn-style-one"
                                           onclick="fbq('track', 'Donate');">
                                            <span class="btn-title">Підтримати</span>
                                        </a>
                                    </div>
                                    <ul class="social-links clearfix">
                                        <li>
                                            <a href="https://instagram.com/dogoodukr">
                                                <span class="fab fa-instagram"></span>
                                            </a>
                                        </li>
                                        <li><a href="https://www.facebook.com/sepstohappiness"><span
                                                class="fab fa-facebook-f"></span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="column col-lg-2 col-md-6 col-sm-12">
                            <div class="footer-widget links-widget">
                                <div class="widget-content">
                                    <h3>Сторінки</h3>
                                    <ul>
                                        <li><a href="<?= get_page_link( 11, true ); ?>">Про нас</a></li>
                                        <li><a href="<?= get_page_link( 15, true ); ?>">Документи</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        

                        <div class="column col-lg-4 col-md-6 col-sm-12">
                            <div class="footer-widget news-widget">
                                <div class="widget-content">
                                    <h3>Малюнки</h3>

                                    <div class="row">

													<?php 
														$footer_posts = get_posts([
															'category'		=> 18,
															'numberposts'	=> 6
														]);
												
														if(!empty($footer_posts)){
															foreach($footer_posts as $footer_post){
																$footer_post_picture_id = get_post_thumbnail_id( $footer_post->ID );
																$footer_post_picture= get_post($footer_post_picture_id);
																$footer_post_link = get_permalink($footer_post_picture->ID);
														?>
																<div class="col-6" >
																		<a href="<?= get_permalink($footer_post->ID); ?>">
																			<?= get_the_post_thumbnail( $footer_post->ID, 'thumbnail', ['class' => 'lazy-image footer_thumbnail', 'data-src' => "{$footer_post_link}"]); ?>
																		</a>
																</div>
													<?php } } ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="column col-lg-3 col-md-6 col-sm-12">
                            <div class="footer-widget info-widget">
                                <div class="widget-content">
                                    <h3>Контакти</h3>
                                    <ul class="contact-info">
                                        <li>01024, Рогнідинська вулиця 13/1, Київ, Україна</li>
                                        <li><a href="tel:<?= trim(str_replace(" ", "", get_user_meta( 1, 'service_phone', true )));?>"><?= get_user_meta( 1, 'service_phone', true );?></a></li>
                                        <li><a href="mailto:<?= get_user_meta( 1, 'service_email', true );?>"><?= get_user_meta( 1, 'service_email', true );?></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="auto-container">

                    <div class="clearfix">
                        <div class="copyright">BeHappyUA &copy; 2024 All Right Reserved</div>
                        <ul class="bottom-links">
                            <li><a href="<?= get_page_link( 514, true ); ?>">Terms of Service</a></li>
                            <li><a href="<?= get_page_link( 3, true ); ?>">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    



<div class="scroll-to-top scroll-to-target" data-target="html"><span class="flaticon-up-arrow"></span></div>



<?php wp_footer(); ?>
</body>
</html>