<?php
global $wp_query;
$total_products = $wp_query->found_posts;
?>
<div class="content__header">
    <h1 class="content__title">
        <?php woocommerce_page_title(); ?>
    </h1>
    <?php /* echo '<div class="content__header-total">' . $total_products . ' ' . __('Results', 'htheme') . '</div>'; */ ?>
    <?php wc_get_template('loop/toolbar.php'); ?>
</div>

<?php if(premmerce_option('category-show-description-on-top')){
    premmerce_render_archive_products_description();
} ?>

<?php
/* Include woocommerce/content-product_cat.php template */
if (woocommerce_get_loop_display_mode() == 'both') {

    $args = apply_filters('woocommerce_output_product_categories_args-product-layout', array(
        'before' => '<div class="content__row"><div class="woocommerce columns-4"><div class="grid-list categories-list categories-list-more">',
        'after' => '</div></div></div>',
        'parent_id' => is_product_category() ? get_queried_object_id() : 0,
    ));

	echo '<h2 class="title-subsection">'.__('Categories', 'htheme').'</h2>';
    woocommerce_output_product_categories($args);

	//Now output the brands
	echo '<h2 class="title-subsection title-subsection--brands">'.__('Brands', 'htheme').'</h2>';
	htheme_build_brands_list();
}

?>

<div class="category-sort-selected-filters-wrapper">
	<?php premmerce_render_premmerce_active_filters_widget(); ?>
	
</div>
<!-- /.category-sort-selected-filters-wrapper -->

