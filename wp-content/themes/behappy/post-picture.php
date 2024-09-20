<?php
/*
Template Name: Малюнок
Template post type: post
*/

get_header(); 

$picture_post_picture_id = get_post_thumbnail_id( $post->ID );		// id миниатюры поста
$picture_post_picture= get_post($picture_post_picture_id);			// данные миниатюры
$picture_post_picture_link = get_permalink($picture_post_picture_id);		// ссылка на пост рисунка

$active_collections = get_posts([
	'post_type' 	=> 'post',
	'category'		=> 17,
	'numberposts' 	=> -1, 
	'orderby' 		=> 'date', 
	'order' 			=> 'DESC',
]);


//$data = get_post(587);
//debug(unserialize($data->post_content));

?>
        
    <section class="page-banner page-banner-small">
        
        <div class="bottom-rotten-curve"></div>

        <div class="auto-container">
            <h1>Малюнок</h1>
        </div>
    </section>

    <section class="product-details">
        <div class="auto-container">
            <!--Basic Details-->
            <div class="basic-details">
                <div class="row clearfix">
                    <div class="image-column col-md-6 col-sm-12">
                        <div class="inner">
                            <div class="image-box">
                                <figure class="image">
										  		<?= get_the_post_thumbnail( $post->ID, 'large', ['class' => 'lazy-image', 'data-src' => "{$picture_post_picture_link}"]); ?>
                                </figure>
                                <a href="<?= $picture_post_picture_link; ?>" class="lightbox-image icon"
                                   title=""><span class="fa fa-search"></span></a>
                            </div>
                        </div>
                        <div class="row mt-2">
                            

                            
                        </div>
                    </div>

                    <div class="info-column col-md-6 col-sm-12">
                        <div class="inner-column">
									<form method="POST" id="donate-form" class="donate-form" action="">
										<input type="hidden" name="csrfmiddlewaretoken" value="eVXvQ9w7gZJkQj2RIv9sGrQLbEFeURuZmHgHlfdGsxPO1bGtr5dUzRUh4h6akAQ6">
										<input type="hidden" name="picture_post" id="id_post" value="<?= $post->ID; ?>">

										<div class="other-options clearfix">
											<div class="form-group">
												<div class="field-label">Цей малюнок є подякою* за ваш благодійний внесок. <br>
													*Для отримання малюнку, вам потрібно оплатити доставку малюнку. <br>
													Вартість доставки:<br>
													- по Україні - <?= $picture_fee['ukraine']['UAH'];?> грн. / <?= $picture_fee['ukraine']['USD']; ?> $ / <?= $picture_fee['ukraine']['EUR']; ?> €<br>
													- до країн Європи - <?= $picture_fee['europe']['UAH'];?> грн. / <?= $picture_fee['europe']['USD']; ?> $ / <?= $picture_fee['europe']['EUR']; ?> € <br>
													<!--- до країн Азії - <?= get_user_meta( 1, 'service-fee-asia', true );?><br>-->
													- до країн Америки - <?= $picture_fee['america']['UAH'];?> грн. / <?= $picture_fee['america']['USD']; ?> $ / <?= $picture_fee['america']['EUR']; ?> € <br>
													Вартість доставки буде автоматично додано до суми вашого внеску. 
													
												</div>
												<br>
												<div class="select-amount clearfix">
													
														<div class="select-box">
																<input type="radio" name="amount_choice"
																		id="amount-choice-0" class="amount_choice" value="25">
																<label for="amount-choice-0">
																	25
																	<span class="currency-value">UAH</span>
																</label>
														</div>
													
														<div class="select-box">
																<input type="radio" name="amount_choice"
																		id="amount-choice-1" class="amount_choice" value="50">
																<label for="amount-choice-1">
																	50
																	<span class="currency-value">UAH</span>
																</label>
														</div>
													
														<div class="select-box">
																<input type="radio" name="amount_choice"
																		id="amount-choice-2" class="amount_choice" value="100">
																<label for="amount-choice-2">
																	100
																	<span class="currency-value">UAH</span>
																</label>
														</div>
													
														<div class="select-box">
																<input type="radio" name="amount_choice"
																		id="amount-choice-3" class="amount_choice" value="500">
																<label for="amount-choice-3">
																	500
																	<span class="currency-value">UAH</span>
																</label>
														</div>
													
												</div>

												<div class="input-box">
													<div class="form-group">
														<div class="row">
																<div class="col-lg-12 col-md-12 col-sm-12 mb-1">
																	
																	<input type="number" name="amount" placeholder="Або введіть самостійно..." id="id_amount" min="0">
																</div>
																<div class="col-lg-12 col-md-12 col-sm-6">
																	
																	<select name="currency" onchange="currencyOnChange(this)" id="id_currency">
																		<option value="USD">USD</option>
																		<option value="UAH" selected>UAH</option>
																		<option value="EUR">EUR</option>
																	</select>
																</div>
														</div>
													</div>

													<div class="text mb-1">
														Заповніть, будь ласка, наступні поля, це вимагається платіжною системою
													</div>

													<div class="row clearfix">
														<div class="col-md-6 col-sm-12 form-group">
															<input type="text" id="first_name" name="firstName" placeholder="Ім'я" required="" maxlength="30" class="">
														</div>

														<div class="col-md-6 col-sm-12 form-group">
															<input type="email" id="email" name="email" placeholder="Ваш Email" required="" maxlength="40" class="">
														</div>

														<div class="col-md-6 col-sm-12 form-group">
															<input type="text" id="last_name" name="lastName" placeholder="Прізвище" required="" maxlength="40" class="">
														</div>

														<div class="col-md-6 col-sm-12 form-group">
															<input type="text" id="phone" name="phone" placeholder="Ваш телефон" required="" maxlength="20" class="">
														</div>

														<div class="col-md-12 col-sm-12 form-group" >
															
															<select name="collection" onchange="" class="" id="collection">
																<option value="" disabled selected>Оберіть, будь ласка, кому хочете допомогти</option>
																<?php 
																	foreach($active_collections as $active_collection){ ?>
																		<option value="<?= $active_collection->ID; ?>"><?= $active_collection->post_title;?></option>
																<?php }?>
															</select>
														</div>

														<div class="col-md-12 col-sm-12 form-group text-left">
															<div class="radio-block">
																<input type="checkbox" id="pay-delivery" name="pay-delivery">
																<label for="pay-delivery">
																		Я хочу отримати малюнок і cплатити за доставку
																</label>
															</div>
														</div>
													</div>

													<div class="row clearfix delivery-address">
														<h4 class="col-md-12 col-sm-12 form-group">Нам потрібна ваша адреса, щоб доставити картину</h4>

														<div class="col-md-12 col-sm-12 form-group">
															<select name="region" onchange="" id="region" class="">
																<option value="" disabled selected>Регіон світу</option>
																<option value="ukraine">Україна</option>
																<option value="europe">Європа</option>
																<option value="america">Америка</option>
															</select>
														</div>

														<div class="col-md-12 col-sm-12 form-group">
															<input type="text" class="" id="delivery_address" name="delivery_address" placeholder="Повна адреса (поштовий індекс, країна, область, місто...)" maxlength="120">
														</div>
													</div>
												</div>

												<button type="button" class="theme-btn btn-style-one add-to-cart mt-4" id="form-picture-button">
													<span class="btn-title">Підтримати</span>
												</button>
												<div class="clearfix"></div>
												<div class="errors small text-danger text-left">
													
												</div>
											</div>
										</div>
									</form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="product-info-tabs">

                <!--Product Tabs-->
                <div class="prod-tabs tabs-box">
                    <!--Tabs Container-->
                    <div class="tabs-content">

                        <!--Tab-->
                        <div class="tab active-tab" id="prod-details">
                            <div class="content">
                                <h3 class="title"></h3>
                                <p>
                                    <?= the_content(); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    

