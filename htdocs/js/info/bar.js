var swiper = new Swiper(".pincho_swiper", {
    spaceBetween: 30,
    centeredSlides: true,
    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
    },
    effect: "fade",
    loop: true
});
let pinchoSlider = $(".pincho_swiper").eq(0);
addPausePlayButton(pinchoSlider, swiper);

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