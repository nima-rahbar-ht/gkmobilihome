<?php

$phones = preg_split("/[\n]/", premmerce_option('header-phone'));
$font_size = premmerce_option('header-phone-icon-size') . 'px';

?>

<div class="pc-header-phones" style="font-size: <?php echo esc_attr($font_size); ?>;">
    <?php if(premmerce_option('header-phone-show-icon')) :?>
        <?php $size = premmerce_option('header-phone-icon-size') . 'px'; ?>
        <div class="pc-header-phones__ico"
             style="width:15.69px; height: <?php echo esc_attr($size); ?>;">
            <img src="/wp-content/uploads/2021/10/fa-phone-alt.svg" width="27" height="27" alt="phone icon">
        </div>
    <?php endif; ?>
    <div class="pc-header-phones__body">
        <?php if($title = premmerce_option('header-phone-title')) :?>
            <div class="pc-header-phones__phone-title">
                <?php echo esc_html($title); ?>
            </div>
        <?php endif; ?>
        <div class="pc-header-phones__phones-list <?php echo premmerce_option('header-phone-display-type') == 'list-horizontal' ? 'pc-header-phones__phones-list--horizontal':'' ?>">
            <?php foreach ($phones as $phone): ?>
                <div class="pc-header-phones__phones-item">
                    <a class="pc-header-phones__link" href="tel:<?php echo esc_attr(premmerce_clear_phone_number($phone)); ?>"
                       style="font-size: <?php echo esc_attr(premmerce_option('header-phone-font-size')); ?>px;">
                        <?php echo wp_kses_post($phone); ?>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</div>
