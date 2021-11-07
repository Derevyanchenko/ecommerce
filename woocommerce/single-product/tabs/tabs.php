<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 *
 * @see woocommerce_default_product_tabs()
 */
$product_tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $product_tabs ) ) : ?>

	<div class="product-description-review">
		<!-- Product Description Tab Menu -->
		<ul class="nav nav-tabs desc-review-tab-menu" id="desc-review-tab" role="tablist">
			<?php foreach ( $product_tabs as $key => $product_tab ) : 
				$tab_link = '';
				if ($key == 'description') {
					$tab_link = "descriptionContent";
				} else if ($key == 'additional_information') {
					$tab_link = "aditionalContent";
				} else {
					$tab_link = "reviewContent";
				}
				// echo $key . '<br>';
			?>
				<li>
					<a href="#<?php echo $tab_link; ?>" data-toggle="tab" role="tab">
						<?php echo wp_kses_post( apply_filters( 'woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key ) ); ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>

		<div class="tab-content" id="myTabContent">
			<?php foreach ( $product_tabs as $keyContent => $product_tab ) : 
				$tab_link_content = '';
				if ($keyContent == 'description') {
					$tab_link_content = "descriptionContent";
				} else if ($keyContent == 'additional_information') {
					$tab_link_content = "aditionalContent";
				} else {
					$tab_link_content = "reviewContent";
				}
			?>
				<div class="tab-pane fade" id="<?php echo $tab_link_content; ?>">
					<?php
					if ( isset( $product_tab['callback'] ) ) {
						call_user_func( $product_tab['callback'], $key, $product_tab );
					}
					?>
				</div>
			<?php endforeach; ?>
		</div>

		<?php do_action( 'woocommerce_product_after_tabs' ); ?>
	</div>

<?php endif; ?>
