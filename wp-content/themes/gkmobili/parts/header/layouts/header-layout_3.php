<div class="pc-header-layout-3">
    <div class="page__container">
        <div class="pc-header-layout-3__row">

            <div class="pc-header-layout-3__hamburger hidden-lg hidden-md">
                <button class="btn-mobile-icon" data-page-mobile-btn>
                    <?php premmerce_the_svg('hamburger'); ?>
                </button>
                <button class="btn-mobile-icon hidden" data-page-mobile-btn>
                    <?php premmerce_the_svg('close-bold'); ?>
                </button>
            </div>

            <div class="pc-header-layout-3__logo">
                <?php premmerce_site_logo(); ?>
            </div>

            <div class="pc-header-layout-3__center hidden-xs hidden-sm">

                <div class="pc-header-layout-3__nav <?php echo strip_tags(premmerce_option('header-phone')) == '' ? 'pc-header-layout-3__nav--full':'';?>">
                    <?php if (has_nav_menu('header_nav')) {
                        wp_nav_menu(array(
                            'theme_location' => 'header_nav',
                            'walker' => new WalkerHeaderStatic(),
                            'container' => 'nav',
                            'container_class' => 'list-nav',
                            'menu_class' => 'list-nav__items',
                            'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s' . premmerce_render_walker_header_statick_list_nav_end() . '</ul>',
                        ));
                    } ?>
                </div>
                <?php if(strip_tags(premmerce_option('header-phone')) != '') :?>
                    <div class="pc-header-layout-3__delimiter visible-lg"></div>
                    <div class="pc-header-layout-3__contacts">
                        <?php premmerce_render_header_phone(); ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="pc-header-layout-3__right">
                <ul class="pc-header-layout-3__toolbar">

                    <!-- Wishlist -->
                    <?php if (function_exists('premmerce_wishlist')) : ?>
                        <li class="pc-header-layout-3__toolbar-item hidden-xs"
                            data-ajax-inject="wishlist-total-layout-3">
                            <?php get_template_part('premmerce-woocommerce-wishlist/wishlist', 'total'); ?>
                        </li>
                    <?php endif; ?>

                    <!-- Comparison -->
                    <?php if (function_exists('premmerce_comparison')) : ?>
                        <li class="pc-header-layout-3__toolbar-item hidden-xs">
                            <?php get_template_part('premmerce-product-comparison/comparison', 'total'); ?>
                        </li>
                    <?php endif; ?>

                    <li class="pc-header-layout-3__toolbar-item">
                        <?php wc_get_template('cart/cart-header.php'); ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    <div class="pc-header-layout-3__header-bottom">
        <div class="page__container">

            <div class="pc-header-layout-3__navbar" data-megamenu-container>
                <div class="pc-header-layout-3__navbar-navigation hidden-xs hidden-sm">

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
                <div class="pc-header-layout-3__navbar-search">
                    <?php
                    /**
                     * @hooked premmerce_render_header_search - 10
                     */
                    do_action('premmerce_header_search');
                    ?>
                </div>
                <?php if (has_nav_menu('header_navbar')) {
                    wp_nav_menu(array(
                        'theme_location' => 'header_navbar',
                        'walker' => new WalkerHeaderNavbar(),
                        'container' => false,
                        'items_wrap' => '<ul class="pc-header-layout-3__navbar-items hidden-xs hidden-sm">%3$s</ul>',
                    ));
                } ?>
                <div class="pc-header-layout-3__navbar-item hidden-xs hidden-sm">
                    <span class="pc-header-layout-3__navbar-link">
                        <span class="pc-header-layout-3__navbar-text-el">
                            <?php esc_html_e('Profile', 'saleszone'); ?>
                        </span>
                        <i class="pc-header-layout-3__navbar-link-arrow">
                            <i class="fa fa-caret-down" aria-hidden="true"></i>
                        </i>
                    </span>
                    <div class="pc-header-layout-3__navbar-drop pc-header-layout-3__navbar-drop--rtl">
                        <?php get_template_part('parts/header/parts/header', 'profile-overlay'); ?>dsadasds
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>