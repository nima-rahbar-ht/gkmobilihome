<?php
/**
 * Single Product Up-Sells
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if (!$upsells) {
    return;
} ?>
<div class="up-sells">
    <?php

    $productIds = array();

    foreach ($upsells as $upsell){
        $productIds[] = $upsell->get_id();
    }

		$productsIdsList = implode( ',', $productIds );

		echo do_shortcode( '[products limit="-1" ids="' . $productsIdsList . '" limit="-1" template="carousel" columns="4"]' );

	?>
</div>
