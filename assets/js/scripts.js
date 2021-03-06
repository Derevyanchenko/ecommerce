jQuery( function( $ ) {

	/*===============================
		 Shop page
	==================================*/

	/*===== Product View Mode Change =====*/
	var viewItemClick = $(".product-view-mode li"),
			productWrapper = $(".shop-page-products-wrapper .products-wrapper");

	viewItemClick.each(function (index, elem) {
			var element = $(elem),
					viewStyle = element.data('viewmode');

			viewItemClick.on('click', function () {
					var viewMode = $(this).data('viewmode');
					productWrapper.removeClass(viewStyle).addClass(viewMode);
					viewItemClick.removeClass('active');
					$(this).addClass('active')
			});
	});

	/*=============================
		Mfp Modal Active JS
	==============================*/
	$(".modalActive").magnificPopup({
			type: 'inline',
			midClick: true,
			mainClass: 'veeraModal',
			preloader: false
	});

	/*=============================
		Nice Select Js
	==============================*/
	$('select').niceSelect();


	/*=============================
		Price Range Slider JS
	==============================*/

	var rangeSlider = $(".price-range"),
			amount = $("#amount"),
			minPrice = rangeSlider.data('min'),
			maxPrice = rangeSlider.data('max'),
			minPriceField = $("#min_price"),
			maxPriceField = $("#max_price"),
			form = $("#price_filter");


	rangeSlider.slider({
			range: true,
			min: minPrice,
			max: maxPrice,
			values: [minPriceField.val(), maxPriceField.val()],
			slide: function (event, ui) {
					amount.val( ui.values[0] + " $ - " + ui.values[1] + " $");
					minPriceField.val( ui.values[0] );
					maxPriceField.val( ui.values[1] );
			},
			stop: function( event, ui ) {
				form.submit();
			}
	});
	amount.val( rangeSlider.slider("values", 0) +
			" $ - " + rangeSlider.slider("values", 1) + " $" );

	/*=============================
		Product Quantity
	==============================*/
	var proQty = $(".pro-qty");
	if ( ! proQty.hasClass("cart-page__qty") ) {
		proQty.append('<a href="#" class="inc qty-btn">+</a>');
		proQty.append('<a href="#" class= "dec qty-btn">-</a>');
	}
	$(".woocommerce").on('click', '.qty-btn', function (e) {
			e.preventDefault();
			console.log("clicked");
			var $button = $(this);
			var oldValue = $button.parent().find('input').val();

			if ( proQty.hasClass("cart-page__qty") ) {

				var WoooriginalInput = $button.closest(".product-quantity").find(".input-text.qty.text");
				
				if ($button.hasClass('inc')) {
					var newVal = parseFloat(oldValue) + 1;
					WoooriginalInput.val(newVal);
				} else {
						// Don't allow decrementing below zero
						if (oldValue > 0) {
							var newVal = parseFloat(oldValue) - 1;
							WoooriginalInput.val(newVal);
						} else {
							newVal = 0;
						}
				}
				$button.parent().find('input').val(newVal);	
				WoooriginalInput.trigger('change');
				$("button[name='update_cart']").trigger("submit");

			} else {

				var WoooriginalInput = $('.input-text.qty.text').val();
				if ($button.hasClass('inc')) {
					var newVal = parseFloat(oldValue) + 1;
					WoooriginalInput + 1;
				} else {
						// Don't allow decrementing below zero
						if (oldValue > 0) {
							var newVal = parseFloat(oldValue) - 1;
							WoooriginalInput - 1;
						} else {
							newVal = 0;
						}
				}
				$button.parent().find('input').val(newVal);	
			}
			
	});

	$('.woocommerce').on('input', 'input.quantity', function (e) {
		e.preventDefault();
		console.log("input");
		var that = $(this),
			thatValue = parseInt(that.val()),
			oldInput = that.closest(".product-quantity").find(".input-text.qty.text");

		oldInput.val(thatValue);

	});

	/*==================================
			Single Product Zoom
	===================================*/
	$('.product-thumb-large-view .product-thumb-item').zoom();

	/*==================================
			Single Product Thumbnail JS
	===================================*/
	$('.product-thumb-carousel').slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: false,
			fade: true,
			asNavFor: '.product-thumbnail-nav, .vertical-tab-nav'
	});

	// Horizontal Nav Style
	$('.product-thumbnail-nav').slick({
			slidesToShow: 3,
			slidesToScroll: 1,
			asNavFor: '.product-thumb-carousel',
			dots: false,
			arrows: false,
			centerMode: true,
			centerPadding: 0,
			variableWidth: false,
			focusOnSelect: true
	});

	// Vertical Nav Style
	$('.vertical-tab-nav').slick({
			slidesToShow: 3,
			slidesToScroll: 1,
			asNavFor: '.product-thumb-carousel',
			dots: false,
			arrows: false,
			focusOnSelect: true,
			vertical: true
	});

	/*=============================
		Checkout Page Checkbox
	==============================*/
	$("#create_pwd").on("change", function () {
			$(".account-create").slideToggle("100");
	});

	$("#ship_to_different").on("change", function () {
			$(".ship-to-different").slideToggle("100");
	});

	/*=============================
		Payment Method Accordion
	==============================*/
	$('input[name="paymentmethod"]').on('click', function () {

			var $value = $(this).attr('value');

			$('.payment-method-details').slideUp();
			$('[data-method="' + $value + '"]').slideDown();
	});

	/*=============================
		Variations change
	==============================*/

	var variation_price = $('.woocommerce-variation-price bdi').html();
	$('.single-product-details .prices_group .price').html( variation_price );

	$( '.configurable-list .change_size:first' ).addClass('active');

	$( '.change_size' ).click(function(){
		var el = $(this),
				name = el.text(),
				val = el.data( 'value' );

		$( '.change_size' ).removeClass( 'active' );
		el.addClass( 'active' );

		$( '#pa_sizes' ).val( val );
		$( '#pa_sizes' ).change();

		$( '#configurable-name' ).html( '????????????: <b>' + name + '</b>' );

		var variation_price = $('.woocommerce-variation-price bdi').html();

		$('.single-product-details .prices_group .price').html( variation_price );
	});



	$('.single_variation_wrap').on( 'show_variation', function( event, variation ) {

		$( '.variable-product__price' ).text( variation.display_price );
		console.log( variation );


	} );

	/*=============================
		Star rating
	==============================*/

	$( '.change-star' ).click(function(){
		var el = $(this),
				val = el.data( 'value' );

		el.addClass( 'active' );
		el.nextAll().removeClass('active');
		el.prevAll().addClass('active');


		$( 'select[name="rating"]' ).val( val );

	});

	$( '#myTabContent .tab-pane:first-child' ).addClass( "show active" );
	$( '#desc-review-tab li:first-child a' ).addClass( "active" );
} );
