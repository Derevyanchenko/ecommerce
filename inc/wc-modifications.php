<?php

if ( ! defined("ABSPATH") ) {
    exit;
}

// add base woo theme support
function ecommerce_add_woocommerce_base() {
    add_theme_support( 'woocommerce', array(
        // 'thumbnail_image_width' => 150,
        // 'single_image_width'    => 300,

        'product_grid'          => array(
            'default_rows'    => 3,
            'min_rows'        => 2,
            'max_rows'        => 8,
            'default_columns' => 4,
            'min_columns'     => 2,
            'max_columns'     => 5,
        ),
    ) );
    
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
}

add_action( 'after_setup_theme', 'ecommerce_add_woocommerce_base' );

// remove basic woo styles
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

// archive product page
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

add_action( 'woocommerce_before_main_content',  'ecommerce_add_banner_wrapper_start',  40);
function ecommerce_add_banner_wrapper_start() {
    ?>
    <!-- Start Page Header Wrapper -->
        <div class="page-header-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="page-header-content">
    <?php
}

remove_action('woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10);
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

add_action( 'woocommerce_archive_description', 'woocommerce_breadcrumb', 0 );

/**
 * Change several of the breadcrumb defaults
 */
add_filter( 'woocommerce_breadcrumb_defaults', 'ecommerce_woocommerce_breadcrumbs' );
function ecommerce_woocommerce_breadcrumbs() {
    return array(
            'delimiter'   => '',
            'wrap_before' => '<nav class="woocommerce-breadcrumb page-breadcrumb" itemprop="breadcrumb"><ul class="d-flex justify-content-center">',
            'wrap_after'  => ' </ul></nav>',
            'before'      => '<li>',
            'after'       => '</li>',
            'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
        );
}

add_action( 'woocommerce_archive_description',  'ecommerce_add_banner_wrapper_end',  5);
function ecommerce_add_banner_wrapper_end() {
    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Header Wrapper -->
<?php
}

// archive product loop grid

// remove divs for main content
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
add_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);

remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action( 'woocommerce_before_shop_loop', 'ecommerce_archive_product_loop_start', 5 );
function ecommerce_archive_product_loop_start() {
    ?>
    <div id="shop-page-wrapper" class="pt-86 pt-md-56 pt-sm-46 pb-50 pb-md-20 pb-sm-10">
        <div class="container">
            <div class="row"> 
    <?php
}

add_action( 'woocommerce_after_shop_loop', 'ecommerce_archive_product_loop_end', 15 );
function ecommerce_archive_product_loop_end() {
    ?>
            </div>
        </div>
    </div>
    <?php
}



// remove sidebar
add_action('woocommerce_before_main_content', 'remove_sidebar' );
function remove_sidebar() {
    if ( is_shop() ) { 
        remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
    }
}

add_action( 'woocommerce_before_shop_loop', 'ecommerce_sidebar_wrap_start', 10 );
function ecommerce_sidebar_wrap_start() {
    ?>
    <div class="col-lg-3 order-last order-lg-first mt-md-54 mt-sm-44">
        <div class="sidebar-area-wrapper">
    <?php
}

/**#####################################################################################
 * Shop Sidebar Filter
 #####################################################################################*/
