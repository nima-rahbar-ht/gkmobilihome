<div class="content__row">
    <?php wc_print_notices(); ?>
    <form class="woocommerce-cart-form"
          action="<?php echo esc_url(wc_get_cart_url()); ?>"
          method="post"
          data-cart-frame-fragment
          data-cart-summary="page"
    >
        <?php do_action('woocommerce_before_cart_table'); ?>
        <div class="frame htheme_frame">
            <div class="frame_cart__header">
               
                <div class="header_cart">
                    <div class="header_left">
                        <div class="header_cart_pi"><?php _e("Product Image","cart_luci"); ?></div>
                        <div class="header_cart_pt"><?php _e("Product Title","cart_luci"); ?></div>
                        <div class="header_cart_pr"><?php _e("Price","cart_luci"); ?></div>
                    </div>
                    <div class="header_right">
                        <div class="header_cart_qu"><?php _e("Quantity","cart_luci"); ?></div>
                        <div class="header_cart_to"><?php _e("Total","cart_luci"); ?></div>
                    </div>
                </div>
            </div>
            <div class="frame__inner">
                <?php wc_get_template('cart/cart-summary.php', array(
                    'parent_type' => 'order',
                    'parent_coupon' => false,
                    'parent_template' => 'woocommerce/cart/cart',
                    'parent_coupone' => true
                )); ?>
            </div>
        </div>
        <input class="button hidden" type="submit" name="update_cart"
               value="<?php esc_attr_e('Update cart', 'saleszone'); ?>">
        <?php wp_nonce_field('woocommerce-cart', '_wpnonce', false); ?>
        <?php do_action('woocommerce_after_cart_table'); ?>
    </form>
</div>

