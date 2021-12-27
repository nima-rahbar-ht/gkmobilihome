<?php

if ( is_user_logged_in() || 'no' === get_option( 'woocommerce_enable_checkout_login_reminder' ) ) {
	return;
}

?>

<div class="checkout-box checkout-box--grey checkout-box--mb">
	<div class="checkout-guest-form">
		<div class="checkout-guest-form-part checkout-guest-form-part--left">
			<div class="checkout-guest-form-icon">
				<img src="<?php echo esc_attr( get_stylesheet_directory_uri() ); ?>/assets/images/icon_account.svg" alt="">
			</div>
			<div class="checkout-guest-text">
				<div class="checkout-guest-title"><?php esc_attr_e( 'Already have an account?', 'htheme' ); ?></div>
				<div class="checkout-guest-subtitle"><?php esc_attr_e( 'Register now and enjoy all the benefits.', 'htheme' ); ?></div>
			</div>
		</div>
		<div class="checkout-guest-form-part checkout-guest-form-part--right">
			<div class="checkout-guest-btns">
				<a
					class="btn-style"
					href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>"
					data-modal="<?php echo esc_url( premmerce_get_modal_url( 'parts/modal/modal-login' ) ); ?>"
				>
					<?php esc_attr_e( 'Login', 'htheme' ); ?>
				</a>
				<a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>" class="btn-style btn-style--inverse"><?php esc_attr_e( 'Register', 'htheme' ); ?></a>
			</div>
		</div>
	</div>
</div>

