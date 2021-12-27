<?php
/**
 * Pagination - Show numbered pagination for catalog pages
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @author     WooThemes
 * @package    WooCommerce/Templates
 * @version    3.3.1
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if (!defined('ABSPATH')) {
    exit;
}

$total = isset($total) ? $total : wc_get_loop_prop('total_pages');
$current = isset($current) ? $current : wc_get_loop_prop('current_page');
$base = isset($base) ? $base : esc_url_raw(str_replace(999999999, '%#%', remove_query_arg('add-to-cart', get_pagenum_link(999999999, false))));
$format = isset($format) ? $format : '';

if ($total <= 1) {
    return;
}

$pagination = paginate_links(apply_filters('woocommerce_pagination_args', array( // WPCS: XSS ok.
    'base' => $base,
    'format' => $format,
    'add_args' => false,
    'current' => max(1, $current),
    'total' => $total,
    'prev_text' => '&larr;',
    'next_text' => '&rarr;',
    'type' => 'array',
    'end_size' => 3,
)));

?>

<nav class="content__row" data-load-more-product--pagination>
    <div class="content__pagination products-pagination <?php if(premmerce_option('category-load-more') && wc_get_loop_prop( 'total_pages' ) > wc_get_loop_prop( 'current_page' )) :?>content__pagination--load-more<?php endif; ?>">

		<?php woocommerce_result_count(); ?>

        <?php if(premmerce_saleszone_fs()->is__premium_only()) :?>
            <?php if(premmerce_option('category-load-more') &&  wc_get_loop_prop( 'total_pages' ) > wc_get_loop_prop( 'current_page' )) :?>
                <button class="btn-load-more" data-load-more-product--button data-load-more-product-current-page="<?php echo wc_get_loop_prop( 'current_page' ); ?>">
                    <i class="btn-load-more__icon">
                        <?php premmerce_the_svg('rotate'); ?>
                    </i>
                    <span class="btn-load-more__text-el">
                        <?php esc_html_e('Load more','saleszone'); ?>
                    </span>
                </button>
            <?php endif; ?>
        <?php endif; ?>

        <ul class="pagination">
            <?php foreach ($pagination as $item): ?>
                <li class="pagination__item">
                    <?php echo wp_kses($item , array('a' => array('class' => true ,'href' => true), 'span' => array('class' => true) )); ?>
                </li>
            <?php endforeach; ?>
        </ul>

    </div>
</nav>
