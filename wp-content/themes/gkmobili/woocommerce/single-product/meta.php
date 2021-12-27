<?php
/**
 * Single Product Meta
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
?>
<div class="product-meta product_meta">

    <?php echo wp_kses_post(wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted_in">' . _n( 'Category:', 'Categories:', count( $product->get_category_ids() ), 'saleszone' ) . ' ', '</span>' )); ?>

    <?php
    /**
     * @hooked premmerce_render_stock - 5
     * @hooked woocommerce_template_single_rating - 10
     */

	echo do_shortcode( '[premmerce_get_bundle_by_id id=5]' );
    do_action( 'woocommerce_product_meta_start' );
    ?>

	<?php echo wp_kses_post(wc_get_product_tag_list( $product->get_id(), ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'saleszone' ) . ' ', '</span>' )); ?>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>
