<?php
/**
 * Parent theme functions
 */

 //All these functions are just copy from the parent
function premmerce_option($option)
{
	return get_theme_mod($option, premmerce_default_options($option));
}

if (!function_exists('premmerce_default_options')) {
	function premmerce_default_options($option)
	{
		$default_options = apply_filters('saleszone_default_options',array(
			'content_width'    => 1440,
			'header_layout'    => 'layout_1',
			'shop-search-placeholder' => __('Search products','saleszone'),
			'general_layout'   => 'fluid',
			'catalog-mode'     => 0,
			'footer-before'    => '',
			'footer-copyright' => 'Copyright ©2018, SalesZone – Demo Store, It is a premmerce demo store. Powered by <a href="https://premmerce.com/" target="_blank">Premmerce</a>',
			'footer-copyright-secondary' => '[payment-icons]',
			'payment-icons'    => array('amex','liqpay','mastercard','paypal','privatbank','visa'),
			'disabled_google_fonts'   => 1,
			'footer_columns'   => '4',
			'footer_1'         => 1,
			'footer_2'         => 1,
			'category-product-add-to-cart-btn' => 'show',
			'category-product-view' => 'grid',
			'category-product-quick-view' => 1,
			'category-product-action-counter' => 1,
			'category-product-variations' => 1,
			'category-product-short-description' => 1,
			'category-product-attributes' => 1,
			'category-product-flipper' => 1,
			'category-product-flipper-animation'=> 'normal',
			'category-product-lazyload' => 0,
			'category-product-lazyload-spinner' => 1,
			'category-product-display-stock' => 0,
			'category-product-ajax-change-variation' => 1,
			'category-load-more' => 1,
			'category-active-filter' => 1,
			'category-btn-add-to-cart-icon' => 1,
			'category-show-description-on-top' => 0,
			'category-show-hide-bth-for-description' => 0,
			'shop-category-per-page' => 12,
			'shop-category-per-row' => '4',
			'product-action-counter' => 1,
			'product-sidebar' => 1,
			'product-main-attributes' => 0,
			'product-tabs-type' => 'no-tabs',
			'product-thumbnails-type' => 'simple',
			'product-btn-add-to-cart-icon' => 1,
			'product-variation-custom-select' => 0,
			'checkout-billing-form-fields-list' => 'full',
			'header-main-menu-type' => 'tree',
			'add-to-cart-icon' => 'cart',
			'header-phone'     => '0 800 123-45-67',
			'header-phone-title'     => __('Call us','saleszone'),
			'header-phone-display-type'  => 'list',
			'header-phone-show-icon'     => 1,
			'header-phone-icon-style'     => 'phone-big',
			'header-phone-icon-size'     => 32,
			'header-phone-attr-tel'     => 1,
			'header-phone-font-size'     => 14,
			'header-phone-title-font-size'     => 12,
			'logo-slogan'     => 0,
			'logo-container-max-width'     => 300,
		));

		if(!empty($default_options[$option])) return $default_options[$option];
	}
}


if(!function_exists('premmerce_the_svg')){
    function premmerce_the_svg($icon_name, $class = ''){
        echo wp_kses(premmerce_svg($icon_name, $class), premmerce_svg_allowed_html());
    }
}

if(!function_exists('premmerce_svg')){
    function premmerce_svg($icon_name, $class = ''){

        $icon = apply_filters('premmerce-svg-icon--' . $icon_name, array(
            'class' => $class,
            'html' => '<svg class="svg-icon '. $class .' "><use xlink:href="' . get_template_directory_uri() . '/public/svg/sprite.svg#svg-icon__'. $icon_name .'"></use></svg>'
        ), $icon_name);

		if( $icon_name === 'cart' ){
			$icon['html'] = '<img src="/wp-content/uploads/2021/10/fa-shopping-bag-w.svg" alt="cart icon" class="cart_icon_w">';
		}

        return $icon['html'];
    }
}

