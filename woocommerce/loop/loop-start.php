<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!--== Start Shop Page Wrapper ==-->
<div class="col-lg-9">

	<!-- Start Product Config Area -->
	<?php woocommerce_output_all_notices(); ?>
	 <div class="product-config-area d-md-flex justify-content-between align-items-center">
		<div class="product-config-left d-sm-flex">
			<p>
				<?php woocommerce_result_count(); ?>
			</p>
		</div> 
		

		<div class="product-config-right d-flex align-items-center mt-sm-14">
			<ul class="product-view-mode">
				<li data-viewmode="grid-view" class="active"><i class="fa fa-th"></i></li>
				<li data-viewmode="list-view"><i class="fa fa-list"></i></li>
			</ul>
			<ul class="product-filter-sort">
				<li class="dropdown-show sort-by">
					<button class="arrow-toggle">Сортировать по</button>
					<ul class="dropdown-nav">
						<li><a href="?orderby=date" class="<?php echo $_GET['orderby'] == 'date' ? 'active' : ''; ?>">Сначала новые</a></li>
						<li><a href="?orderby=popularity" class="<?php echo $_GET['orderby'] == 'popularity' ? 'active' : ''; ?>">По популярности</a></li>
						<li><a href="?orderby=rating" class="<?php echo $_GET['orderby'] == 'rating' ? 'active' : ''; ?>">По среднему рейтингу</a></li>
						<li><a href="?orderby=price" class="<?php echo $_GET['orderby'] == 'price' ? 'active' : ''; ?>">По цене &uarr;</a></li>
						<li><a href="?orderby=price-desc" class="<?php echo $_GET['orderby'] == 'price-desc' ? 'active' : ''; ?>">По цене &darr;</a></li>
					</ul>
				</li>
			</ul>
			
		</div>
	</div>
	<!-- End Product Config Area -->

	<div class="shop-page-products-wrapper mt-44 mt-sm-30">
			<div class="products-wrapper products-on-column">
				<div class="row">