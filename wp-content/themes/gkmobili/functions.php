<?php
/**
 * htheme.gr theme
 */

$theme_includes_dir = get_stylesheet_directory() . '/includes/';

require_once($theme_includes_dir . 'woo-functions.php');
require_once($theme_includes_dir . 'helpers.php');

function debug_array($array, $is_for_admin_area = false)
{
	if ($is_for_admin_area) {
		$css = 'text-align: left; margin-left:200px; position:absolute; z-index: 100;';
	} else {
		$css = "text-align: left;";
	}
	echo '<pre style="' . $css . '" >', print_r($array, true), '</pre>';
}

function htheme_enqueue_styles() {
	//css
	wp_enqueue_style( 'htheme-styles', get_stylesheet_directory_uri() . '/assets/css/styles.css', array( 'saleszone-styles' ), filemtime( get_stylesheet_directory() . '/assets/css/styles.css' ) );
	wp_enqueue_style( 'htheme-styles-ht', get_stylesheet_directory_uri() . '/style.css', array(), time() );

	//js
	wp_enqueue_script( 'htheme-scripts', get_stylesheet_directory_uri() . '/assets/js/main.js', array( 'saleszone-scripts' ), filemtime( get_stylesheet_directory() . '/assets/js/main.js' ), true );
}
add_action( 'wp_enqueue_scripts', 'htheme_enqueue_styles', 10 );

/* current year */
function year_shortcode () {
	$cYear = date_i18n ('Y');
	return $cYear;
}
add_shortcode ('cYear', 'year_shortcode');

function current_year() {
    $year = date('Y');
    return $year;
}

add_shortcode('year', 'current_year');
add_filter ('widget_text', 'do_shortcode');

function htheme_font() {
	?>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,300;1,400&display=swap" rel="stylesheet">
	<?php
}
add_action( 'wp_head', 'htheme_font' );

/**
 * After theme setup
 *
 * @return void
 */
function htheme_setup_theme() {
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'featured-thumb', 700, 99999 );
}
add_action( 'after_setup_theme', 'htheme_setup_theme' );


/**
 * Includes
 */
require $theme_includes_dir . 'parent-functions.php';
require $theme_includes_dir . 'shortcodes.php';
require $theme_includes_dir . 'custom-blocks.php';
require $theme_includes_dir . 'acf-metaboxes.php';
require $theme_includes_dir . 'checkout.php';
require $theme_includes_dir . 'mega-menu.php';

if ( function_exists( 'acf_add_options_page' ) ) {

	acf_add_options_page(
		array(
			'page_title' => 'Theme General Settings',
			'menu_title' => 'Theme Settings',
			'menu_slug'  => 'theme-general-settings',
			'capability' => 'edit_posts',
			'redirect'   => false,
		)
	);

}

// Single Product

// Use this to remove actions which are registered by the theme
add_action(
	'after_setup_theme',
	function() {
		// Remove premmerce_render_stock from woocommerce_after_add_to_cart_button
		remove_action( 'woocommerce_after_add_to_cart_button', 'premmerce_render_stock', 5 );

		// Remove woocommerce_template_single_excerpt from premmerce_single_product_summary_footer
		remove_action( 'premmerce_single_product_summary_footer', 'woocommerce_template_single_excerpt', 10 );

	},
	0
);

// Add premmerce_render_stock to woocommerce_product_meta_start
add_action( 'woocommerce_product_meta_start', 'premmerce_render_stock', 15 );

// Remove all actions for hook woocommerce_product_meta_end
// $hook_name = 'woocommerce_product_meta_end';
// global $wp_filter;
// var_dump( $wp_filter[$hook_name] );
remove_all_actions( 'woocommerce_product_meta_end' );


// Add product excerpt before add-to-cart box
//add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 0 );

// Add SKU, Brand before add-to-cart-box
add_action( 'woocommerce_single_product_summary', function() { 
	global $product;
	?>
	<div class="brand-meta-wrapper">
	<?php get_template_part( 'template-parts/single-product/product', 'brand', array( 'product' => $product ) ); ?>

	</div>
	<?php
},10);
add_action(	'woocommerce_single_product_summary', function() { 
	global $product; ?>
		<div class="sku-meta-wrapper">		
		<?php get_template_part( 'template-parts/single-product/product', 'sku', array( 'product' => $product ) ); ?>
		</div>
		<?php
	},15 );
add_action(	'woocommerce_after_add_to_cart_button', function() { 

		?>
		<div class="sp_size_guide">
			<a href="#">Size Guide</a>
		 
		</div>
		<?php
	},15
);

/* 
add_action(	'premmerce_add_to_cart_button',	function() {
		echo '<div class="product-price-label">';
		echo esc_attr_e( 'Price:', 'htheme' );
		echo '</div>';
},0); */


// Function that displays a "Free Delivery" icon if the product has a shipping class of "Free Delivery"
function htheme_free_delivery() {
	global $product;

	$html                = '';
	$has_free_delivery   = false;
	$shipping_class_id   = $product->get_shipping_class_id();
	$shipping_class_term = get_term( $shipping_class_id, 'product_shipping_class' );

	// TODO: Maybe find another way to determine if is free delivery (e.g. based on cost if added to the cart?)
	if ( ! is_wp_error( $shipping_class_term ) && is_a( $shipping_class_term, 'WP_Term' ) ) {
		$shipping_class_name = $shipping_class_term->name;

		if ( 'Free Delivery' === $shipping_class_name ) {
			$has_free_delivery = true;
		}
	}

	if ( ! $has_free_delivery ) {
		return;
	}

	$html .= '<figure class="product-free-delivery">';
	$html .= '<img src="' . get_stylesheet_directory_uri() . '/assets/images/icon_free-shipping.svg">';
	$html .= '<figcaption>' . esc_attr( __( 'Free Delivery', 'htheme' ) ) . '</figcaption>';
	$html .= '</figure>';

	echo $html;

}
add_action( 'premmerce_single_product_summary_footer', 'htheme_free_delivery', 15 );

 
add_action( 'woocommerce_before_account_navigation', 'acc_title', 7 );  
function acc_title() {
   
	echo '<div class="my_acc_title">My Account</div>';
 } 