add_action( 'woocommerce_before_shop_loop', 'ecommerce_shopping_filter_custom', 15 );
function ecommerce_shopping_filter_custom() {
    ?>
    <!-- Start Single Sidebar -->
    <div class="single-sidebar-wrap">
        <h3 class="sidebar-title">Категории товаров</h3>
        <div class="sidebar-body">
            <ul class="sidebar-list">
                <?php 
                    $list_product_categories = get_categories(array(
                        'taxonomy'     => 'product_cat',
                        'orderby'      => 'name',
                        'show_count'   => 1,
                        'pad_counts'   => 0,
                        'hierarchical' => 0,
                        'title_li'     => '',
                        'hide_empty'   => 0
                    ));

                    foreach( $list_product_categories as $cat ) {
                        echo sprintf(
                            '<li><a href="%s">%s <span>(%d)</span></a></li>',
                            get_term_link( (int) $cat->term_id, 'product_cat' ),
                            $cat->cat_name,
                            (int) $cat->category_count
                        );
                    } 
                ?>
            </ul>
        </div>
    </div>
    <!-- End Single Sidebar -->

    <?php 
        $colors_attr = get_terms(array(
            'taxonomy' => 'pa_colors',
            'hide_empty' => false,
            'count' => true,
        ));
        if ( ! empty( $colors_attr ) ) :
        $shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
        if( ! empty( $_GET['min_price'] ) ) {
            $shop_page_url = add_query_arg( 'min_price', $_GET['min_price'], $shop_page_url );
        }
        if( ! empty( $_GET['max_price'] ) ) {
            $shop_page_url = add_query_arg( 'max_price', $_GET['max_price'], $shop_page_url );
        }
        if( ! empty( $_GET['filter_sizes'] ) ) {
            $shop_page_url = add_query_arg( 'filter_sizes', $_GET['filter_sizes'], $shop_page_url );
        }
    ?>
        <!-- Start Single Sidebar -->
        <div class="single-sidebar-wrap">
            <h3 class="sidebar-title">Цвет</h3>
            <div class="sidebar-body">
                <ul class="sidebar-list">
                    <?php
                    foreach( $colors_attr as $color ) {
                        echo sprintf(
                            '<li><a href="%s" class="%s">%s <span>(%d)</span></a></li>',
                            add_query_arg('filter_colors', $color->slug, $shop_page_url),
                            // "?filter_colors={$color->slug}",
                            isset( $_GET['filter_colors'] ) && $_GET['filter_colors'] == $color->slug ? 'active' : '',
                            $color->name,
                            (int) $color->count
                        );    
                    } 
                    ?>
                </ul>
            </div>
        </div>
        <!-- End Single Sidebar -->
    <?php endif; ?>

    <!-- Start Single Sidebar -->
    <div class="single-sidebar-wrap">
        <h3 class="sidebar-title">Цены</h3>
        <div class="sidebar-body">
            <div class="price-range-wrap">
                <!-- ?min_price=170&max_price=1000 -->
                <?php
                    // echo '<pre>';
                    // var_dump($products);
                    // echo '</pre>';
                    // wp_die();
                ?>
                
                <div class="price-range" data-min="10" data-max="1000"></div>
                <div class="range-slider">
                    <form  method="get" action="" id="price_filter">
                        <label for="amount">Цена: </label>
                        <input type="text" id="amount" />
                        <input type="hidden" id="min_price" name="min_price" value="<?php echo isset( $_GET['min_price'] ) ? intval( $_GET['min_price'] ) : 10; ?>" />
                        <input type="hidden" id="max_price" name="max_price" value="<?php echo isset( $_GET['max_price'] ) ? intval( $_GET['max_price'] ) : 1000; ?>" />

                        <?php echo wc_query_string_form_fields( null, array( 'min_price', 'max_price', 'paged' ), '', true ); ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Single Sidebar -->

    <?php 
        $sizes_attr = get_terms(array(
            'taxonomy' => 'pa_sizes',
            'hide_empty' => false,
            'count' => true,
        ));
        if ( ! empty( $sizes_attr ) ) :
        
        $shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
        if( ! empty( $_GET['min_price'] ) ) {
            $shop_page_url = add_query_arg( 'min_price', $_GET['min_price'], $shop_page_url );
        }
        if( ! empty( $_GET['max_price'] ) ) {
            $shop_page_url = add_query_arg( 'max_price', $_GET['max_price'], $shop_page_url );
        }
        if( ! empty( $_GET['filter_colors'] ) ) {
            $shop_page_url = add_query_arg( 'filter_colors', $_GET['filter_colors'], $shop_page_url );
        }
    ?>
        <!-- Start Single Sidebar -->
        <div class="single-sidebar-wrap">
            <h3 class="sidebar-title">Размер</h3>
            <div class="sidebar-body">
                <ul class="size-list">
                <?php
                    foreach( $sizes_attr as $size ) {
                        echo sprintf(
                            '<li><a href="%s" class="%s">%s</a></li>',
                            add_query_arg('filter_sizes', $size->slug, $shop_page_url),
                            // "?filter_sizes={$size->slug}",
                            isset( $_GET['filter_sizes'] ) && $_GET['filter_sizes'] == $size->slug ? 'active' : '',
                            $size->name
                        );    
                    } 
                ?>
                </ul>
            </div>
        </div>
        <!-- End Single Sidebar -->
    <?php endif; ?>

    <?php
        $product_tags = get_terms( 'product_tag' );
        if ( ! empty($product_tags) ) :
    ?>
    <!-- Start Single Sidebar -->
    <div class="single-sidebar-wrap">
        <h3 class="sidebar-title">Теги</h3>
        <div class="sidebar-body">
            <ul class="tags-cloud">
                <?php 
                    foreach ($product_tags as $tag) {
                        echo sprintf(
                            '<li><a href="%s">%s</a></li>',
                            get_term_link( (int) $tag->term_id, 'product_tag' ),
                            $tag->name
                        );
                    }
                ?>
            </ul>
        </div>
    </div>
    <!-- End Single Sidebar -->
    <?php 
    endif;
}

add_action( 'woocommerce_before_shop_loop', 'ecommerce_sidebar_wrap_end', 20 );
function ecommerce_sidebar_wrap_end() {
    ?>
        </div>
    </div>
    <?php
}

