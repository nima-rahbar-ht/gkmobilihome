<?php use Premmerce\ProductBundles\Bundle\BundleProduct;
use Premmerce\SDK\V2\FileManager\FileManager;

if (!defined('ABSPATH')) {
	exit;
}
/**
 * Available vars
 *
 * @var int $bundleId
 * @var BundleProduct $product
 * @var FileManager $fileManager
 */

?>

<article class="product-bundle__product">
	<div class="product-bundle__product-vertical-slider" data-variation-vertical-slider-scope>
		<?php $cnt = 0; ?>
		<div class="product-bundle__slider" data-variation-vertical-slider>

			<?php
			foreach ($product->getWcProduct()->get_available_variations() as $variation) :

				$product->selectVariation($variation['variation_id']);
				$variant = wc_get_product($variation['variation_id']);
				?>

				<div class="product-bundle__product-vertical-slide <?php echo $cnt > 0 ? 'hidden':''; ?>"
					 data-variation-vertical-slider-item
					 data-variation-bundle-id="<?php echo esc_attr($bundleId); ?>"
					 data-variation-product-id="<?php echo esc_attr($variant->get_parent_id()); ?>"
					 data-variation="<?php echo wp_kses_post(htmlspecialchars( wp_json_encode( $variation ) )); ?>"
				>
					<div class="product-bundle__product-inner product-bundle__product-inner--slider-v">

						<aside class="product-bundle__product-image">
							<a href="<?php echo esc_attr(get_permalink($variant->get_id())); ?>">
								<?php
								if ($variant->get_image_id()) {
									$img = get_the_post_thumbnail($variant->get_id(), 'thumbnail', array(
										'data-bundle-variation-image' => true,
										'srcset' => '',
									));
									echo $img ? wp_kses_post($img) : get_the_post_thumbnail($variant->get_parent_id(), 'thumbnail', array(
										'data-bundle-variation-image' => true,
										'srcset' => '',
									));
								} else {
									echo wp_kses_post(wc_placeholder_img('thumbnail'));
								}
								?>
							</a>

							<?php if ( ! $product->isMain() ) : ?>
								<div class="product-bundle__discount-label">
									-<?php echo wp_kses_post(intval($product->getDiscount())); ?>%
								</div>
							<?php endif; ?>
						</aside>

						<div class="product-bundle__product-info">

						<!-- Title -->
						<h3 class="product-bundle__product-title">
							<a href="<?php echo esc_url_raw(get_permalink($variant->get_id())); ?>">
								<?php echo wp_kses_post(get_the_title($variant->get_id())); ?>
							</a>
						</h3>dadass
						<?php $fileManager->includeTemplate('frontend/bundle/products/product-price.php', array('product' => $product)); ?>

						</div>
					</div>
					<?php $cnt++; ?>
				</div>
				<?php
			endforeach;

			$product->resetVariation();
			?>
		</div>

		<div class="product-bundle__product-arrows">
			<div class="product-bundle__product-arrow product-bundle__product-arrow--top hidden" data-variant-slider-arrow-left>
				<svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 11.99 8"><path d="M2.13 7.61L8.01 1.9 6.2-.02.3 5.71a1.27 1.27 0 0 0 .08 1.73 1.36 1.36 0 0 0 1.75.17z"/><path d="M11.81 5.98l-5.61-6-1.9 1.84 5.61 6a1.79 1.79 0 0 0 1.75-.12 1.67 1.67 0 0 0 .15-1.72z"/></svg>
			</div>
			<div class="product-bundle__product-arrow product-bundle__product-arrow--bottom hidden" data-variant-slider-arrow-right>
				<svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 11.99 8"><path d="M2.13 7.61L8.01 1.9 6.2-.02.3 5.71a1.27 1.27 0 0 0 .08 1.73 1.36 1.36 0 0 0 1.75.17z"/><path d="M11.81 5.98l-5.61-6-1.9 1.84 5.61 6a1.79 1.79 0 0 0 1.75-.12 1.67 1.67 0 0 0 .15-1.72z"/></svg>
			</div>
		</div>
	</div>
</article>
