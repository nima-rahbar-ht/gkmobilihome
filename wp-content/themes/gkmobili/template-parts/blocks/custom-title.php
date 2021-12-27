<?php
/**
 * Custom title template
 */
?>
<div class="custom-title-wrapper">
	<?php
	$custom_image = "";
	if( get_field('custom_title_image') ){
		$custom_image_array = get_field('custom_title_image');
		$custom_image = wp_get_attachment_image( $custom_image_array['ID'], 'full' );
	}
	?>
	<h2><?php echo $custom_image . get_field('custom_title'); ?></h2>
	<a href="<?php the_field('view_more_url'); ?>" class="link-read-more hover-underline"><?php the_field('view_more_text'); ?></a>
</div>
<!-- /.custom-title-wrapper -->