/***
 *  Content product (shop page card)
 ***/ 

add_action( 'woocommerce_before_shop_loop_item', 'ecommerce_image_wrapper_start', 5 );
function ecommerce_image_wrapper_start() {
    echo '<figure class="product-thumbnail">';
}

remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
add_action( 'woocommerce_before_shop_loop_item', 'ecommerce_woocommerce_template_loop_product_link_open', 9 );
function ecommerce_woocommerce_template_loop_product_link_open() {
    ?>
        <a href="<?php the_permalink(); ?>" class="d-block">
    <?php
}

remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
add_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_thumbnail', 10 );

add_action( 'woocommerce_before_shop_loop_item', 'ecommerce_woocommerce_template_loop_product_link_close', 11 );
function ecommerce_woocommerce_template_loop_product_link_close() {
   echo '<a/>';
}

remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );

add_action( 'woocommerce_before_shop_loop_item', 'ecommerce_wrapper_for_add_to_cart_and_sale_start', 15 );
function ecommerce_wrapper_for_add_to_cart_and_sale_start() {
    echo '<figcaption class="product-hvr-content">';
}

remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
add_action( 'woocommerce_before_shop_loop_item', 'ecommerce_add_to_cart', 20 );
function ecommerce_add_to_cart() {
    global $product;
    echo apply_filters(
        'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
        sprintf(
            '<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
            esc_url( $product->add_to_cart_url() ),
            esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
            esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ) . ' btn btn-black btn-addToCart',
            isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
            esc_html( $product->add_to_cart_text() )
        ),
        $product,
        $args
    );
}

add_action( 'woocommerce_before_shop_loop_item', 'ecommerce_custom_sale_flash', 25 );
function ecommerce_custom_sale_flash() {
    global $post, $product;
    if ( $product->is_on_sale() ) : 
        echo apply_filters( 'woocommerce_sale_flash', '<span class="product-badge sale">' . esc_html__( 'Sale!', 'woocommerce' ) . '</span>', $post, $product ); 
    endif;
}

add_action( 'woocommerce_before_shop_loop_item', 'ecommerce_wrapper_for_add_to_cart_and_sale_end', 30 );
function ecommerce_wrapper_for_add_to_cart_and_sale_end() {
    echo '</figcaption>';
}

add_action( 'woocommerce_before_shop_loop_item_title', 'ecommerce_image_wrapper_end', 40 );
function ecommerce_image_wrapper_end() {
    echo '</figure>';
}

add_action( 'woocommerce_shop_loop_item_title', 'ecommerce_content_wrapper_start', 5 );
function ecommerce_content_wrapper_start() {
    echo '<div class="product-details">';
}

remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
add_action( 'woocommerce_shop_loop_item_title', 'ecommerce_custom_woocommerce_template_loop_product_title', 10 );
function ecommerce_custom_woocommerce_template_loop_product_title() {
    ?>
        <h2 class="product-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php
}

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
add_action( 'woocommerce_shop_loop_item_title', 'ecommerce_custom_price_wrapper_start', 15 );
function ecommerce_custom_price_wrapper_start() {
    echo '<div class="product-prices">';
}

add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_price', 20 );

add_action( 'woocommerce_shop_loop_item_title', 'ecommerce_custom_price_wrapper_end', 25 );
function ecommerce_custom_price_wrapper_end() {
    echo '</div>';
}

add_action( 'woocommerce_shop_loop_item_title', 'ecommerce_text_info_wrapper_start', 30 );
function ecommerce_text_info_wrapper_start() {
    echo '<div class="list-view-content">';
}

add_action( 'woocommerce_shop_loop_item_title', 'ecommerce_text_info', 35 );
function ecommerce_text_info() {
    if ( get_the_content() ) { ?>
    <p class="product-desc"><?php the_content(); ?></p>
  <?php }
}

add_action( 'woocommerce_shop_loop_item_title', 'ecommerce_text_info_btn', 40 );
function ecommerce_text_info_btn() {
    global $product;
    echo '<div class="list-btn-group mt-30 mt-sm-14">';
    echo apply_filters(
        'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
        sprintf(
            '<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
            esc_url( $product->add_to_cart_url() ),
            esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
            esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ) . ' btn btn-black',
            isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
            esc_html( $product->add_to_cart_text() )
        ),
        $product,
        $args
    );
    echo '</div>';
}

add_action( 'woocommerce_shop_loop_item_title', 'ecommerce_text_info_wrapper_end', 40 );
function ecommerce_text_info_wrapper_end() {
    echo '</div>';
}


add_action( 'woocommerce_after_shop_loop_item', 'ecommerce_content_wrapper_end', 15 );
function ecommerce_content_wrapper_end() {
    echo '</div>';
}

remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