if(!function_exists('premmerce_svg_allowed_html')){
    function premmerce_svg_allowed_html(){
        $allowed_html = array(
            'span' => array(
                'class' => true
            ),
            'svg' => array(
                'class' => true
            ),
			'img' => array(
                'alt' => true,
                'width' => true,
                'height' => true,
                'src' => true
            ),
            'use' => array(
                'xlink:href' => true
            )
        );

        return $allowed_html;
    }
}

if (!function_exists( 'premmerce_clear_phone_number' )) {
    function premmerce_clear_phone_number($phone) {
        return preg_replace("/[^\d]/",'', $phone);
    }
}
//end copy from the parent theme

//Add descr under each product grid
function woocommerce_template_loop_product_title($args){
	echo '<div class="product-loop-title"><a href="' . esc_url(get_the_permalink()) . '" data-product-permalink>' . get_the_title($args['variation']->get_ID()) . '</a></div>';
	//echo '<div class="product-loop-descr">'.get_the_excerpt().'</div>';
}

//The free delivery text under each product in grid // needs to be dynamic
function htheme_add_shipping_and_wishlist(){
	/* echo '<div class="product-loop-bottom-info">';
	echo '<div class="product-loop-delivery-info">Free Delivery</div>';
	premmerce_render_wishlist_catalog_button_snippet();
	echo '</div>'; */
}
//add_action('woocommerce_after_shop_loop_item_title', 'htheme_add_shipping_and_wishlist', 10);

//Replace add to cart icon
function premmerce_get_loop_add_to_cart_icon() {
	if(premmerce_option('category-btn-add-to-cart-icon')){
		return '<img src="/wp-content/uploads/2021/10/fa-shopping-bag-w.svg" alt="cart icon" class="cart_icon_w">';
	} else {
		return '';
	}

}

//Add banner to the end of product categories
function htheme_product_category_banner(){

	$product_cat_object = get_queried_object();
	$banner_image = get_field( 'bottom_banner_image', 'product_cat_' . $product_cat_object->term_id );
	$banner_url = get_field( 'bottom_banner_url', 'product_cat_' . $product_cat_object->term_id );

	if( $banner_image ){
		echo '<div class="banner-product-category">';
		echo '<a href="' . $banner_url . '">' . wp_get_attachment_image( $banner_image['ID'], 'full' ) . '</a>';
		echo '</div>';
	}

}
add_action( 'premmerce-archive-products-layout-body-end', 'htheme_product_category_banner' );

//Remove parent theme actions
function htheme_remove_parent_actions(){
	remove_action( 'premmerce-archive-products-layout-body-after-header', 'premmerce_render_premmerce_active_filters_widget' );
}
add_action( 'init', 'htheme_remove_parent_actions' );

//Create a brands list
function htheme_build_brands_list(){
	$args = [
		'taxonomy'	 => 'product_brand',
		'orderby'    => 'name',
		'order'      => 'ASC',
		'hide_empty' => false,
	];

	$brands = get_terms( $args );
	ob_start();
	?>
	<div class="category-brands-widget">
		<div class="brands-widget__list">
			<?php foreach ($brands as $brand) : ?>
				<div class="brands-widget__list-item">
					<div class="brands-widget__item">
						<a class="brands-widget__link"
						href="<?php echo esc_url(get_term_link($brand->slug, 'product_brand')); ?>">
							<?php if ($imageURL = wp_get_attachment_image_url(get_term_meta($brand->term_id, 'thumbnail_id', true), 'thumbnail')) : ?>
								<img class="brands-widget__img" src="<?php echo esc_url($imageURL); ?>" alt="<?php echo esc_attr($brand->name); ?>"
									title="<?php echo esc_attr($brand->name); ?>">
							<?php else: ?>
								<span class="brands-widget__title">
									<?php echo esc_html($brand->name); ?>
								</span>
							<?php endif ?>
						</a>
					</div>
				</div>
			<?php endforeach ?>
		</div>
	</div>
	<?php
	$output = ob_get_clean();
	echo $output;
}

