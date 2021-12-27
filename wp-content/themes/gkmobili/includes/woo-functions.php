<?php
// add the ajax fetch js
add_action('wp_footer', 'ajax_fetch_category_images');
function ajax_fetch_category_images()
{
?>
    <script type="text/javascript">
        (function($) {
            $(document).ready(function() {
                $(".single-product .product").on('click', " div[data-variable-type='color']", function(e) {
                    e.stopPropagation();
                    var $this = $(this),
                        product = $(this).closest('div.product'),
                        $sku = $('.pc-product-single__summary .sku_wrapper > span[data-product-sku]').text().trim(),
                        $post_id = product.attr("data-product"),
                        $color = $(this).attr('data-select').toLowerCase(),
                        title = $('.product_title.entry-title').text();

                    $.ajax({
                        url: '<?php echo admin_url('admin-ajax.php'); ?>',
                        type: 'post',
                        data: {
                            action: 'data_fetch_archive',
                            color: $color,
                            post_id: $post_id,
                            sku: $sku,
                            target: 'single'
                        },
                        success: function(data) {
                            $this.addClass('variable-active').siblings('div').removeClass('variable-active');
                            data = data.split('|');
                            $('div.product').each(function() {
                                if ($(this).attr('data-product') == $post_id) {
                                    $(this).find('img.product-photo__img').remove();
                                    $(this).find('a.product-photo__item').prepend('<img class="product-photo__img" src=' + data[0] + '>');

                                    $(this).find('.product-photo__thumbs-wrapper .slick-track').empty();
                                    $(this).find('.slick-dots').empty();
                                    var bullet_class = '';
                                    for (var i = 0; i < data.length; i++) {
                                        if (i == 0) {
                                            bullet_class = "slick-active";
                                        }else{
                                            bullet_class = "slick";
                                        }
                                        $(this).find('.slick-dots').append('<li class="' + bullet_class + '" role="presentation"><button type="button" role="tab" id="slick-slide-control0' + i + '" aria-controls="slick-slide0' + i + '" aria-label="1 of 1" tabindex="' + i + '" aria-selected="true">' + (i + 1) + '</button></li>');

                                        $(this).find('.product-photo__thumbs-wrapper .slick-track').append('<li class="product-photo__thumb slick-slide slick-current slick-active" data-slick-index="0" aria-hidden="false" style="width: 618px;" tabindex="0" role="tabpanel" id="slick-slide0' + i + '" aria-describedby="slick-slide-control0' + i + '"><a class = "product-photo__thumb-item" href="' + data[i] + '" target = "_blank" data-product-photo-thumb="' + data[i] + '" data-magnific-galley-title="' + title + '" tabindex="0"><img class = "product-photo__thumb-img" src = "' + data[i] + '" alt = "' + title + '" title = "' + title + '"></a></li>');
                                    }
                                }
                            });
                        }
                    });
                });


                $(".archive .pc-product-loop .product .variations").on('click', "div[data-variable-type='color']", function(e) {
                    e.stopPropagation();
                    var $this = $(this),
                        product = $(this).closest('div.product'),
                        $post_id = product.attr("data-product"),
                        $color = $(this).attr('data-select').toLowerCase();

                    $.ajax({
                        url: '<?php echo admin_url('admin-ajax.php'); ?>',
                        type: 'post',
                        data: {
                            action: 'data_fetch_archive',
                            color: $color,
                            post_id: $post_id,
                            target: 'archive'
                        },
                        success: function(data) {
                            $this.addClass('variable-active').siblings('div').removeClass('variable-active');
                            $('div.product').each(function() {
                                if ($(this).attr('data-product') == $post_id) {
                                    $(this).find('.flipper__front img.product-photo__img').remove();
                                    $(this).find('.flipper__front a.product-photo__item').prepend(data);
                                }
                            });
                        }
                    });


                });
            });
        })(jQuery);
    </script>

<?php
}

// the ajax function
add_action('wp_ajax_data_fetch_archive', 'data_fetch_archive');
add_action('wp_ajax_nopriv_data_fetch_archive', 'data_fetch_archive');
function data_fetch_archive()
{
    $product = wc_get_product(esc_attr($_POST['post_id']));
    $product_color = esc_attr($_POST['color']);

    $product = new WC_Product_Variable($product);
    $variations = $product->get_available_variations();

    foreach ($variations as $variation) {
        if ($_POST['target'] == 'archive') {
            if ($variation['attributes']['attribute_pa_colors'] == $product_color) {
                echo '<img class="product-photo__img" src=' . $variation['image']['thumb_src'] . '>';
            }
        } else if ($_POST['target'] == 'single') {
            if ($variation['attributes']['attribute_pa_colors'] == $product_color) {
                $suffixes = array('b', 'c', 'd');
                $url = $variation['image']['url'];
                $folder = preg_replace('/(http(?:s)?:\/\/.+)(' . $_POST['sku'] . '.*)(\.(?:jpg|png))/', '$1', $url);
                $main_file = preg_replace('/(http(?:s)?:\/\/.+)(' . $_POST['sku'] . '.*)(\.(?:jpg|png))/', '$2', $url);
                $extension = preg_replace('/(http(?:s)?:\/\/.+)(' . $_POST['sku'] . '.*)(\.(?:jpg|png))/', '$3', $url);

                echo $url;

                foreach ($suffixes as $suffix) {
                    if (null != ($thumb_id = does_file_exists($main_file . '_' . $suffix . $extension))) {
                        echo "|" . wp_get_attachment_url($thumb_id);
                    }
                }
            }
        }
    }
    die;
}

function does_file_exists($filename)
{
    global $wpdb;
    return intval($wpdb->get_var("SELECT post_id FROM {$wpdb->postmeta} WHERE meta_value LIKE '%/$filename'"));
}
