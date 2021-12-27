<div class="pc-header-layout-1">

    <!-- Headline -->
    <div class="pc-header-layout-1__headline">
        <div class="page__container">
            <div class="pc-header-layout-1__headline-body">
                <div class="pc-header-layout-1__headline-left">
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
                <!-- Phones and call-back -->
                <?php if(strip_tags(premmerce_option('header-phone')) != '') :?>
                <div class="pc-header-layout-1__phones">
                    <?php premmerce_render_header_phone(); ?>
                </div>
                <?php endif; ?>
                <div class="pc-header-layout-1__headline-right">
                    <div class="lang_top_bar">
                        <?php echo do_shortcode('[wpml_language_selector_widget]'); ?>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <div class="pc-header-layout-1__main">
        <div class="page__container">
            <div class="pc-header-layout-1__main-body">

                <!-- Hamburger menu -->
                <div class="pc-header-layout-1__hamburger">
                    <button class="btn-mobile-icon" data-page-mobile-btn>
                        <?php premmerce_the_svg('hamburger'); ?>
                    </button>
                    <button class="btn-mobile-icon hidden" data-page-mobile-btn>
                        <?php premmerce_the_svg('close-bold'); ?>
                    </button>
                </div>

                <!-- Logo -->
                <div class="pc-header-layout-1__logo">
                    <?php premmerce_site_logo(); ?>
                </div>
                <!-- Main Navigation -->
                <?php if (has_nav_menu('main_catalog_nav')) {
                    premmerce_render_main_menu();
                } ?>
                <div class="header_cnt_right">
                    <div class="header_cnt_right_mobile_inner">
                        <div class="mobile_nav_icons_right">
                            <?php if(premmerce_is_woocommerce_activated()){get_template_part('parts/header/parts/header', 'profile');} ?>                            
                            <?php if(premmerce_is_woocommerce_activated()){ wc_get_template('cart/cart-header.php'); } ?>
                        </div>
                    </div>
                    <div class="header_cnt_right_inner">
                        <!-- Search -->
                        <div class="pc-header-layout-1__search">
                            <?php
                            /**
                             * @hooked premmerce_render_header_search - 10
                             */
                            do_action('premmerce_header_search');
                            ?>
                        </div>
                        
                        <!-- Toolbar -->
                        <div class="pc-header-layout-1__header_toolbar">
                            <?php get_template_part('parts/header/parts/header', 'toolbar') ?>
                        </div>

                        <!-- Cart -->
                        <div class="pc-header-layout-1__cart">
                            <div class="pull-right">
                                <?php
                                    if(premmerce_is_woocommerce_activated()){
                                        wc_get_template('cart/cart-header.php');
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

 

</div>