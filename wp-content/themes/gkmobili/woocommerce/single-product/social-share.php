<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

$social_share_links = premmerce_get_social_share_links();

if(count($social_share_links) == 0){
    return ;
}


?>

<div class="soc-share">
    <div class="soc-share-label">
        <?php esc_attr_e( 'Share on:' ); ?>
    </div>
    <ul class="soc-share__row">
        <?php foreach ($social_share_links as $soc => $link) : ?>
            <?php if(get_theme_mod('share-'.$soc, true)) :?>
            <li class="soc-share__item">
                <a class="soc-share__button soc-share__button--<?php echo esc_attr($soc); ?>" href="<?php echo esc_url($link) ?>" data-social-share-link>
                    <i class="soc-share__icon">
                        <?php premmerce_the_svg($soc); ?>
                    </i>
                </a>
            </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
</div>