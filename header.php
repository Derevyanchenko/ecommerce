<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo wp_get_document_title(); ?></title>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="Sublime project">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--== Google Fonts ==-->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,500,600,700,800" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!--== Start Header Area ===-->
<header id="header-area" class="sticky-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="header-content-wrapper d-flex align-items-center">
                    <div class="header-left-area d-flex align-items-center">
                        <!-- Start Logo Area -->
                        <div class="logo-area">
                            <a href="<?php echo site_url(); ?>">DD Shop</a>
                        </div>
                        <!-- End Logo Area -->

                    </div>

                    <div class="header-mainmenu-area d-none d-lg-block">
                        <!-- Start Main Menu -->
                        <!-- <nav id="mainmenu-wrap"> -->
                            <!-- <ul class="nav mainmenu justify-content-center">
								<li class="dropdown-show"><a class="current" href="index.html">Каталог</a></li>
								<li class="dropdown-show"><a href="#">Страницы</a>
									<ul class="dropdown-nav">
										<li><a href="cart.html">Корзина</a></li>
										<li><a href="checkout.html">Страница оплаты</a></li>
									</ul>
								</li>
									<li class="dropdown-show"><a href="#">Товары</a>
									<ul class="dropdown-nav">
										<li><a href="single-product.html">Простой</a></li>
										<li><a href="single-product-grouped.html">Сгруппированный</a></li>
										<li><a href="single-product-affiliate.html">Внешний/Партнерский</a></li>
													<li><a href="single-product-variable.html">Вариативный</a></li>
									</ul>
								</li>
								<li><a href="#">Блог</a></li>
								<li><a href="#">Контакты</a></li>
							</ul> -->
                        <!-- </nav> -->
                        <?php wp_nav_menu(array(
                            'theme_location'  => 'header_menu',
                            'menu'            => 'top_menu',
                            'container'       => 'nav',
                            'container_id'    => 'mainmenu-wrap',
                            'menu_class'      => 'nav mainmenu justify-content-center',
                        )); ?>
                        <!-- End Main Menu -->
                    </div>

                    <div class="header-right-area d-flex justify-content-end align-items-center">
                        <button class="mini-cart-icon modalActive" data-mfp-src="#miniCart-popup">
                            <i class="fa fa-shopping-cart"></i>
                            <span class="cart-count">
                                <?php
                                   global $woocommerce;
                                   echo $woocommerce->cart->cart_contents_count;
                                ?>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!--== End Header Area ===-->
