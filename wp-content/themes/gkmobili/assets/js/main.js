jQuery(function ($) {
	$(".form__checkbox, .woocommerce-form__label-for-checkbox").each(function () {
		var $label = $(this);
		var $checkbox = $label.find('input[type="checkbox"]');

		$checkbox.on("change", function () {
			if ($checkbox.is(":checked")) {
				$label.addClass("active");
			} else {
				$label.removeClass("active");
			}
		});
	});

	$(document).on("updated_checkout", function () {
		console.log("updated_checkout");

		$(".shipping-methods__item, .payments-radio__list-item").each(function () {
			var $li = $(this);
			var $radio = $li.find('input[type="radio"]');

			if ($radio.is(":checked")) {
				$li.addClass("active");
			} else {
				$li.removeClass("active");
			}
		});
	});

	$(document).on(
		"change",
		'.payments-radio__list-item input[type="radio"]',
		function () {
			$(".payments-radio__list-item").each(function () {
				var $li = $(this);
				var $radio = $li.find('input[type="radio"]');

				if ($radio.is(":checked")) {
					$li.addClass("active");
				} else {
					$li.removeClass("active");
				}
			});
		}
	);

	//Show more button on categories list in products categories
	if (
		$(".categories-list-more").length &&
		$(".categories-list-more li").length >
			$(".categories-list-more li:visible").length
	) {
		$(".categories-list-more").after(
			'<div class="show-more-btn-wrapper"><a href="#" class="show-more-btn"><span class="text">Show more</span> <span class="icon"></span></a></div>'
		);
	}

	$(document).on("click", ".show-more-btn", function (e) {
		e.preventDefault();
		$(this).parent().hide().prev().addClass("show-all");
	});

	//Show more button on brands list in products categories
	if (
		$(".category-brands-widget").length &&
		$(".category-brands-widget .brands-widget__list-item").length >
			$(".category-brands-widget .brands-widget__list-item:visible").length
	) {
		$(".category-brands-widget .brands-widget__list").after(
			'<div class="show-more-btn-wrapper"><a href="#" class="show-more-btn"><span class="text">Show more</span> <span class="icon"></span></a></div>'
		);
	}

	/* const slider = $(".product-photo__thumbs");
	$(slider).slick({
		infinite: false,
		arrows: false,
		dots: true,
		slidesToShow: 2,
		slidesToScroll: 1,
		vertical: true,
		verticalSwiping: true,
		responsive: [
			{
				breakpoint: 881,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
					vertical: false,
					verticalSwiping: false,
				}
			},
		]
	});
	$(slider).on('wheel', (function (e) {
		e.preventDefault();

		if (e.originalEvent.deltaY < 0) {
			$(this).slick('slickPrev');
		} else {
			$(this).slick('slickNext');
		}
	})); */

	$("ul.table-nav__items li.menu-item.table-nav__item").each(function () {
		if ($(this).find(".mega-menu").length > 0) {
			$(this).addClass("arrow_nav");
		}
	});

	/* hide size from shop loop */
	if (
		$(
			".product-cut__info_cnt .pc-variations-table__row.pc-variations-table__row--type-default"
		).has("Size")
	) {
		jQuery(
			".product-cut__info_cnt .pc-variations-table__row.pc-variations-table__row--type-default"
		).addClass("hide_elem");
	}

	/**
	 * FIXME: WAVE Tool Fixes
	 */
	$(document).ready(function () {
		$(".pc-header-layout-1__header_toolbar .user-panel__item").eq(1).remove();

		jQuery(
			".product-loop-title > a, .basement_one, .catalog-toolbar__label, .quantity__input"
		).attr("style", "color: #000 !important;");
	});
});
