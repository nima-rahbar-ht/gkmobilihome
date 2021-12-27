<div class="pc-header-layout-5">
    <div class="pc-header-layout-5__headline hidden-xs hidden-sm">
        <div class="page__container">
            <div class="pc-header-layout-5__headline-body">
                <div class="pc-header-layout-5__headline-left">
                    <?php if (has_nav_menu('header_nav')) {
                        wp_nav_menu(array(
                            'theme_location' => 'header_nav',
                            'walker' => new WalkerHeaderStatic(),
                            'container' => 'nav',
                            'container_class' => 'list-nav',
                            'menu_class' => 'list-nav__items'
                        ));
                    } ?>
                </div>
                <div class="pc-header-layout-5__headline-right">
                    <!-- Site languages Polylang -->
                    <?php if (function_exists('pll_the_languages')){
                        get_template_part('parts/header/parts/header', 'language-switch-polylang');
                    } elseif(function_exists('icl_get_languages')) {
                        get_template_part('parts/header/parts/header', 'language-switch-wpml');
                    } ?>

                    <!-- Woocommerce currency switcher -->
                    <?php get_template_part('parts/header/parts/header', 'woocommerce-currency-switcher'); ?>

                    <!-- Premmerce currency switcher -->
                    <?php get_template_part('parts/header/parts/header', 'premmerce-currency-switcher'); ?>

                    <!-- WPML Site currencies -->
                    <?php do_action('wcml_currency_switcher', array('format' => apply_filters('premmerce_wpml_currency_format','%code%, %symbol%'),'switcher_style' => 'saleszone-toolbar-currency-switcher')); ?>

                </div>
            </div>
        </div>
    </div>

    <div class="pc-header-layout-5__main">
        <div class="page__container">
            <div class="pc-header-layout-5__main-row">

                <div class="pc-header-layout-5__hamburger hidden-lg hidden-md">
                    <button class="btn-mobile-icon" data-page-mobile-btn>
                        <?php premmerce_the_svg('hamburger'); ?>
                    </button>
                    <button class="btn-mobile-icon hidden" data-page-mobile-btn>
                        <?php premmerce_the_svg('close-bold'); ?>
                    </button>
                </div>

                <div class="pc-header-layout-5__logo">
                    <?php premmerce_site_logo(); ?>
                </div>

                <div class="pc-header-layout-5__search" <?php echo strip_tags(premmerce_option('header-phone')) == '' ? 'pc-header-layout-5__search--full':'';?>>
                    <?php
                    /**
                     * @hooked premmerce_render_header_search - 10
                     */
                    do_action('premmerce_header_search');
                    ?>
                </div>

                <div class="pc-header-layout-5__cart hidden-lg hidden-md">
                    <?php wc_get_template('cart/cart-header.php'); ?>
                </div>
                <?php if(strip_tags(premmerce_option('header-phone')) != '') :?>
                <div class="pc-header-layout-5__phone hidden-xs hidden-sm">
                    <?php premmerce_render_header_phone(); ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    <div class="pc-header-layout-5__secondary hidden-xs hidden-sm">
        <div class="page__container">
            <div class="pc-header-layout-5__navbar" data-megamenu-container>
                <div class="pc-header-layout-5__navbar-navigation">

                    <div class="catalog-btn <?php echo is_front_page() ? 'catalog-btn--front-page' : ''; ?>">
                        <div class="catalog-btn__button" <?php echo apply_filters('premmerce_catalog_btn_drop', true) ? 'data-catalog-btn' : ''; ?>>
                            <div class="catalog-btn__hamburger">
                                <?php premmerce_the_svg('hamburger'); ?>
                            </div>
                            <div class="catalog-btn__label">
                                <?php esc_html_e('Catalog', 'saleszone'); ?>
                            </div>
                            <div class="catalog-btn__arrow">
                                <i class="fa fa-caret-down" aria-hidden="true"></i>
                            </div>
                        </div>
                        <?php if (apply_filters('premmerce_catalog_btn_drop', true)) : ?>
                            <div class="catalog-btn__drop is-hidden" data-catalog-btn-menu>
                                <?php
                                /**
                                 * @hooked premmerce_render_catalog_btn_menu - 10
                                 */
                                do_action('premmerce_catalog_btn_menu'); ?>
                            </div>
                            <div class="catalog-btn__overlay hidden" data-catalog-btn-overlay></div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="pc-header-layout-5__navbar-panel">

                    <ul class="pc-header-layout-5__toolbar">

                        <li class="pc-header-layout-5__toolbar-item pc-header-layout-5__toolbar-item--profile" >
                            <div class="pc-header-layout-5__toolbar-icon pc-header-layout-5__toolbar-icon--profile">
                                <?php premmerce_the_svg('profile'); ?>
                            </div>
                            <span class="pc-header-layout-5__toolbar-link" rel="nofollow">
                                <?php esc_html_e('Profile', 'saleszone'); ?>
                            </span>
                            <div class="pc-header-layout-5__toolbar-drop pc-header-layout-5__toolbar-drop--rtl">
                                <?php get_template_part('parts/header/parts/header', 'profile-overlay'); ?>
                            </div>
                            <i class="pc-header-layout-5__toolbar-link-arrow">
                                <?php premmerce_the_svg('arrow-down'); ?>
                            </i>
                        </li>

                        <!-- Wishlist -->
                        <?php if (function_exists('premmerce_wishlist')) : ?>
                            <?php get_template_part('premmerce-woocommerce-wishlist/wishlist', 'total'); ?>
                        <?php endif; ?>

                        <!-- Comparison -->
                        <?php if (function_exists('premmerce_comparison')) : ?>
                            <li class="pc-header-layout-5__toolbar-item hidden-xs">
                                <?php get_template_part('premmerce-product-comparison/comparison', 'total'); ?>
                            </li>
                        <?php endif; ?>

                        <?php wc_get_template('cart/cart-header.php'); ?>
                    </ul>

                </div>
            </div>
        </div>
    </div>

    <?php if(is_front_page()) :?>
    <div class="pc-header-layout-5__header-bottom">
        <div class="page__container">
            <div class="pc-header-layout-5__menu-section">
                <div class="pc-header-layout-5__menu-section-aside hidden-xs hidden-sm">
                    <?php
                    /**
                     * @hooked premmerce_render_catalog_btn_menu - 10
                     */
                    do_action('premmerce_catalog_btn_menu'); ?>
                </div>
                <div class="pc-header-layout-5__menu-section-body">
                    <?php echo do_shortcode(get_theme_mod('homepage-after-header')); ?>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>