/* move items single product */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );


add_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 10);
add_action( 'woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 60 );

add_action( 'woocommerce_after_shop_loop_item_title', 'premmerce_render_loop_variations', 10 );

add_theme_support( 'align-wide' );
add_filter('acf/settings/remove_wp_meta_box', '__return_false');

//add_filter( 'formatted_woocommerce_price', 'ts_woo_decimal_price', 10, 5 );
function ts_woo_decimal_price( $formatted_price, $price, $decimal_places, $decimal_separator, $thousand_separator ) {
	$unit = number_format( intval( $price ), 0, $decimal_separator, $thousand_separator );
	$decimal = sprintf( '%02d', ( $price - intval( $price ) ) * 100 );
	return $unit . '<sup>' . $decimal_separator. $decimal . '</sup>';
}


function cart_also_like() { ?>
<div class="cart_also_like">
	<h3 class="cart_also_like_t"> <?php _e("You may be interested in …","cart_functions"); ?></h3>
	<div class="cart_also_like_grid">
		<?php echo do_shortcode( '[featured_products limit="8" template="carousel" columns="4"]' ); ?> 
	</div>
</div>


<?php
}; 
add_action( 'woocommerce_after_cart', 'cart_also_like', 80 ); 


/* //Get image from varation

// add the ajax fetch js
add_action( 'wp_footer', 'ajax_fetch_single_product_images' );
function ajax_fetch_single_product_images() {
	?>
<script type="text/javascript">
	function productCarouselInitialize() {
			jQuery('.product-photo').product-photo__thumbs-wrapper('destroy');
		if (jQuery(window).width() < 768) {
			jQuery('.product-photo').product-photo__thumbs-wrapper({
				items: 1
			}
			);
		}
	}
	function zoom() {

		jQuery('.single-product .woocommerce-product-gallery__wrapper .wp-post-image').each(function() {
			jQuery(this)
			.wrap('<span style="display:inline-block"></span>')
	.css('display', 'block')
					.parent()
					.zoom({
						url: jQuery(this).attr('href')
					});
		});

	}
	jQuery('.single-product figure.woocommerce-product-gallery__wrapper').html('');
	// jQuery('figure.woocommerce-product-gallery__wrapper').html('<div class="custom-loader-wrapper"><div class="custom-loader"></div></div>');

jQuery( document ).ready(function() {


	jQuery(".single-product .summary select[name='attribute_pa_color']").on('change', function() {

		var $color = jQuery(this).val().toLowerCase();
		var $sku   = jQuery('.product-sku').html();

			jQuery.ajax({
			url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
			type: 'post',
			data: { action: 'data_fetch', color: $color, sku: $sku },
			success: function(data) {

				jQuery('figure.woocommerce-product-gallery__wrapper').html( data );
				zoom();
				productCarouselInitialize();

			}
		});

	});
	jQuery(".single-product .summary select[name='attribute_pa_colors']").val(jQuery(".single-product .summary select[name='attribute_pa_colors'] option:nth(1)").val());
	jQuery(".single-product .summary select[name='attribute_pa_colors']").change();
});

</script>

	<?php
}


// the ajax function
add_action( 'wp_ajax_data_fetch', 'data_fetch' );
add_action( 'wp_ajax_nopriv_data_fetch', 'data_fetch' );
function data_fetch() {

	$product_sku   = esc_attr( $_POST['sku'] );
	$product_color = esc_attr( $_POST['color'] );

	$colors = get_terms( 'pa_color' );

	foreach ( $colors as $color ) {
		if ( $product_color == strtolower( $color->slug ) ) {
			$color_code = get_taxonomy_field( 'color_code', $color->term_id, 'pa_color' );
			break;
		}
	}
	// $images_dir = str_replace( '/wp-content/themes', '', get_theme_root() ) . '\wp-content\uploads\product_images'; //localhost
	$images_dir = str_replace( '/wp-content/themes', '', get_theme_root() ) . '/wp-content/uploads/wpallimport/files'; //web
	$images     = scandir( $images_dir );
	?>


	<?php
	foreach ( $images as $image ) :
		$parts = explode( '_', $image );
		if ( $parts[0] == $product_sku && $parts[1] == $color_code ) :
			?>
	<div data-thumb="<?php echo wp_upload_dir()['baseurl']; ?>/wpallimport/files/<?php echo $image; ?>" data-thumb-alt="" class="woocommerce-product-gallery__image" data-o_data-thumb="<?php echo wp_upload_dir()['baseurl']; ?>/wpallimport/files/<?php echo $image; ?>">
		<a data-fancybox="gallery" href="<?php echo wp_upload_dir()['baseurl']; ?>/wpallimport/files/<?php echo $image; ?>" data-o_href="<?php echo wp_upload_dir()['baseurl']; ?>/wpallimport/files/<?php echo $image; ?>">
			<!-- <div class="img-cont"> -->
				<img src="<?php echo wp_upload_dir()['baseurl']; ?>/wpallimport/files/<?php echo $image; ?>" class="wp-post-image" alt="" title="" data-caption="" data-src="<?php echo wp_upload_dir()['baseurl']; ?>/wpallimport/files/<?php echo $image; ?>">
			<!-- </div> -->
		</a>
	</div>
			<?php
		endif;
		endforeach;
	?>

	<?php

	die();
}
 */