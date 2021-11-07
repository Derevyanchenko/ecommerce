<?php
/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.3.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! comments_open() ) {
	return;
}

?>
<div class="product-ratting-wrap">
	<?php
		$count = $product->get_review_count();
		if ( $count && wc_review_ratings_enabled() ) { ?>
			<div class="pro-avg-ratting">
				<h4><?php echo $product->get_average_rating() ?> <span>(всего)</span></h4>
				<span>На основании <?php echo $count ?> отзывов</span>
			</div>
		<?php } ?>

		<?php if( $reviews = get_comments( array( 'status' => 'approve', 'type' => 'review', 'post_id' => $product->get_id() ) ) ) : ?>
			<div class="rattings-wrapper">

				<?php foreach( $reviews as $comment ) : ?>
					<div class="sin-rattings">
						<div class="ratting-author">
							<h3><?php echo $comment->comment_author ?></h3>

							<?php if( $rating = get_comment_meta( $comment->comment_ID, 'rating', true ) ) : ?>
								<div class="ratting-star">
									<?php
										$stars = 0;
										while( $stars < $rating ) {

										echo '<i class="fa fa-star"></i>';
											$stars++;

										}
									?>
									<span>(<?php echo $rating ?>)</span>
								</div>
							<?php endif; ?>

						</div>
						<p><?php echo get_comment_text( $comment->comment_ID ) ?></p>
					</div>
				<?php endforeach; ?>

			</div>
		<?php endif; ?>
		<?php if( is_user_logged_in() ) : ?>
			<div class="ratting-form-wrapper">
				<h3>Добавить свой отзыв</h3>
				<form action="<?php echo site_url( 'wp-comments-post.php' ) ?>" method="post">
					<div class="ratting-form row">
						<div class="col-12 mb-16">
							<h5>Рейтинг:</h5>
							<div class="ratting-star fix">
								<i class="change-star fa fa-star" data-value="1"></i>
								<i class="change-star fa fa-star" data-value="2"></i>
								<i class="change-star fa fa-star" data-value="3"></i>
								<i class="change-star fa fa-star" data-value="4"></i>
								<i class="change-star fa fa-star" data-value="5"></i>
							</div>
							<div style="display:none">
								<select name="rating">
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
								</select>
							</div>
						</div>
						<div class="col-12">
							<label for="your-review">Что думаете:</label>
							<textarea name="comment" id="your-review"
									placeholder="Write a review"></textarea>
						</div>
						<div class="col-12 mt-22">
							<button class="btn btn-black">Отправить</button>
							<?php
								comment_id_fields();
								do_action( 'comment_form', $product->get_id() );

							?>
						</div>
					</div>
				</form>
			</div>
		<?php endif; ?>
	</div>
</div>


