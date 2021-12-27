<?php
/**
 * Thankyou page
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     3.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $order ) {
	$show_customer_details = is_user_logged_in() && $order->get_user_id() === get_current_user_id();
}

$downloads      = $order->get_downloadable_items();
$show_downloads = $order->has_downloadable_item() && $order->is_download_permitted();


?>
<div class="woocommerce-order ty_page_order">

        <?php if ( $order ) : ?>

                <?php if ( $order->has_status( 'failed' ) ) : ?>

                        <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php _e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?></p>

                        <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
                                <a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php _e( 'Pay', 'woocommerce' ) ?></a>
                                <?php if ( is_user_logged_in() ) : ?>
                                        <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php _e( 'My account', 'woocommerce' ); ?></a>
                                <?php endif; ?>
                        </p>

                <?php else : ?>
						<div class="woo_order_id_cnt_main">
							<div class="woo_order_received_title">Order Received</div>
							<div class="woo_order_id_cnt">
								<div class="woo_order_received_message">Thank you. Your order has been received.</div>
							<ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">

								<li class="woocommerce-order-overview__order order">
									<?php esc_html_e( 'Order number:', 'woocommerce' ); ?>
									<strong><?php echo $order->get_order_number(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
								</li>

								<li class="woocommerce-order-overview__date date">
									<?php esc_html_e( 'Date:', 'woocommerce' ); ?>
									<strong><?php echo wc_format_datetime( $order->get_date_created() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
								</li>

								<?php if ( is_user_logged_in() && $order->get_user_id() === get_current_user_id() && $order->get_billing_email() ) : ?>
									<li class="woocommerce-order-overview__email email">
										<?php esc_html_e( 'Email:', 'woocommerce' ); ?>
										<strong><?php echo $order->get_billing_email(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
									</li>
								<?php endif; ?>

								<li class="woocommerce-order-overview__total total">
									<?php esc_html_e( 'Total:', 'woocommerce' ); ?>
									<strong><?php echo $order->get_formatted_order_total(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
								</li>

								<?php if ( $order->get_payment_method_title() ) : ?>
									<li class="woocommerce-order-overview__payment-method method">
										<?php esc_html_e( 'Payment method:', 'woocommerce' ); ?>
										<strong><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></strong>
									</li>
								<?php endif; ?>

								</ul>
							</div>
						</div>
                <?php endif; ?>
				


	<div class="title_order_preview_cnt">
		<div class="title_order_preview">
			<h3><?php _e( 'Billing Address', 'woocommerce' ); ?></h3>
		</div>
		<address>
		<?php
		if ( ! $order->get_formatted_billing_address() ) _e( 'N/A', 'woocommerce' ); else echo $order->get_formatted_billing_address();
		?>
		</address>
	</div>
<?php if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() && get_option( 'woocommerce_calc_shipping' ) !== 'no' ) : ?>	

	<div class="col-2">

		<header class="title">
		<h3><?php _e( 'Shipping Address', 'woocommerce' ); ?></h3>
		</header>
		<address>aaaa
		<?php
		if ( ! $order->get_formatted_shipping_address() ) _e( 'N/A', 'woocommerce' ); else echo $order->get_formatted_shipping_address();
		?>
		</address>

	</div><!-- /.col-2 -->

<?php endif; ?>




				<div class="order_details_row_one"> 
					<?php //do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>
				</div>
				<div class="order_details_row_two">
					
					<?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>
				</div>
              
          

        <?php else : ?>

                <p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'woocommerce' ), null ); ?></p>

        <?php endif; ?>

</div>
