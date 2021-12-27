<?php

$product = $args['product'];

?>

<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

<span class="sku_wrapper">
		<?php esc_html_e( 'SKU:', 'saleszone' ); ?>
	<span data-product-sku>
		<?php echo esc_html( ( $sku = $product->get_sku() ) ? $sku : __( 'N/A', 'saleszone' ) ); ?>
	</span>
</span>

<?php endif; ?>
