<div class="pc-header-layout-4" data-search-overlay-scope>

    <!-- Headline -->
    <div class="pc-header-layout-4__headline">
        <div class="page__container">
            <div class="pc-header-layout-4__headline-body">
                <div class="pc-header-layout-4__headline-left">
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
                <div class="pc-header-layout-4__headline-right">
                    <?php get_template_part('parts/header/parts/header', 'toolbar') ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <div class="pc-header-layout-4__main">
        <div class="page__container">
            <div class="pc-header-layout-4__main-body">

                <!-- Hamburger menu -->
                <div class="pc-header-layout-4__hamburger">
                    <button class="btn-mobile-icon" data-page-mobile-btn>
                        <?php premmerce_the_svg('hamburger'); ?>
                    </button>
                    <button class="btn-mobile-icon hidden" data-page-mobile-btn>
                        <?php premmerce_the_svg('close-bold'); ?>
                    </button>
                </div>

                <!-- Phones and call-back -->
                <?php if(strip_tags(premmerce_option('header-phone')) != '') :?>
                <div class="pc-header-layout-4__phones">
                    <?php premmerce_render_header_phone(); ?>
                </div>
                <?php endif; ?>


                <!-- Logo -->
                <div class="pc-header-layout-4__logo">
                    <?php premmerce_site_logo(); ?>
                </div>

                <div class="pc-header-layout-4__icons-lg">

                    <!-- Search -->
                    <div class="pc-header-layout-4__search">
                        <div class="search-overlay"  data-search-overlay-scope>
                            <button class="search-overlay__btn" type="button" data-search-overlay-btn>
                                <i class="search-overlay__icon">
                                    <?php premmerce_the_svg('search-thin'); ?>
                                </i>
                            </button>
                            <div class="search-overlay__overlay hidden" data-search-overlay-overlay></div>
                            <div class="search-overlay__search hidden"  data-search-overlay-search>
                                <?php
                                /**
                                 * @hooked premmerce_render_header_search - 10
                                 */
                                do_action('premmerce_header_search');
                                ?>
                            </div>
                        </div>
                    </div>

                    <!-- Cart -->
                    <div class="pc-header-layout-4__cart">
                        <?php wc_get_template('cart/cart-header.php'); ?>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    <div class="pc-header-layout-4__navigation">
        <div class="page__container">
            <?php premmerce_render_main_menu(); ?>
        </div>
    </div>
</div>