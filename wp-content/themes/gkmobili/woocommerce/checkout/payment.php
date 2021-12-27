<?php
/**
 * Checkout Payment Section
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     3.5.3
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! is_ajax() ) {
	do_action( 'woocommerce_review_order_before_payment' );
}
?>
<div class="content__row content__row--sm woocommerce-checkout-payment" id="payment">

	<div class="form__field">
		<div class="form__title form__title--secondary">
			<?php esc_html_e( 'Payment Methods', 'htheme' ); ?>
		</div>
	</div>

	<div class="cart-payment">

		<?php if ( WC()->cart->needs_payment() ) : ?>
		<div class="cart-payment__payment-methods">
			<div class="payments-radio payments-radio--bg">
				<ul class="payments-radio__list wc_payment_methods payment_methods methods">
					<?php
					if ( ! empty( $available_gateways ) ) {
						foreach ( $available_gateways as $gateway ) {
							wc_get_template( 'checkout/payment-method.php', array( 'gateway' => $gateway ) );
						}
					} else {
						echo '<li class="woocommerce-notice woocommerce-notice--info woocommerce-info">' . esc_html( apply_filters( 'woocommerce_no_available_payment_methods_message', WC()->customer->get_billing_country() ? __( 'Sorry, it seems that there are no available payment methods for your state. Please contact us if you require assistance or wish to make alternate arrangements.', 'saleszone' ) : __( 'Please fill in your details above to see available payment methods.', 'saleszone' ) ) ) . '</li>';
					}
					?>
				</ul>
			</div>
		</div>
		<?php endif; ?>

		<noscript class="cart-payment__noscript">
			<div class="message message--info">
				<?php printf( esc_html__( 'Since your browser does not support JavaScript, or it is disabled, please ensure you click the %1$sUpdate Totals%2$s button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'saleszone' ), '<em>', '</em>' ); ?>
			</div>
			<input type="submit" class="btn btn-default button alt" name="woocommerce_checkout_update_totals" value="<?php esc_attr_e( 'Update totals', 'saleszone' ); ?>" />
		</noscript>

	</div>

</div>
<?php
if ( ! is_ajax() ) {
	do_action( 'woocommerce_review_order_after_payment' );
}
