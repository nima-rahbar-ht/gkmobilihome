<?php use Premmerce\ProductBundles\Bundle\BundleInterface;
use Premmerce\ProductBundles\Bundle\BundleProduct;
use Premmerce\SDK\V2\FileManager\FileManager;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $wp;

/**
 * Available vars
 *
 * @var BundleInterface $bundle
 * @var FileManager $fileManager
 * @var BundleProduct $mainProduct
 */
?>
<div class="product-bundle__purchase">
	<div class="product-bundle__purchase-inner" data-bundle-purchase-block="<?php echo esc_attr($bundle->getId()); ?>">

		<?php
		$fileManager->includeTemplate( 'frontend/bundle/purchase/purchase-price.php', array(
			'price'        => $bundle->getPrice(),
			'regularPrice' => $bundle->getRegularPrice(),
		) );

		$fileManager->includeTemplate( 'frontend/bundle/purchase/purchase-discount.php', array(
			'discount' => $bundle->getTotalDiscount(),
		) );
		?>

		<div class="product-bundle__btn">
			<form method="post" data-bundle-add-to-cart="<?php echo esc_attr($bundle->getId()); ?>"
				  action="<?php echo esc_url_raw(home_url( $wp->request )); ?>">

				<input type="hidden" name="bundle_id" value="<?php echo esc_attr($bundle->getId()); ?>">

				<?php foreach ( $bundle->getProducts(true) as $product ) : ?>
					<?php if ( $product->getWcProduct()->is_type( 'variable' ) ) : ?>
						<input type="hidden" data-bundle-variation="<?php echo esc_attr($product->getWcProduct()->get_id()); ?>"
							   name="variation[<?php echo esc_attr($product->getWcProduct()->get_id()); ?>]">
					<?php endif; ?>
				<?php endforeach; ?>

				<input type="hidden" name="main_product_id" value="<?php echo esc_attr($bundle->getMainProduct()->getProductId()); ?>" >

				<button type="submit" name="add-to-cart"
						value="<?php esc_attr_e( $mainProduct->getWcProduct()->get_id() ); ?>"
						class="button alt">
					<?php if(premmerce_option('product-btn-add-to-cart-icon')){
						premmerce_the_svg(premmerce_option('add-to-cart-icon'),'pc-add-to-cart__button-icon-cart');
					} ?>
					<?php esc_html_e( $mainProduct->getWcProduct()->single_add_to_cart_text() ); ?>
				</button>
			</form>
		</div>

	</div>
</div>
