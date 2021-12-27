<?php
if (!function_exists('premmerce_svg')) {
    function premmerce_svg($icon_name, $class = '')
    {

        $icon = apply_filters('premmerce-svg-icon--' . $icon_name, array(
            'class' => $class,
            'html' => '<span class="d-n">'.$icon_name.'</span><svg class="svg-icon ' . $class . ' "><use xlink:href="' . get_template_directory_uri() . '/public/svg/sprite.svg#svg-icon__' . $icon_name . '"></use></svg>'
        ), $icon_name);

        if ($icon_name === 'cart') {
            $icon['html'] = '<img src="/wp-content/uploads/2021/10/fa-shopping-bag-w.svg" alt="cart icon" class="cart_icon_w">';
        }

        return $icon['html'];
    }
}