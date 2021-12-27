<?php

use Premmerce\ProductBundles\Bundle\BundleProduct;
use Premmerce\SDK\V2\FileManager\FileManager;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Used vars
 *
 * @var int $bundleId
 * @var BundleProduct $product
 * @var FileManager $fileManager
 */
?>

<article class="product-bundle__product">
	<div class="product-bundle__product-inner">
		<!-- Bundle Product BEGIN -->

		<aside class="product-bundle__product-image">
			<a href="<?php echo wp_kses_post($product->getWcProduct()->get_permalink()); ?>">
				<?php
				if ( $product->getWcProduct()->get_image_id() ) {
					$img = get_the_post_thumbnail( $product->getWcProduct()->get_id(), 'thumbnail', array(
						'srcset' => '',
					) );
					echo $img ? wp_kses_post($img): get_the_post_thumbnail( $product->getWcProduct()->get_parent_id(), 'thumbnail', array(
						'srcset' => '',
					) );
				} else {
					echo wp_kses_post(wc_placeholder_img( 'thumbnail' ));
				}
				?>
			</a>

			<?php if ( ! $product->isMain() ) : ?>
				<div class="product-bundle__discount-label">

					-<?php echo wp_kses_post( intval($product->getDiscount())); ?>%
				</div>
			<?php endif; ?>

		</aside>

		<div class="product-bundle__product-info">
		<!-- Title -->
		<h3 class="product-bundle__product-title">
			<a href="<?php echo esc_url_raw(get_permalink( $product->getWcProduct()->get_id() ) ); ?>">
				<?php echo wp_kses_post(get_the_title( $product->getWcProduct()->get_id() )); ?>
			</a>
		</h3>

		<?php $fileManager->includeTemplate('frontend/bundle/products/product-price.php', array('product' => $product)); ?>

		</div>
	</div>
</article>
