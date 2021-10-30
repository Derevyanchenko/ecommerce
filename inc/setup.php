<?php 

if ( ! defined("ABSPATH") ) {
    exit;
}


if ( ! function_exists( 'ecommerce_setup' ) ) :

	function ecommerce_setup() {

		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		/* 
		* register menus
		*/
		register_nav_menus(
			array(
				'header_menu' => 'Меню в шапке',
				'footer_1' => 'Футер 1: Каталог',
				'footer_2' => 'Футер 2: Страницы',
				'footer_3' => 'Футер 3: Товары',
			) 
		);

		/* 
		* remove
		*/

	}
endif;
add_action( 'after_setup_theme', 'ecommerce_setup' );