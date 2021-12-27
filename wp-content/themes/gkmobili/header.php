<!doctype html>
<html <?php language_attributes() ?>>
<head>
    <meta charset="<?php bloginfo('charset') ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <?php if (!is_plugin_active('wordpress-seo/wp-seo.php')): ?>
        <meta name="description" content="<?php bloginfo('description') ?>">
    <?php endif; ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <?php wp_head() ?>
</head>
<body <?php body_class('page'); ?>>
<?php do_action('premmerce_after_body_open'); ?>

<!-- Main content frame -->
<div class="page__body" data-page-pushy-container>
    <div class="page__layout <?php echo (premmerce_option('general_layout') == 'boxed') ? 'page__boxed-layout' : 'page__fluid-layout'; ?>">
        <div class="page__wrapper">

            <?php do_action('premmerce_before_header'); ?>

            <header class="page__hgroup">
                <div class="page__header">
                    <?php get_template_part('parts/header/layouts/header', premmerce_option('header_layout')); ?>
                </div>

                <?php if ( premmerce_saleszone_fs()->is__premium_only() ): ?>
                    <?php if (is_front_page() && get_theme_mod('homepage-after-header') && apply_filters('premmerce_display_after_header', true)): ?>
                        <div class="page__main-banner">
                            <div class="page__container">
                                <?php echo do_shortcode(get_theme_mod('homepage-after-header')); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

            </header>

            <?php do_action('premmerce_after_header'); ?>

            <div class="page__content">