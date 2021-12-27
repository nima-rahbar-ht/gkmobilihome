<?php

$product = $args['product'];

$brands = get_the_terms( $product->get_id(), 'product_brand' );

if ( ! empty( $brands ) && ! is_wp_error( $brands ) ) : ?>
	<?php $brand = $brands[0]; ?>
	<div class="brand-meta">
		<?php /* esc_html_e( 'Brand', 'saleszone' ); */ ?>
		<a href="<?php echo esc_url( get_term_link( $brand->slug, 'product_brand' ) ); ?>">
			<?php echo esc_html( $brand->name ); ?>
		</a>
	</div>
<?php endif; ?>
