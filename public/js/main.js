(function ($) {
    "use strict";

    countItem();
    // addItem();
    $(".add-to-cart .add-to-cart-btn").on("click", function () {
        // e.preventDefault();
        let urlCart = $(this).data('url');
        console.log(urlCart);
        $.ajax({
            type: "GET",
            url: urlCart,
            success: function(data){
            if(data.code === 200) {
                console.log(data);
                countItem();
                // addItem();

                // Swal.fire('Thêm vào giỏ hàng thành công 1','','success')// trả về thông báo thành công (success)//dùng sweat alert2
            }
            },
            error: function(err){
                console.log(err);
            }
        });
    });
        // Count cart item
        function countItem() {
            $.ajax({
                type: "GET",
                url: "/countCart",
                success: (res) =>{
                    $('.header-ctn>div>a>.qty').html(res.cartCount);
                    // $('.cart-list').append(res.listItem);
                    // console.log(res.listItem);
                },
                error: function (err) {console.log(err);}
            });
        }

        function addItem() {
            $.ajax({
                type: "GET",
                url: "/countCart",
                success: (res) =>{
                    // $('.header-ctn>div>a>.qty').html(res.cartCount);
                    $('.cart-list').append(res.listItem);
                    // console.log(res.listItem);
                },
                error: function (err) {console.log(err);}
            });
        }
    // Mobile Nav toggle
    $(".menu-toggle > a").on("click", function (e) {
        e.preventDefault();
        $("#responsive-nav").toggleClass("active");
    });

    // Fix cart dropdown from closing
    $(".cart-dropdown").on("click", function (e) {
        e.stopPropagation();
    });

    /////////////////////////////////////////

    // Products Slick
    $(".products-slick").each(function () {
        var $this = $(this),
            $nav = $this.attr("data-nav");

        $this.slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplay: true,
            infinite: true,
            speed: 1300,
            dots: false,
            arrows: true,
            appendArrows: $nav ? $nav : false,
            responsive: [
                {
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                    },
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    },
                },
            ],
        });
    });

    // Products Widget Slick
    $(".products-widget-slick").each(function () {
        var $this = $(this),
            $nav = $this.attr("data-nav");

        $this.slick({
            infinite: true,
            autoplay: true,
            speed: 1300,
            dots: false,
            arrows: true,
            appendArrows: $nav ? $nav : false,
        });
    });

    /////////////////////////////////////////

    // Product Main img Slick
    $("#product-main-img").slick({
        infinite: true,
        speed: 1300,
        dots: false,
        arrows: true,
        fade: true,
        asNavFor: "#product-imgs",
    });

    // Product imgs Slick
    $("#product-imgs").slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: true,
        centerMode: true,
        focusOnSelect: true,
        centerPadding: 0,
        vertical: true,
        asNavFor: "#product-main-img",
        responsive: [
            {
                breakpoint: 991,
                settings: {
                    vertical: false,
                    arrows: false,
                    dots: true,
                },
            },
        ],
    });

    // Product img zoom
    var zoomMainProduct = document.getElementById("product-main-img");
    if (zoomMainProduct) {
        $("#product-main-img .product-preview").zoom();
    }

    /////////////////////////////////////////

    // Input number
    $(".input-number").each(function () {
        var $this = $(this),
            $input = $this.find('input[type="number"]'),
            up = $this.find(".qty-up"),
            down = $this.find(".qty-down");

        down.on("click", function () {
            var value = parseInt($input.val()) - 1;
            value = value < 1 ? 1 : value;
            $input.val(value);
            $input.change();
            updatePriceSlider($this, value);
        });

        up.on("click", function () {
            var value = parseInt($input.val()) + 1;
            $input.val(value);
            $input.change();
            updatePriceSlider($this, value);
        });
    });

    var priceInputMax = document.getElementById("price-max"),
        priceInputMin = document.getElementById("price-min");

    if (priceInputMax) {
        priceInputMax.addEventListener("change", function () {
            updatePriceSlider($(this).parent(), this.value);
        });
    }
    if (priceInputMax) {
        priceInputMin.addEventListener("change", function () {
            updatePriceSlider($(this).parent(), this.value);
        });
    }


    function updatePriceSlider(elem, value) {
        if (elem.hasClass("price-min")) {
            console.log("min");
            priceSlider.noUiSlider.set([value, null]);
        } else if (elem.hasClass("price-max")) {
            console.log("max");
            priceSlider.noUiSlider.set([null, value]);
        }
    }

    // Price Slider
    var priceSlider = document.getElementById("price-slider");
    const minPrice = 1;
    const maxPrice = 10000;
    if (priceSlider) {
        noUiSlider.create(priceSlider, {
            start: [minPrice, maxPrice],
            connect: true,
            step: 1,
            range: {
                min: minPrice,
                max: maxPrice,
            },
        });

        priceSlider.noUiSlider.on("update", function (values, handle) {
            var value = values[handle];
            handle
                ? (priceInputMax.value = value)
                : (priceInputMin.value = value);
        });
    }
})(jQuery);
