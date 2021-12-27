<?php
function htheme_render_mobile_menu() {
	if ( ! have_rows( 'diath_mega_menu', 'option' ) ) {
		return;
	}

	ob_start();
	?>

	<nav class="mobile-nav" data-mobile-nav>
		<ul class="mobile-nav__list" data-mobile-nav-list>

	<?php

	while ( have_rows( 'diath_mega_menu', 'option' ) ) {
		the_row();

		while ( have_rows( 'menu_item' ) ) {
			the_row();

			$has_mega_menu = false;

			if ( get_sub_field( 'menu_item_categories' ) || get_sub_field( 'menu_item_brands' ) || get_sub_field( 'menu_item_top_product' ) ) {
				$has_mega_menu = true;
			}

			$menu_item_title = get_sub_field( 'menu_item_title' );

			$li_class = 'menu-item menu-item-type-custom menu-item-object-custom mobile-nav__item';

			if ( $has_mega_menu ) {
				$li_class = 'menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children mobile-nav__item';
			}

			?>
			<li class="<?php echo $li_class; ?>">

				<a href="<?php echo get_sub_field( 'menu_item_url' ); ?>" class="mobile-nav__link" data-mobile-nav-link="">
					<?php echo $menu_item_title; ?>
					<?php if ( $has_mega_menu ) : ?>
					<span class="mobile-nav__has-children">
						<i class="mobile-nav__ico"><svg class="svg-icon  "><use xlink:href="http://localhost/psdg/htheme/wp-content/themes/saleszone-premium/public/svg/sprite.svg#svg-icon__arrow-right"></use></svg></i>
					</span>
					<?php endif; ?>
				</a>

				<?php if ( $has_mega_menu ) : ?>

				<ul class="mobile-nav__list mobile-nav__list--drop hidden" data-mobile-nav-list>
					<li class="mobile-nav__item" data-mobile-nav-item>
						<button class="mobile-nav__link mobile-nav__link--go-back" data-mobile-nav-go-back>Go back<span class="mobile-nav__has-children"><i class="mobile-nav__ico"><svg class="svg-icon"><use xlink:href="http://localhost/psdg/htheme/wp-content/themes/saleszone-premium/public/svg/sprite.svg#svg-icon__arrow-right"></use></svg></i></span></button>
					</li>
					<?php while ( have_rows( 'menu_item_categories' ) ) : ?>
						<?php the_row(); ?>
						<?php $sub_cats = get_sub_field( 'categories' ); ?>
							<?php foreach ( $sub_cats as $sub_cat ) : ?>
								<?php $wc_tax = get_term_by( 'id', $sub_cat, 'product_cat' ); ?>
								<li class="link-kitchen menu-item menu-item-type-custom menu-item-object-custom mobile-nav__item" data-mobile-nav-item="">
									<a class="mobile-nav__link" href="<?php echo get_term_link( $wc_tax ); ?>">
										<?php echo $wc_tax->name; ?>
										<span class="count">(<?php echo $wc_tax->count; ?>)</span>
									</a>
								</li>
							<?php endforeach; ?>
					<?php endwhile; ?>
				</ul>



				<?php endif; ?>
			</li>
			<?php
		}
	}
	?>

		</ul>
	</nav>

	<?php

	$html = ob_get_clean();

	echo $html;
}
/**/
