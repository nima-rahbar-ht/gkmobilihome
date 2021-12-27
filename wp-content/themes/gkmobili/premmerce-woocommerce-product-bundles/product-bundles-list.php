<?php

use Premmerce\ProductBundles\Bundle\BundleInterface;
use Premmerce\SDK\V2\FileManager\FileManager;

if ( ! defined( 'WPINC' ) ) {
	die;
}


/**
 * Available vars
 *
 * @var FileManager $fileManager
 * @var BundleInterface[] $bundles
 * @var WC_Product $mainProduct
 * @var string $displayType
 * @var string $title
 * @var string $position
 */

if ( empty( $bundles ) ) {
	return;
}

?>
<div class="product-bundle product-bundle--position-<?php echo esc_attr($position); ?>" data-product-bundle-slider>

	<?php if ('' !== $title) : ?>
		<h2 class="product-bundle__title">
			<?php echo wp_kses_post($title); ?>
		</h2>
	<?php endif; ?>

	<div class="product-bundle__body">
		<div class="product-bundle__list" <?php echo esc_attr("data-product-bundle-type-{$displayType}"); ?>>

		<?php foreach ($bundles as $bundle) : ?>
			<?php
			$fileManager->includeTemplate('frontend/bundle/bundle.php', array(
				'bundle' => $bundle,
				'fileManager' => $fileManager,
				'mainProduct' => $mainProduct
			));
			?>
		<?php endforeach; ?>
		</div>

		<?php if ('slider' === $displayType) : ?>
			<div class="product-bundle__arrow product-bundle__arrow--left hidden" data-slider-arrow-left>
				<svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 11.99 8"><path d="M2.13 7.61L8.01 1.9 6.2-.02.3 5.71a1.27 1.27 0 0 0 .08 1.73 1.36 1.36 0 0 0 1.75.17z"></path><path d="M11.81 5.98l-5.61-6-1.9 1.84 5.61 6a1.79 1.79 0 0 0 1.75-.12 1.67 1.67 0 0 0 .15-1.72z"></path></svg>
			</div>
			<div class="product-bundle__arrow product-bundle__arrow--right hidden" data-slider-arrow-right>
				<svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 11.99 8"><path d="M2.13 7.61L8.01 1.9 6.2-.02.3 5.71a1.27 1.27 0 0 0 .08 1.73 1.36 1.36 0 0 0 1.75.17z"></path><path d="M11.81 5.98l-5.61-6-1.9 1.84 5.61 6a1.79 1.79 0 0 0 1.75-.12 1.67 1.67 0 0 0 .15-1.72z"></path></svg>
			</div>
		<?php endif; ?>
	</div>
</div>
