<!-- shipping methods -->
<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
<div class="form form--bg shipping_checkout" data-checkout-shipping-fragments> 
	<div class="form__field">
		<div class="form__title form__title--secondary">
			<?php esc_html_e( 'Shipping', 'htheme' ); ?>
		</div>
	</div>
	<div class="cart-totals cart-totals--chekout">
		<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

		<ul class="cart-totals__list">
			<?php wc_cart_totals_shipping_html(); ?>
		</ul>

		<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>
	</div>
</div>
<?php endif; ?>
