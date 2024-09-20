<?php
/*
Template Name: Малюнок
Template post type: post
*/

get_header(); 

$picture_post_picture_id = get_post_thumbnail_id( $post->ID );
$picture_post_picture= get_post($picture_post_picture_id);
?>
        
    <section class="page-banner page-banner-small">
        
        <!--<div class="image-layer lazy-image" data-bg="url('/static/images/background/bg-banner-1.jpg')"></div>-->
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
										  		<?= get_the_post_thumbnail( $post->ID, 'large', ['class' => 'lazy-image', 'data-src' => "{$picture_post_picture->guid}"]); ?>
                                    <!--<img class="lazy-image"
                                         src="../../media/war_pictures/2022-09-09_01.19.03.jpg"
                                         data-src="/media/war_pictures/2022-09-09_01.19.03.jpg"
                                         alt="Image of Крила">-->
                                </figure>
                                <a href="<?= $picture_post_picture->guid ?>" class="lightbox-image icon"
                                   title=""><span class="fa fa-search"></span></a>
                            </div>
                        </div>
                        <div class="row mt-2">
                            

                            
                        </div>
                    </div>

                    <div class="info-column col-md-6 col-sm-12">
                        <div class="inner-column">
                            
                                <!--<div class="details-header">
                                    <h3>Крила</h3>
                                </div>-->
                            

                            
                              <!--<div class="text">1</div>-->
                            


<form method="POST" id="donate-form" class="donate-form">
    <input type="hidden" name="csrfmiddlewaretoken" value="eVXvQ9w7gZJkQj2RIv9sGrQLbEFeURuZmHgHlfdGsxPO1bGtr5dUzRUh4h6akAQ6">
    <input type="hidden" name="picture" id="id_picture">

    <div class="other-options clearfix">
        <div class="form-group">
            <div class="field-label">Цей малюнок є подякою* за ваш благодійний внесок. <br>
					*Для отримання малюнку, вам потрібно оплатити доставку малюнку. <br>
					Вартість доставки:<br>
					- до країн Європи - <?= get_user_meta( 1, 'service_fee_europe', true );?> грн. / $ / € <br>
					<!--- до країн Азії - <?= get_user_meta( 1, 'service_fee_asia', true );?><br>-->
					- до країн Америки - <?= get_user_meta( 1, 'service_fee_america', true );?> грн. / $ / € <br>
					<br>
					Вартість доставки буде автоматично додано до суми вашого внеску. 
					
				</div>
            <div class="select-amount clearfix">
                
                    <div class="select-box">
                        <input type="radio" name="amount_choice"
                               id="amount-choice-0" value="25">
                        <label for="amount-choice-0">
                            25
                            <span class="currency-value">UAH</span>
                        </label>
                    </div>
                
                    <div class="select-box">
                        <input type="radio" name="amount_choice"
                               id="amount-choice-1" value="50">
                        <label for="amount-choice-1">
                            50
                            <span class="currency-value">UAH</span>
                        </label>
                    </div>
                
                    <div class="select-box">
                        <input type="radio" name="amount_choice"
                               id="amount-choice-2" value="100">
                        <label for="amount-choice-2">
                            100
                            <span class="currency-value">UAH</span>
                        </label>
                    </div>
                
                    <div class="select-box">
                        <input type="radio" name="amount_choice"
                               id="amount-choice-3" value="500">
                        <label for="amount-choice-3">
                            500
                            <span class="currency-value">UAH</span>
                        </label>
                    </div>
                
            </div>

            <div class="input-box">
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-9 col-md-9 col-sm-12 mb-1">
                            
                            <input type="number" name="amount" placeholder="Або введіть самостійно..." id="id_amount">
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-6">
                            
                            <select name="currency" onchange="currencyOnChange(this)" id="id_currency">
  <option value="USD">USD</option>

  <option value="UAH" selected>UAH</option>

  <option value="EUR">EUR</option>

</select>
                        </div>
                    </div>
                </div>

                <button type="submit" class="theme-btn btn-style-one add-to-cart mt-4">
                    <span class="btn-title">Підтримати</span>
                </button>
                <div class="clearfix"></div>
                <div class="errors small text-danger text-left"></div>
            </div>
        </div>
    </div>
</form>



<div id="payment-details-block" style="display:none;">
    <div class="sec-title centered mb-0">
        <h2>
            Ваш внесок<br>
            <span id="amount"></span>
            <span id="currency"></span>
        </h2>

        <div class="text mb-1">
            Заповніть, будь ласка, наступні поля, це вимагається платіжною системою
        </div>
    </div>

    <form method="POST" action="index.html" id="payment-details-form" class="contact-form">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12 form-group">
                <input type="text" id="first_name" name="firstName" placeholder="First name" required="">
            </div>

            <div class="col-md-6 col-sm-12 form-group">
                <input type="email" id="email" name="email" placeholder="Your Email" required="">
            </div>

            <div class="col-md-6 col-sm-12 form-group">
                <input type="text" id="last_name" name="lastName" placeholder="Last name" required="">
            </div>

            <div class="col-md-6 col-sm-12 form-group">
                <input type="text" id="phone" name="phone" placeholder="Your Phone" required="">
            </div>

            <h4 class="mb-2 ml-1">Нам треба вашу адресу, щоб доставити картину</h4>

            <div class="col-md-6 col-sm-12 form-group">
                <input type="text" id="delivery_country" name="delivery_country" placeholder="Країна">
            </div>

            <div class="col-md-6 col-sm-12 form-group">
                <input type="text" id="delivery_state" name="delivery_state" placeholder="Область">
            </div>

            <div class="col-md-12 col-sm-12 form-group">
                <input type="text" id="delivery_address" name="delivery_address" placeholder="Адреса">
            </div>

            <div class="col-12 delivery-amount-block">
                <button id="calculate-delivery" class="theme-btn btn-style-two"
                        type="button"
                        style="line-height: 16px;"
                        onclick="calculateDeliveryFee()"
                >
                    <span class="btn-title">Розрахувати вартість доставки</span>
                </button>
                <div class="delivery-errors small text-danger text-left"></div>
                <p>
                    Вартість доставки
                    <strong>
                        <span id="delivery-amount"></span>
                    </strong>
                </p>
            </div>

            <div class="col-md-12 col-sm-12 form-group text-left">
                <div class="radio-block">
                    <input type="checkbox" id="pay-delivery" name="pay-delivery" disabled>
                    <label for="pay-delivery">
                        Я хочу отримати малюнок і оплатити доставку
                    </label>
                </div>
            </div>

            <div class="col-md-12 col-sm-12 form-group text-center">
                <button class="theme-btn btn-style-one" type="submit">
                    <span class="btn-title">Підтримати</span>
                </button>
            </div>
        </div>
    </form>
</div>


                            
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
					
				?>				
						<div class="shop-item">
							<div class="inner-box">
									<a href="<?= $picture_post->guid ?>">
										<div class="image">

											<?= get_the_post_thumbnail( $picture_post->ID, 'medium', ['class' => 'lazy-image owl-lazy', 'data-src' => "{$picture_post_picture->guid}"]); ?>

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


