<?php
/**
 * Checkout coupon form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-coupon.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.4
 */

defined( 'ABSPATH' ) || exit;

if ( ! wc_coupons_enabled() ) { // @codingStandardsIgnoreLine.
	return;
}

?>

<div class="checkout-page-coupon-area">
	<div class="checkoutAccordion" id="checkOutAccordion">
		<div class="card">
			<h3><?php echo apply_filters( 'woocommerce_checkout_coupon_message', esc_html__( 'Have a coupon?', 'woocommerce' ) . ' <span data-toggle="collapse" data-target="#couponaccordion">' . esc_html__( 'Click here to enter your code', 'woocommerce' ) . '</span>' ); ?> </h3>

			<div id="couponaccordion" class="collapse" data-parent="#checkOutAccordion">

				<div class="card-body">
					<div class="apply-coupon-wrapper">
						<p><?php esc_html_e( 'If you have a coupon code, please apply it below.', 'woocommerce' ); ?></p>

						<form action="#" class="woocommerce-form-coupon" method="post">
							<input type="text" name="coupon_code" class="input-text" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" id="coupon_code" value="" />
							<button type="submit" class="button btn btn-black" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_html_e( 'Apply coupon', 'woocommerce' ); ?></button>
						</form>

					</div>
				</div>

			</div>
		</div>		
	</div>
</div>
