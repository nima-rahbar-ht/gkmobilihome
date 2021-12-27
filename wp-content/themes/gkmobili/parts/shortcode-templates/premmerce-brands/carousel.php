<div class="pc-section-secondary">

    <?php if($attributes['title']) :?>
        <div class="pc-section-secondary__header">
            <?php echo $attributes['title']; ?>
            <div class="pc-section-secondary__viewall">
                <a href="<?php echo home_url('brands'); ?>" class="pc-section-secondary__hlink">
                    <?php echo __('View all', 'saleszone') ?>
                </a>
            </div>
        </div>
    <?php endif; ?>

    <div class="brands-slider" data-slider="mainpage-brands">
        <div class="brands-slider__arrow brands-slider__arrow--prev" data-slider-arrow-left>
            <?php premmerce_the_svg('angle-left'); ?>
        </div>
        <div class="brands-slider__arrow brands-slider__arrow--next" data-slider-arrow-right>
            <?php premmerce_the_svg('angle-right'); ?>
        </div>
        <div class="brands-slider__row brands-slider__row--columns-<?php echo $attributes['columns']; ?>"
             data-slider-slides="2,4,6,<?php echo $attributes['columns']; ?>">
            <?php foreach ($brands as $brand): ?>
                <?php $imageURL = wp_get_attachment_image_url(get_term_meta($brand->term_id, 'thumbnail_id', true), 'medium'); ?>
                <div class="brands-slider__column" data-slider-slide>
                    <a class="brands-slider__link" href="<?php echo get_term_link($brand->slug, 'product_brand'); ?>">
                        <?php if ($imageURL = wp_get_attachment_image_url(get_term_meta($brand->term_id, 'thumbnail_id', true), 'full')) : ?>
                            <img class="brands-slider__item" src="<?php echo $imageURL; ?>" title="<?php echo $brand->name ?>" alt="<?php echo $brand->name ?>">
                        <?php else: ?>
                            <span class="brands-slider__item"><?php echo $brand->name ?></span>
                        <?php endif; ?>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
        
    </div>
</div>