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
?>

	<main id="primary" class="site-main">
		<div class="page-single" style="padding: 100px 0;">
			<div class="container">
				<?php woocommerce_content(); ?>
			</div>
		</div>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
