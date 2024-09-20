<!DOCTYPE html>
<html lang="en">
<head>
	<!--
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-08PKG7RCGD"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'G-08PKG7RCGD');
    </script>  -->
    <meta charset="utf-8">
    <meta name="facebook-domain-verification" content="l1v479r3uqc2ml5rt4a5z9vzwha9ku"/>
    <title>Благодійний фонд «Крок до щастя»</title>
<!--
    <link rel="shortcut icon" href="https://behappyua.com/assets/images/favicon.png" type="image/x-icon">
    <link rel="icon" href="https://behappyua.com/assets/images/favicon.png" type="image/x-icon">
-->
    <meta name="ahrefs-site-verification" content="e312e6dc2560d3b5a5cab8efe20172aa77a5c81ccf009670edd09f64a52c6135">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
    <!--[if lt IE 9]>
    <script src="/assets/js/respond.js"></script><![endif]-->
    
    

    <!-- Meta Pixel Code 
    <script>
        !function (f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function () {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '749959689738509');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
                   src="https://www.facebook.com/tr?id=749959689738509&ev=PageView&noscript=1"
    /></noscript>  -->
    <!-- End Meta Pixel Code -->
    <!-- Meta Pixel Code 
    
    <script>
        !function (f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function () {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '1132558304009638');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
                   src="https://www.facebook.com/tr?id=1132558304009638&ev=PageView&noscript=1"
    /></noscript>  -->
    <!-- End Meta Pixel Code -->

	 <?php wp_head(); ?>
</head>

<body>

    <div class="page-wrapper">
        <div class="preloader">
            <div class="icon"></div>
        </div>

			<header class="main-header">
            
				<div class="header-top">
					<div class="auto-container">
						<div class="inner clearfix">
								<div class="top-right">
									<ul class="info clearfix">
										<li>
												<a href="tel:<?= trim(str_replace(" ", "", get_user_meta( 1, 'service_phone', true )));?>">
													<span class="icon fa fa-phone-alt"></span>
													Зателефонувати: &nbsp;<?= get_user_meta( 1, 'service_phone', true );?>
												</a>
										</li>
										<li>
												<a href="mailto:<?= get_user_meta( 1, 'service_email', true );?>">
													<span class="icon fa fa-envelope"></span>
													Email: &nbsp;<?= get_user_meta( 1, 'service_email', true );?>
												</a>
										</li>
									</ul>
								</div>
						</div>
					</div>
				</div>

				<div class="header-upper">
					<div class="auto-container">
						<div class="inner-container clearfix">
							<!--Logo-->
							<div class="logo-box">
								<div class="logo">
									<?php the_custom_logo(); ?>
								</div>
							</div>

							<!--Nav Box-->
							<div class="nav-outer clearfix">
								<!--Mobile Navigation Toggler-->
								<div class="mobile-nav-toggler"><span class="icon flaticon-menu-1"></span></div>

								<!-- Main Menu -->
								<nav class="main-menu navbar-expand-md navbar-light">
									<div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
										<?php wp_nav_menu( [									
											'theme_location'  => '',			
											'menu'            => 'Main menu',
											'container'       => 'ul',
											'container_class' => '',
											'container_id'    => '',
											'menu_class'      => 'navigation clearfix',
											'menu_id'         => '',
											'echo'            => true,
											'fallback_cb'     => 'wp_page_menu',
											'before'          => '',
											'after'           => '',
											'link_before'     => '',
											'link_after'      => '',
											'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
											'depth'           => 0,
											'walker'          => '',
										] ); ?>

									</div>
								</nav>

								<div class="link-box clearfix">
									<div class="donate-link">
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
            

				<!-- Sticky Header  -->
				<div class="sticky-header">
					<div class="auto-container clearfix">
						<!--Logo-->
						<div class="logo pull-left">
							<?php the_custom_logo(); ?>
						</div>
						<!--Right Col-->
						<div class="pull-right">
								<!-- Main Menu -->
								<nav class="main-menu clearfix">
									<!--Keep This Empty / Menu will come through Javascript-->
								</nav><!-- Main Menu End-->
						</div>
					</div>
				</div><!-- End Sticky Menu -->

				<!-- Mobile Menu  -->
				<div class="mobile-menu">
						<div class="menu-backdrop"></div>
						<div class="close-btn"><span class="icon flaticon-cancel"></span></div>

						<nav class="menu-box">
							<div class="nav-logo">
								<?php the_custom_logo(); ?>
							</div>
							<div class="menu-outer">
								<!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
						</nav>
				</div><!-- End Mobile Menu -->
			</header>