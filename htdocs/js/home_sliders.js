//Sliders
var swiperBest5 = new Swiper(".best_pinchos_swiper", {
    spaceBetween: 30,
    centeredSlides: true,
    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
    },
    effect: "fade",
    loop: true
});
let bestPinchosSlider = $(".best_pinchos_swiper").eq(0);
addPausePlayButton(bestPinchosSlider, swiperBest5);

var swiperFav5 = new Swiper(".fav_swiper", {
    spaceBetween: 30,
    centeredSlides: true,
    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
    },
    effect: "flip",
    loop: true
});
let favSlider = $(".fav_swiper").eq(0).css("display", "none");
addPausePlayButton(favSlider, swiperFav5);

$(".last_pinchos_slider").owlCarousel({
    dots: true,
    margin: 10,
    nav: false,
    items: 3,
    responsive: {
        0: {
            items: 1
        },
        760: {
            items: 2
        },
        1200: {
            items: 3
        }
    }
});

$(".last_reviews_slider").owlCarousel({
    dots: true,
    margin: 10,
    nav: false,
    items: 2,
    autoplay: true,
    responsive: {
        0: {
            items: 1
        },
        760: {
            items: 2
        },
        1200: {
            items: 2
        }
    }
});


//Toggle sliders
$("#toggleFavSlider").on("click", () => {
    bestPinchosSlider.css("display", "none");
    favSlider.css("display", "block");
})

$("#toggleBestPinchosSlider").on("click", () => {
    bestPinchosSlider.css("display", "block");
    favSlider.css("display", "none");
})


/**
 * 
 * @param {JQuery} slider 
 */
function addPausePlayButton(slider, swiper) {
    slider.append(
        $("<div></div>").addClass("slider-custom-controls d-flex justify-content-center mb-2").append(
            $("<button></button>").addClass("prev").on("click", () => {
                swiper.slidePrev();
            }),
            $("<button></button>").addClass("pause mx-3").on("click", (e) => {
                let og = $(e.target);

                if (og.hasClass("play")) {
                    swiper.autoplay.start();

                    og.removeClass("play");
                    og.addClass("pause");
                } else {
                    swiper.autoplay.stop();
                    og.removeClass("pause");
                    og.addClass("play");
                }

            }),
            $("<button></button>").addClass("next").on("click", () => {
                swiper.slideNext();
            }),
        )
    )
}