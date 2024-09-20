<?php
/*
Template Name: Підтримати
*/

$active_collections = get_posts([
	'post_type' 	=> 'post',
	'category'		=> 17,
	'numberposts' 	=> -1, 
	'orderby' 		=> 'date', 
	'order' 			=> 'DESC',
]);

get_header(); ?>

	<section class="donate-section donation-section">
		<div class="auto-container">
			<div class="image-column">
				<div class="row" style="height: 100%">
					<div class="col-6">
						<div class="image-box">
							<img class="lazy-image owl-lazy"
								src="<?= the_field('acf_support_first'); ?>"
								data-src="<?= the_field('acf_support_first'); ?>" alt="">
						</div>
						<div class="bg-image-layer lazy-image" data-bg="url('<?= the_field('acf_support_first'); ?>')">
						</div>
					</div>
					<div class="col-6">
						<div class="image-box">
							<img class="lazy-image owl-lazy"
								src="<?= the_field('acf_support_second'); ?>"
								data-src="<?= the_field('acf_support_second'); ?>" alt="">
						</div>
						<div class="bg-image-layer lazy-image" data-bg="url('<?= the_field('acf_support_second'); ?>')">
						</div>
					</div>
				</div>
			</div>

			<div class="wrapper-box">
				<div class="sec-title centered">
					<h1>Ваш внесок</h1>
					<div class="text">
						Тут Ви можете зробити будь-який благодійний внесок. Кошти збираються на будівництво дитячого саду, в місті Ворзель, Бучанського району, Київської області
					</div>
				</div>
				<div class="donate-form contact-form text-center">
					<form id="donate-form" method="POST" action="">
						<input type="hidden" name="csrfmiddlewaretoken" value="raIbVRFGS6us1MLIfoGbdSpSJI4wgvXEzW1nqXmf4EAWcEpkYYKD6itoClvsGejL">
						
						<div class="form-group">
								<div class="select-amount clearfix">
										
									<div class="select-box">
										<input type="radio" name="amount_choice" id="amount-choice-0" class="amount-choice" value="25">
										<label for="amount-choice-0">
											25
											<span class="currency-value">$</span>
										</label>
									</div>
								
									<div class="select-box">
										<input type="radio" name="amount_choice" id="amount-choice-1" class="amount-choice" value="50">
										<label for="amount-choice-1">
											50
											<span class="currency-value">$</span>
										</label>
									</div>
								
									<div class="select-box">
										<input type="radio" name="amount_choice" id="amount-choice-2" class="amount-choice" value="100">
										<label for="amount-choice-2">
											100
											<span class="currency-value">$</span>
										</label>
									</div>
								
									<div class="select-box">
										<input type="radio" name="amount_choice" id="amount-choice-3" class="amount-choice" value="500">
										<label for="amount-choice-3">
											500
											<span class="currency-value">$</span>
										</label>
									</div>
									
								</div>
						</div>

						<div class="form-group">
								<div class="row">
									<div class="col-lg-9 col-md-9 col-sm-12 mb-2">
										<input type="number" name="amount" placeholder="Або введіть самостійно..." id="id_amount">
									</div>
									<div class="col-lg-9 col-md-9 col-sm-12 mb-2">
										
										<select name="currency" onchange="currencyOnChange(this)" id="id_currency">
											<option value="USD">USD</option>
											<option value="UAH" selected>UAH</option>
											<option value="EUR">EUR</option>
										</select>
										
									</div>

									<div class="col-lg-9 col-md-9 col-sm-12" >
										<select name="collection" onchange="" class="" id="collection">
											<option value="" disabled selected>Оберіть, будь ласка, кому хочете допомогти</option>
											<?php 
												if(!empty($active_collections)){
													foreach($active_collections as $active_collection){ ?>
														<option value="<?= $active_collection->ID; ?>"><?= $active_collection->post_title;?></option>
											<?php } }?>
										</select>
									</div>

								</div>
						</div>

						<div class="form-group">
							<button type="button" class="theme-btn btn-style-one" id="form-donate-button">
								<span class="btn-title">Підтримати</span>
							</button>

							<div class="errors small text-danger text-left">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>

<?php get_footer(); ?>