// This is a copy from parent theme with small overrides in classes, styles, etc.
function premmerce_get_comments_form_args() {
	$commenter = wp_get_current_commenter();
	$required = get_option('require_name_email') ? 'aria-required="true" required' : '';

	if(premmerce_is_woocommerce_activated() && is_product()){
		$textarea_label = __('Your review', 'saleszone');
	} else {
		$textarea_label = __('Your comment', 'saleszone');
	}

	ob_start();
?>

	<div class="form__field form__field--hor comment-form-cookies-consent ">
		<label class="form__checkbox">
			<span class="form__checkbox-field">
				<input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes">
			</span>
			<span class="form__checkbox-inner">
				<?php esc_html_e('Save my name, email, and website in this browser for the next time I comment.','saleszone'); ?>
			</span>
		</label>
	</div>

<?php

	$cookies = ob_get_clean();

	$args = array(
		'class_form' => 'form',
		'id_form' => 'comment_form',
		'title_reply' => '',
		'title_reply_to' => '',
		'title_reply_before' => '<span id="reply-title" class="comment-reply-title">',
		'title_reply_after' => '</span>',
		'comment_notes_before' => '',
		'comment_notes_after' => '',
		'fields' => array(
			'author' => '<div class="form__field form__field--hor form__field--w-50"><div class="form__label"><div class="form__label-require-wrap"><span class="form__label-require-text-el">' . esc_html__('Name', 'saleszone') . '</span><i class="form__require-mark"></i></div></div> ' .
				'<div class="form__inner"><input class="form-control" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" ' . $required . ' /></div></div>',
			'email' => '<div class="form__field form__field--hor form__field--w-50"><div class="form__label"><div class="form__label-require-wrap"><span class="form__label-require-text-el">' . esc_html__('Email', 'saleszone') . '</span><i class="form__require-mark"></i></div></div> ' .
				'<div class="form__inner"><input class="form-control" name="email" type="email" value="' . esc_attr($commenter['comment_author_email']) . '" ' . $required . ' /></div></div>',
			'cookies' => $cookies
		),
		'logged_in_as' => '',
		'label_submit' => '',
		'submit_button' => '<button class="btn btn-default btn-style btn-style--lg">' . __('Submit a Review', 'htheme') . '</button>',
		'submit_field' => '<div class="form__field form__field--hor"><div class="form__label"></div><div class="form__inner">%1$s</div></div>%2$s',
		'comment_field' => '<div class="form__field form__field--hor"><div class="form__label"><div class="form__label-require-wrap"><span class="form__label-require-text-el">' . esc_html($textarea_label) . '</span><i class="form__require-mark"></i></div></div><div class="form__inner"><textarea class="form-control" name="comment" rows="5" aria-required="true" required></textarea></div></div>'
	);

	if(premmerce_is_woocommerce_activated()){
		if ($account_page_url = wc_get_page_permalink('myaccount')) {
			/* translators: %s: url*/
			$args['must_log_in'] = '<p class="must-log-in">' . sprintf(__('You must be <a href=%s>logged in</a> to post a comment.', 'saleszone'), esc_url($account_page_url)) . '</p>';
		}
	}

	return $args;
}


function premmerce_filter_woocommerce_product_tabs($tabs){
	global $product;

	$upsell_ids = $product->get_upsell_ids();

	if (!empty($upsell_ids)) {
		$tabs['accessories'] = array(
			'title' => __('Similar products', 'saleszone'),
			'priority' => 40,
			'callback' => 'woocommerce_upsell_display'
		);
	}
	return $tabs;
}


function htheme_title_order_recieved(){
	return __( 'Thank you for your order!', 'woocommerce' );
}
add_filter( 'woocommerce_endpoint_order-received_title', 'htheme_title_order_recieved', 'order-received' );