<section class="related-products">
    <div class="auto-container">
        <div class="sec-title">
            
            <h2>Інші малюнки</h2>
        </div>

        <div class="related-products-carousel love-carousel owl-theme owl-carousel"
             data-options='{"loop": false, "margin": 30, "autoheight":true, "lazyload":true, "nav": true, "dots": true, "autoplay": true, "autoplayTimeout": 5000, "smartSpeed": 500, "responsive":{ "0" :{ "items": "1" },"600" :{ "items": "1" }, "800" :{ "items" : "2" }, "1024":{ "items" : "3" }, "1366":{ "items" : "3" }}}'>

            <?php 
				
					$picture_all_posts = get_posts([
						'numberposts'	=> 0,
						'category'		=> 18,
						'numberposts'	=> -1
					]);

					if(!empty($picture_all_posts)){
						foreach($picture_all_posts as $picture_post){

							$picture_post_picture_id = get_post_thumbnail_id( $picture_post->ID );
							$picture_post_picture= get_post($picture_post_picture_id);
							$picture_post_link = get_permalink($picture_post_picture->ID);
					
				?>				
						<div class="shop-item">
							<div class="inner-box">
									<a href="<?= get_permalink($picture_post->ID); ?>">
										<div class="image">

											<?= get_the_post_thumbnail( $picture_post->ID, 'medium', ['class' => 'lazy-image owl-lazy', 'data-src' => "{$picture_post_link}"]); ?>

											<div class="overlay-box">
											</div>
											
										</div>
									</a>
									
							</div>
						</div>

					 <?php }} ?>
            
        </div>
    </div>
</section>




<?php get_footer('picture'); ?>


