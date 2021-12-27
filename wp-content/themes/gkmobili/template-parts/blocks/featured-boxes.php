<?php
/**
 * Featured boxes template
 */
?>
<?php if( have_rows( 'featured_boxes' ) ): ?>
	
<div class="featured-boxes">
	<?php
	while( have_rows('featured_boxes') ) : the_row();
		$image = get_sub_field( 'image' );
		$title = get_sub_field( 'title' );
		$excerpt = get_sub_field( 'excerpt' );
		$box_url = get_sub_field( 'box_url' );
	?>
	<div class="box" style="background: url( <?php echo wp_get_attachment_image_src( $image['ID'], 'full' )[0]; ?> )">
		<div class="fb_box_cnt">
			<div class="top_section_fb">
				<div class="title_fb">
					<?php echo $title; ?>
				</div>
				<div class="excerpt_fb">
					<?php echo $excerpt; ?>
				</div>		
			</div>			
			<div>	
				<div class="link_fb cool-link">
					<a href="<?php echo $box_url; ?>" class='box__inner box_link '><span><?php _e("Shop Now","luc_featured_boxes") ?></span></a>
				</div>
			</div>
		</div>
	</div>	
	<?php endwhile; ?>	
</div>
<?php endif; ?>


