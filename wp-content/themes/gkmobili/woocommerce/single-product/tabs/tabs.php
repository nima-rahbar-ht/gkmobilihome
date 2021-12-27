<?php
/**
 * Single Product tabs
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters('woocommerce_product_tabs', array());

if (empty($tabs)) {
    return;
}
?>
<?php if(premmerce_option('product-tabs-type') == 'no-tabs'): ?>
    <div class="product-fullinfo woocommerce-tabs">
        <?php foreach ($tabs as $key => $tab) : ?>
			<div class="product-fullinfo__item-wrapper product-fullinfo__item-wrapper--<?php echo $key; ?>">
				<div class="product-fullinfo__item">
					<div class="custom-title-wrapper">
						<h2 class="product-fullinfo__title">
							<?php echo esc_html(apply_filters('woocommerce_product_' . $key . '_tab_title', $tab['title'], $key)); ?>
						</h2>
					</div>
					<?php
					if ( 'reviews' === $key ) {
						get_template_part( 'template-parts/single-product/product', 'rating-alt' );
					}
					?>
					<div class="product-fullinfo__inner">
						<?php call_user_func($tab['callback'], $key, $tab); ?>
					</div>
				</div>
			</div>
        <?php endforeach; ?>
    </div>
    <?php elseif (premmerce_option('product-tabs-type') == 'tabs'): ?>
        <ul class="accordion-tabs woocommerce-tabs" data-accordion-tabs>
            <?php foreach ($tabs as $key => $tab) : ?>
                <li class="accordion-tabs__item js-init-active" data-accordion-tabs-item>

                    <a href="#product-<?php echo esc_attr($key); ?>" class="accordion-tabs__link" data-accordion-tabs-link id="product-<?php echo esc_attr($key); ?>" >
                        <span class="accordion-tabs__link-title">
                            <?php echo esc_html(apply_filters('woocommerce_product_' . $key . '_tab_title', $tab['title'], $key)); ?>
                        </span>
                        <span class="accordion-tabs__link-arrow hidden-sm hidden-md hidden-lg">
                            <?php premmerce_the_svg('angle-right'); ?>
                        </span>
                    </a>

                    <div class="accordion-tabs__content" data-accordion-tabs-content>
                        <?php call_user_func($tab['callback'], $key, $tab); ?>
                    </div>
                
                </li>
            <?php endforeach; ?>
        </ul>
        
    <?php endif; ?>
    <?php if( have_rows('care_content_repeater') ): ?>
    <h2 class="care_title"> <?php _e("Care:","single_product_translations"); ?></h2>
    <div class="care_content_repeater">
    <?php while( have_rows('care_content_repeater') ): the_row(); 
        $image = get_sub_field('image');
        ?>
        <div class="care_content">
            
            <div class="care_icon" style="background: url(<?php the_sub_field('care_icon'); ?>);">&nbsp;</div>
            <div class="care_desc"><?php the_sub_field('care_title'); ?></div>
        </div>
    <?php endwhile; ?>
    </div>
    <?php endif; ?>
    <?php if( have_rows('composition_repeater') ): ?>
        <div class="composition_content">
            <h2 class="composition_title"> <?php _e("Composition:","single_product_translations"); ?></h2>
            <div class="composition_repeater">
            <?php while( have_rows('composition_repeater') ): the_row();?>
                <div class="composition_content_row">  
                <?php if (get_sub_field('composition_material')) { ?>    
                    <p><?php the_sub_field('composition_material'); ?></p>
                <?php } ?>
                <?php if (get_sub_field('composition_content')) { ?>   
                    <p><?php the_sub_field('composition_content'); ?></p>
                <?php } ?>    
                </div>
            <?php endwhile; ?>
            </div>
        </div>
    <?php endif; ?>

