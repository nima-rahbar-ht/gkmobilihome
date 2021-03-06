<div class="user-panel__item">
        <span class="user-panel__link">
            <i class="user-panel__ico user-panel__ico--profile">
                <?php /* premmerce_the_svg('user'); */ ?>
                <img src="/wp-content/uploads/2021/10/fa-user-circle.svg" alt="user">
            </i>
            <span class="user-panel__text-el">
                <?php /*  esc_html_e('Profile', 'saleszone');  */ ?>
            </span>
            <i class="user-panel__arrow user-panel__arrow--down">
                <?php premmerce_the_svg('arrow-down'); ?>
            </i>
        </span>
    <div class="user-panel__drop user-panel__drop--rtl">
        <?php get_template_part('parts/header/parts/header', 'profile-overlay'); ?>
    </div>
</div>