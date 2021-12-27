<?php get_header(); ?>
<div class="content">
    <div class="content__container">

        <div class="error-page">
        
            <div class="error-page__cell error-page__cell--info">
                <h1 class="error-page__title">404</h1>
                <h2 class="error-page__title">
                    <?php esc_html_e('Page not found!', 'saleszone'); ?>
                </h2>
                                <p class="error-page__desc">
                    <?php esc_html_e('The page you were looking for cloud not be found. It might have been removed, renamed, or did not exist in the first place.', 'saleszone'); ?>
                </p>
                
                <div class="search_404">
                <?php
                    /**
                     * @hooked premmerce_render_header_search - 10
                     */
                    do_action('premmerce_header_search');
                    ?>
                    <a href="<?php echo esc_url(home_url('/')) ?>"
                   class="error-page__button">
                    <?php esc_html_e('Home', 'saleszone'); ?>
                </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>