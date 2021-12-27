<div class="pc-header-layout-2">

    <!-- Headline -->
    <div class="pc-header-layout-2__headline">
        <div class="page__container">
            <div class="pc-header-layout-2__headline-body">
                <div class="pc-header-layout-2__headline-left">
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
                <div class="pc-header-layout-2__headline-right">
                    <?php get_template_part('parts/header/parts/header', 'toolbar') ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <div class="pc-header-layout-2__main">
        <div class="page__container">
            <div class="pc-header-layout-2__main-body">

                <!-- Hamburger menu -->
                <div class="pc-header-layout-2__hamburger">
                    <button class="btn-mobile-icon" data-page-mobile-btn>
                        <?php premmerce_the_svg('hamburger'); ?>
                    </button>
                    <button class="btn-mobile-icon hidden" data-page-mobile-btn>
                        <?php premmerce_the_svg('close-bold'); ?>
                    </button>
                </div>

                <!-- Search -->
                <div class="pc-header-layout-2__search">
                    <?php
                    /**
                     * @hooked premmerce_render_header_search - 10
                     */
                    do_action('premmerce_header_search');
                    ?>
                </div>

                <!-- Logo -->
                <div class="pc-header-layout-2__logo">
                    <?php premmerce_site_logo(); ?>
                </div>

                <!-- Cart -->
                <ul class="pc-header-layout-2__icons-lg">
                    <?php if(strip_tags(premmerce_option('header-phone')) != '') :?>
                    <li class="pc-header-layout-2__phones">
                        <?php premmerce_render_header_phone(); ?>
                    </li>
                    <?php endif; ?>
                    <li class="pc-header-layout-2__cart">
                        <?php wc_get_template('cart/cart-header.php'); ?>
                    </li>
                </ul>

            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    <div class="pc-header-layout-2__navigation">
        <div class="page__container">
            <?php if (has_nav_menu('main_catalog_nav')) {
                premmerce_render_main_menu();
            } ?>
        </div>
    </div>
</div>