//Sliders

let bestPinchosSlider = $(".best_pinchos_slider");
bestPinchosSlider.owlCarousel(
    {
        autoplay: true,
        autoplayTimeout: 5000,
        loop: true,
        items: 1,
        nav: true,
        navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
        dots: false
    }
)
addPausePlayButton(bestPinchosSlider);

let favSlider = $(".fav_slider").css("display", "none");
favSlider.owlCarousel(
    {
        autoplay: true,
        autoplayTimeout: 5000,
        loop: true,
        items: 1,
        nav: true,
        navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
        dots: false,
        animateOut: 'animate__slideOutDown',
        animateIn: 'animate__flipInX',
    }
)
addPausePlayButton(favSlider);

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
function addPausePlayButton(slider) {
    $("<button></button>").on("click", (e) => {
        let button = $(e.target);
        let isStopped = button.attr("data-stopped") == "true";

        let i = button.children().eq(0).removeClass();

        if (isStopped) {
            slider.trigger("play.owl.autoplay");
            i.addClass("fas fa-pause");
        } else {
            slider.trigger("stop.owl.autoplay");
            i.addClass("fas fa-play");
        }

        button.attr("data-stopped", !isStopped);
    }).append($('<i class="fas fa-pause"></i>')).addClass("pause_play").insertAfter(slider.find(".owl-nav").eq(0).children().eq(0));
}