<?php

/**
 * Collection of various helper functions
 */

/**
 * Returns an image url inside the theme
 *
 * @param [string] $img The image filename
 * @return string The image full path
 */
function get_local_img_url($img)
{

    return get_template_directory_uri() . "/img/{$img}";
}

/**
 * Returns an icon url inside the theme
 * Same as get_local_img_url() but it goes in the /icons subfolder
 *
 * @param [string] $img The icon filename
 * @return string The icon full path
 */
function get_icon_url($icon)
{

    return get_local_img_url("icons/{$icon}");
}

/**
 * A quick shorthand to get an ACF field for a taxonomy (by ID/Object)
 *
 * @param [string] $field The ACF field we need
 * @param [int|object] $term The taxonomy term (ID/Object)
 * @param string $taxonomy The taxonomy name
 * @return mixed The field value
 */
function get_taxonomy_field($field, $term, $taxonomy = '')
{

    if (!is_object($term)) {
        return get_field($field, "{$taxonomy}_{$term}");
    }

    return get_field($field, "{$term->taxonomy}_{$term->term_id}");
}

/**
 * A simple and quick way to check if a post has content or not
 *
 * @param [int] $post_id The post ID
 * @return boolean Returns true if the post has content, false otherwise
 */
function has_content($post_id = null)
{

    if (is_null($event_id)) {
        $post_id = get_the_ID();
    }

    // phpcs:ignore WordPress.WP.AlternativeFunctions.strip_tags_strip_tags
    return trim(str_replace('&nbsp;', '', strip_tags(get_the_content($post_id)))) !== '';
}

function triumph_login_form()
{
    if (!is_user_logged_in()) {
        if (
            function_exists('woocommerce_login_form') &&
            function_exists('woocommerce_output_all_notices')
        ) {
            //render the WooCommerce login form
            ob_start();
            woocommerce_output_all_notices();
            woocommerce_login_form();
            return ob_get_clean();
        } else {
            //render the WordPress login form
            return wp_login_form(array('echo' => false));
        }
    }
}


function triumph_login_form_cart_html()
{
    if (!is_user_logged_in()) {
        if (
            function_exists('woocommerce_login_form') &&
            function_exists('woocommerce_output_all_notices')
        ) {
            //render the WooCommerce login form
            ob_start();
?>
            <div class="quickcheckout lineContainer">
                <div class="headline-small">Sign in to quick checkout</div>
                <div class="form-notices">
                    <?php woocommerce_output_all_notices(); ?>
                </div><!-- /.form-notices -->
                <div class="twocolumns">
                    <div class="loginasguest">
                        <div class="headline-section">Guest checkout</div>
                        <div class="headtext">Place an order without creating an account.</div>
                        <div class="guestcontinue">
                            <div class="continuecheckoutbutton">
                                <a id="continuecheckoutbutton" href="<?php echo esc_url(wc_get_checkout_url()); ?>" class="btn btn--white btn--border btn--block" title="Continue checkout">
                                    <span>Continue checkout</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="loginasregistered">
                        <div class="loginbox">
                            <div class="headline-section">I am an existing customer</div>
                            <div class="toReplaceWithAjax" data-redirecturl="/">
                                <div class="login">
                                    <?php woocommerce_login_form(); ?>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="register">
                            <a href="<?php echo home_url('/register/'); ?>" id="createaccountbutton" class="btn btn--link btn--noborder btn--block" title="Don't have an account? Sign up"><span>Don't have an account? Sign up</span></a>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
<?php

            return ob_get_clean();
        } else {
            return;
        }
    }
}
