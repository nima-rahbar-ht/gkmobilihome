<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<div class="cart-summary__row">

    <!-- Product item -->
    
    <div class="cart_product">
        <div class="cart-summary__row_h_item h_info_prod"><?php _e("Product","cart_header"); ?></div>
        <div class="cart-summary__product">
            <?php wc_get_template('cart/cart-product.php', array(
                'product' => $_product,
                'cart_item' => $cart_item,
                'cart_item_key' => $cart_item_key
            )) ?>
        </div>
    </div>
    
    <!-- Quantity -->
    <div class="cart_product_quantity">
        <div class="cart-summary__row_h_quantity h_info_prod"><?php _e("Quantity","cart_header"); ?></div>
        <div class="cart-summary__quantity cart-summary__quantity--sm">
            x<?php echo wp_kses_post(apply_filters('woocommerce_widget_cart_item_quantity', $cart_item['quantity'], $cart_item, $cart_item_key)); ?>
        </div>
    </div>
 
    <!-- Price -->
    <div class="cart_product_subtotal">
        <div class="cart-summary__row_h_price h_info_prod"><?php _e("Price","cart_header"); ?></div>
        <div class="cart-summary__price">
            <div class="cart-price">
                <div class="cart-price__main cart-price__main--small">
                    <?php echo wp_kses(WC()->cart->get_product_subtotal($_product, $cart_item['quantity']) , premmerce_get_allowed_html('price')); ?>
                </div>
            </div>
        </div>
    </div>

</div>