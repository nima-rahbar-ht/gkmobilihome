<?php if(count($benefits) > 0) :?>
<div class="benefits">
    <div class="benefits__row">
        <?php foreach ($benefits as $benefit): ?>
        <div class="benefits__column">
            <div class="benefits__item">
                <div class="benefits__ico">
                    <?php if(!empty($benefit['benefit_image'])) :?>
                        <?php echo wp_get_attachment_image($benefit['benefit_image'], 'full'); ?>
                    <?php elseif (!empty($benefit['benefit_fonts_icon'])): ?>
                        <i class="fa <?php echo $benefit['benefit_fonts_icon']; ?>" aria-hidden="true"></i>
                    <?php endif; ?>
                </div>
                <div class="benefits__inner">
                    <div class="benefits__title">
                        <?php echo $benefit['benefit_title']; ?>
                    </div>
                    <div class="benefits__desc">
                        <?php echo $benefit['benefit_description']; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?php endif; ?>
