<?php global $product; ?>
<div class="product-labels">
<?php /*
	<?php if ( $product->is_featured() ) : ?>
		<div class="product-labels__item product-labels__item--hit">
			<?php premmerce_the_svg( 'new' ); ?>
			<span class="product-labels__text">
				<?php esc_html_e( 'Hit', 'saleszone' ); ?>
			</span>
		</div>
	<?php endif ?>
	*/ ?>
	<?php
	 
	if ( $variation->is_on_sale() && $variation->get_sale_price() && ( $variation->get_regular_price() > $variation->get_sale_price() ) ) {
		$percent_discount = round( ( ( ( $variation->get_regular_price() - $variation->get_sale_price() ) / $variation->get_regular_price() ) * 100 ) );
	} else {
		$percent_discount = 0;
	}
	?>
	<div class="product-labels__item product-labels__item--discount
	<?php
	if ( ! $percent_discount ) :
		?>
		hidden<?php endif; ?>"
		 data-product-discount-percent>
			<span class="product-labels__text">
				-<span data-product-discount-percent-value><?php echo esc_html( $percent_discount ); ?></span>%
			</span>
		<?php premmerce_the_svg( 'new' ); ?>
	</div>
	<?php do_action( 'premmerce_product_labels' ); ?>
</div>

<div class="product-custom-labels">
	<?php if ( get_field( 'product_custom_label' ) ) : ?>
		<div class="product-custom-label"><?php echo esc_attr( get_field( 'product_custom_label' ) ); ?></div>
	<?php endif; ?>
</div>
