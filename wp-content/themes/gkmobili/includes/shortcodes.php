<?php
/**
 * Shortcodes
 */

 /**
  * By Hellenic
  */
add_shortcode('by-hellenic', function (){
    ob_start();
    ?>

	<div class="by-hellenic">
		<span>Developed by</span>
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo_hellenic-technologies.svg" width="114" loading="lazy" alt="Hellenic">
	</div>

    <?php

    return ob_get_clean();
});
 /**
* Call/Email
*/
add_shortcode('contact-details', function (){
    ob_start();
    ?>
<!-- footer info -->
	<ul class="contact-details">
		<li>
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icon_phone-grey.svg" width="27" height="27" loading="lazy" alt="Hellenic">
			<div class="text">
				<span class="subtitle">Call Us</span>
				<a href="#"><?php echo premmerce_option('header-phone'); ?></a>
			</div>
		</li>
		<li>
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icon_mail.svg"  width="24" height="20" loading="lazy" alt="Hellenic">
			<div class="text">
				<span class="subtitle">Email Us</span>
				<a href="#">info@htheme.gr</a>
			</div>
		</li>
	</ul>

    <?php

    return ob_get_clean();
});

 /**
* Call/Email/contact
*/
add_shortcode('contact-details-extra', function (){
    ob_start();
    ?>

	<ul class="contact-details contact-details-extra">
		<?php
			if (get_field('contact_address' ,'option')) {
		?>
		<li class="contact_addr">
			<img src="/wp-content/uploads/2021/10/fa-map-marker-alt.svg"  loading="lazy" alt="icon pin">
			<div class="text">
				<span><?= get_field('contact_address' ,'option') ?></span>
			</div>
		</li>
		<?php
			}
		?>
		<li class="contact_phone">
			<img src="/wp-content/uploads/2021/10/fa-phone-altg.svg" width="27" height="27" loading="lazy" alt="Hellenic">
			<div class="text">
				<!-- <span class="subtitle">Call Us</span> -->
				<a href="#"><?php echo premmerce_option('header-phone'); ?></a>
			</div>
		</li>
		<?php
			if (get_field('fax_phone' ,'option')) {
		?>
			<?php /* <li>
			<div class="text text-margin">
				<!-- <span class="subtitle">Fax Us</span> -->
			
				<a href="tel:<?php echo get_field('fax_phone' ,'option')['url']; ?>"><?php echo get_field('fax_phone' ,'option')['title']; ?></a>
			</div>
		</li>*/ ?>
		<?php
			}
		?>
		<li class="contact_email">
			<img src="/wp-content/uploads/2021/10/fa-envelope-open-text.svg" loading="lazy" alt="Hellenic">
			<div class="text">
				<!-- <span class="subtitle">Email Us</span> -->
				<a href="mailto:<?php echo get_field('contact_email','options'); ?>"><?php echo get_field('contact_email','options'); ?></a>
			</div>
		</li>
		

		<?php /*
			if (get_field('contact_hours' ,'option')) {
		
		<li>
			<div class="text text-margin">
				<span class="subtitle subtitle-12">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icon_time.svg"  loading="lazy" alt="icon time">
						Store Opening Hours daily
				</span>
				<span class="small-text"><?= get_field('contact_hours' ,'option') ?></span>
				<span class="small-text  green">During these hours you can order or pick up from the store.</span>
			</div>
		</li>
		<?php
			}
			*/
		?>
	</ul>

    <?php

    return ob_get_clean();
});

 /**
* Contact Address
*/
add_shortcode('contact-address', function (){
    ob_start();
    ?>

	<ul class="contact-details contact-details-extra">
		<?php
			if (get_field('contact_address' ,'option')) {
		?>
		<li class="image-center">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icon_pin.svg"  loading="lazy" alt="icon pin">
			<div class="text">
				<span><?= get_field('contact_address' ,'option') ?></span>
				<?php
					if (get_field('contact_address_info' ,'option')) {
				?>
						<span class="normal"><?= get_field('contact_address_info' ,'option') ?></span>
				<?php
					}
				?>
			</div>
		</li>
		<?php
			}
		?>

	</ul>

    <?php

    return ob_get_clean();
});

/**
* Payment icons
*/
add_shortcode('payment-icons-list', function (){
    ob_start();
    ?>

	<ul class="payment-icons">
		<li>
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo_visa.svg" loading="lazy" alt="Icon">
		</li>
		<li>
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo_visa-electron.svg" loading="lazy" alt="Icon">
		</li>
		<li>
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo_maestro.svg" loading="lazy" alt="Icon">
		</li>
		<li>
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo_mastercard.svg" loading="lazy" alt="Icon">
		</li>
		<li>
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo_piraeus-bank.svg" loading="lazy" alt="Icon">
		</li>
		<li>
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo_paypal.svg" loading="lazy" alt="Icon">
		</li>
	</ul>

    <?php

    return ob_get_clean();
});

/**
* Grey site logo
*/
add_shortcode('footer-site-logo', function (){
    ob_start();
    ?>

	<div class="site-logo-centered">
		<img src="/wp-content/uploads/2021/10/logo_htheme.svg"  loading="lazy" alt="Icon">
	</div>
	<!-- /.site-logo-centered -->

    <?php

    return ob_get_clean();
});
