<?php

$order_button_text = __( 'Place Order', 'htheme' );

ob_start();

?>

<?php if ( apply_filters( 'woocommerce_checkout_show_terms', true ) && function_exists( 'wc_terms_and_conditions_checkbox_enabled' ) ) : ?>
	<div class="cart-payment__terms">
		<?php wc_get_template( 'checkout/terms.php' ); ?>
	</div>
<?php endif; ?>


<div class="cart-payment__submit form-row place-order">

<?php do_action( 'woocommerce_review_order_before_submit' ); ?>

<?php echo wp_kses( apply_filters( 'woocommerce_order_button_html', '<input type="submit" class="btn btn-lg btn-primary button alt" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '" />' ), premmerce_get_allowed_html( 'order_button' ) ); ?>

<?php do_action( 'woocommerce_review_order_after_submit' ); ?>

<?php wp_nonce_field( 'woocommerce-process_checkout', 'woocommerce-process-checkout-nonce' ); ?>
</div>

<?php

$html = ob_get_clean();

echo $html;
