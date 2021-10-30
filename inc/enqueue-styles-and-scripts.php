<?php 

/**
 * Enqueue scripts and styles.
 */

// styles

function ecommerce_styles()
{
    wp_enqueue_style('ecommerce-style', get_stylesheet_uri());

    wp_enqueue_style('ecommerce-bootstrap', get_template_directory_uri() . "./assets/css/vendor/bootstrap.min.css");
    wp_enqueue_style('ecommerce-font', get_template_directory_uri() . "./assets/css/vendor/font-awesome.css");
    wp_enqueue_style('ecommerce-icon', get_template_directory_uri() . "./assets/css/vendor/dl-icon.css");
    wp_enqueue_style('ecommerce-plugins', get_template_directory_uri() . "./assets/css/plugins.css");
    wp_enqueue_style('ecommerce-helper', get_template_directory_uri() . "./assets/css/helper.min.css");
    wp_enqueue_style('ecommerce-main', get_template_directory_uri() . "./assets/css/style.css");
}

function ecommerce_scripts()
{
    wp_deregister_script('jquery');
    wp_enqueue_script('jquery', get_template_directory_uri() . './assets/js/jquery-3.3.1.min.js', array(), null, true);

    wp_enqueue_script("ecommerce-bootstrap", get_template_directory_uri() . "./assets/js/bootstrap.min.js", array("jquery"), "", true);
    wp_enqueue_script("ecommerce-plugins", get_template_directory_uri() . "./assets/js/plugins.js", array("jquery"), "", true);
    wp_enqueue_script("ecommerce-main", get_template_directory_uri() . "./assets/js/scripts.js", array("jquery"), "", true);

    wp_localize_script('ecommerce-main', 'ajax_object',
        array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'templ_dir_uri' => get_template_directory_uri(),
            'uploads_dir_uri' => wp_upload_dir()['baseurl'],
            'home_url' => home_url()
        )
    );

    wp_deregister_style( 'woocommerce-general' );
    wp_deregister_style( 'woocommerce-layout' );
}

add_action('wp_enqueue_scripts', 'ecommerce_styles');
add_action('wp_enqueue_scripts', 'ecommerce_scripts');