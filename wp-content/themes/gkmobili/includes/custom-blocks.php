<?php
/**
 * Custom ACF blocks
 */

function htheme_register_acf_block_types() {

	acf_register_block_type( array(
		'name'            => 'featured-boxes',
		'title'           => __( 'Featured boxes' ),
		'description'     => __( 'Homepage featured boxes' ),
		'render_template' => 'template-parts/blocks/featured-boxes.php',
		'category'        => 'htheme-blocks',
		'icon'            => 'archive',
		'mode'            => 'edit',
		'keywords'        => array( 'featured', 'boxes' ),
	) );

	acf_register_block_type( array(
		'name'            => 'custom-title',
		'title'           => __( 'Custom title' ),
		'description'     => __( 'Custom title centered with read more link (optional)' ),
		'render_template' => 'template-parts/blocks/custom-title.php',
		'category'        => 'htheme-blocks',
		'icon'            => 'archive',
		'mode'            => 'edit',
		'keywords'        => array( 'custom', 'title' ),
	) );

}

// Check if function exists and hook into setup.
if ( function_exists( 'acf_register_block_type' ) ) {
	add_action( 'acf/init', 'htheme_register_acf_block_types' );
}
