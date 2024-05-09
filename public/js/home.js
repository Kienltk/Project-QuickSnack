$(document).ready(function () {
    $(".image-slider").slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        infinite: true,
        arrows: true,
        draggable: true,
        focusOnSelect: true,
        prevArrow: `<button type='button' class='slick-prev slick-arrow'><i class="fa-solid fa-angle-left"></button>`,
        nextArrow: `<button type='button' class='slick-next slick-arrow'><i class="fa-solid fa-angle-right"></i></button>`,
        responsive: [
            {
                breakpoint: 1025,
                settings: {
                    slidesToShow: 3,
                },
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    arrows: false,
                    pauseOnFocus: false,
                    pauseOnHover: false,
                },
            },
        ],
        autoplay: true,
        autoplaySpeed: 1000,
    });

    $(".category_list").slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        infinite: true,
        arrows: false,
        speed: 200,
        draggable: true,
        focusOnSelect: true,
        responsive: [
            {
                breakpoint: 1025,
                settings: {
                    slidesToShow: 2,
                },
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    pauseOnFocus: false,
                    pauseOnHover: false,
                },
            },
        ],
        autoplay: true,
        autoplaySpeed: 3000,
    });


});
