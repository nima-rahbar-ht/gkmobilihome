<?php
/**
 * Single Product Rating
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

?>
<div class="star-rating star-rating--alt">
	<?php if(get_option( 'woocommerce_enable_review_rating' ) === 'yes'): ?>
	<div class="star-rating__stars">
		<?php for ($i = 1; $i <= 5; $i++): ?>
			<i class="star-rating__star <?php if ($i <= $product->get_average_rating()): ?>star-rating__star--active<?php endif ?>"
			title="<?php echo esc_attr($product->get_average_rating()) . esc_attr(' out of 5 stars', 'saleszone') ?>">
				<?php premmerce_the_svg('star') ?>
			</i>
		<?php endfor ?>
	</div>
	<?php endif; ?>
	<div class="star-rating__avg">
		<?php echo number_format((float)$product->get_average_rating(), 1, '.', ''); ?>
	</div>
</div>
