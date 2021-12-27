<?php

// Add grey box (login/register) before checkout
add_action( 'woocommerce_before_checkout_form', 'htheme_before_checkout_form', 1 );
function htheme_before_checkout_form() {
	get_template_part( 'template-parts/checkout/checkout', 'guest-form' );
}

// Open wrapper before checkout (but after the guest box)
add_action(
	'woocommerce_before_checkout_form',
	function() {
		echo '<div class="checkout-form-wrapper">';
	},
	3
);
// Close wrapper after checkout
add_action(
	'woocommerce_after_checkout_form',
	function() {
		echo '</div>';
	},
	5
);

remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10 );

// Change position of checkout coupon code
// remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form' );
// add_action( 'woocommerce_checkout_before_customer_details', 'woocommerce_checkout_coupon_form', 10 );

// Change order of checkout billing fields
add_filter( 'woocommerce_checkout_fields', 'htheme_override_checkout_fields', 1 );
function htheme_override_checkout_fields( $fields ) {
	$fields['billing']['billing_first_name']['priority'] = 1;
	$fields['billing']['billing_last_name']['priority']  = 2;
	$fields['billing']['billing_email']['priority']      = 3;
	$fields['billing']['billing_phone']['priority']      = 4;
	$fields['billing']['billing_address_1']['priority']  = 5;
	$fields['billing']['billing_address_2']['priority']  = 6;
	$fields['billing']['billing_postcode']['priority']   = 7;
	$fields['billing']['billing_city']['priority']       = 8;

	$fields['shipping']['shipping_first_name']['priority'] = 1;
	$fields['shipping']['shipping_last_name']['priority']  = 2;
	$fields['shipping']['shipping_address_1']['priority']  = 5;
	$fields['shipping']['shipping_address_2']['priority']  = 6;
	$fields['shipping']['shipping_postcode']['priority']   = 7;
	$fields['shipping']['shipping_city']['priority']       = 8;

	unset( $fields['billing']['billing_company'] );
	//unset( $fields['billing']['billing_country'] );
	unset( $fields['billing']['billing_state'] );

	unset( $fields['shipping']['shipping_company'] );
	//unset( $fields['shipping']['shipping_country'] );
	unset( $fields['shipping']['shipping_state'] );

	// Add no extra class (use this to remove .screen-reader-text)
	$fields['billing']['billing_address_2']['label_class']   = array();
	$fields['shipping']['shipping_address_2']['label_class'] = array();

	return $fields;
}

// add_filter( 'woocommerce_default_address_fields', 'htheme_override_default_locale_fields' );
// function htheme_override_default_locale_fields( $fields ) {
// 	$fields['state']['priority']     = 5;
// 	$fields['address_1']['priority'] = 6;
// 	$fields['address_2']['priority'] = 7;
// 	return $fields;
// }

// Add delivery before total
add_action(
	'woocommerce_review_order_before_order_total',
	function() {
		wc_get_template( 'checkout/shipping.php' );
	},
	10
);

// Move checkout payment before total
remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
add_action( 'woocommerce_review_order_before_order_total', 'woocommerce_checkout_payment', 20 );

// Add order button after total
add_action(
	'woocommerce_checkout_after_order_review',
	function() {
		get_template_part( 'template-parts/checkout/checkout', 'order-button' );
	},
	30
);
