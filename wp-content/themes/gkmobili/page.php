<?php get_header(); ?>

<?php if(!is_front_page()): ?>
    <div class="content">
        <div class="content__container">

			<?php
				// If thank you page, change the header a little bit
				$classes = 'content__header text-content';
				$is_thank_you_page = false;

			if ( is_checkout() && ! empty( is_wc_endpoint_url( 'order-received' ) ) ) {
				$classes = 'content__header content__header--thank-you';
				$is_thank_you_page = true;
			}
			?>

            <?php if (have_posts()): the_post(); ?>
                <div class="<?php echo esc_attr( $classes ); ?>">
                    <h1 class="content__title">
						<?php the_title(); ?>
						<?php if( $is_thank_you_page ) : ?>
							<img src="<?php echo esc_attr( get_stylesheet_directory_uri() ); ?>/assets/images/icon_instock.svg" alt="Checkmark">
						<?php endif; ?>
					</h1>
                </div>
                <div class="content__row">
                    <div class="typo">
                    	<div class="text-content">
                        	<?php the_content(); ?>
                        </div>
                    </div>
                </div>
            <?php endif ?>
            <?php wp_reset_postdata(); ?>

            <?php if(comments_open()) :?>
                <div class="content__row">
                    <?php comments_template(); ?>
                </div>
            <?php endif; ?>

        </div>
    </div>
<?php else: ?>
    <div class="start-page typo">
        <?php if (have_posts()): the_post(); ?>
			<div class="start-page__container">
				<?php the_content(); ?>
			</div>
			<!-- /.start-page__container -->
        <?php endif; ?>
        <?php if (is_active_sidebar('homepage_widgets')) : ?>
            <div class="start-page__row-widgets">
                <div class="content__container">
                    <div class="row row--ib row--vindent-m">
                        <?php dynamic_sidebar('homepage_widgets'); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>

<?php get_footer(); ?>
