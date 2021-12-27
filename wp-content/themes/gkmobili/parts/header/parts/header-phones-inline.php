<?php if(strip_tags(premmerce_option('header-phone')) != '') :?>
    <div class="pc-header-phones-inline">
        <div class="pc-header-phones-inline__aside">
            <?php premmerce_the_svg('phone-fill', true, 'pc-header-phones-inline__ico'); ?>
        </div>
        <div class="pc-header-phones-inline__phones"><pre><?php echo esc_html(premmerce_option('header-phone')); ?></pre></div>
    </div>
<?php endif; ?>