<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ecommerce
 */

get_header();
the_post();
if ( is_cart() || is_checkout() ) {
?>


<!-- Start Page Header Wrapper -->
<div class="page-header-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="page-header-content">
                    <h2><?php woocommerce_page_title() ?></h2>
                    <?php woocommerce_breadcrumb(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Page Header Wrapper -->

	<?php
		} 
		the_content(); 
get_footer();
