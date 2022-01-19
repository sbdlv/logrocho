window.onload = () => {
    let sliders = $(".slider");

    sliders.each((i, slider) => {
        $(slider).append(
            $("<div></div>").addClass("controles").append(
                [
                    $("<button></button>").on("click", (event) => {
                        prevSlide(slider);
                    }).addClass("prev"),
                    $("<button></button>").on("click", (event) => {
                        $(event.target).toggleClass("play");
                        stopSlider(slider);
                    }).addClass("pause"),
                    $("<button></button>").on("click", (event) => {
                        nextSlide(slider);
                    }).addClass("next")
                ]
            )
        )
    });

    setInterval(() => {
        sliders.each((i, slider) => {
            moveSlide(slider);
        });
    }, 5000)

    function moveSlide(slider, ignoreStop = false) {
        let isStopped = $(slider).attr("data-stop") == "true";
        let skip = $(slider).attr("data-skip") == "true";

        //Evitar que se pasa de slide autom. al hace nosotros clic manualmente
        if(!ignoreStop && skip){
            $(slider).attr("data-skip", "false");
            return;
        }
        
        if (!isStopped || ignoreStop) {
            let reverse = $(slider).attr("data-reverse") == "true";

            let activeSlide = $(".slides").eq(0).find(".active").eq(0);

            activeSlide.removeClass("active");
            activeSlide.addClass("disappear");
            activeSlide.removeClass("appear");

            let nextSlide = reverse ? activeSlide.prev().eq(0) : activeSlide.next().eq(0);

            if (nextSlide.length == 0) {
                nextSlide = reverse ? $(".slides").eq(0).children().last() : $(".slides").eq(0).children().first();
            }

            nextSlide.addClass("active");
            nextSlide.addClass("appear");
            nextSlide.removeClass("disappear");
        }
    }

    function nextSlide(slider) {
        $(slider).attr("data-reverse", "false").attr("data-skip", "true");
        moveSlide(slider, true);
    }

    function prevSlide(slider) {
        $(slider).attr("data-reverse", "true").attr("data-skip", "true");
        moveSlide(slider, true);
    }

    function stopSlider(slider) {
        let stopped = $(slider).attr("data-stop") == "true";
        $(slider).attr("data-stop", !stopped);
    }

    $("#preferidos").on("click", ()=>{
        $("#slider1").attr("data-style", "").find(".slides").eq(0).html("") .append(
            [
                $("<div></div>").addClass("wrapper").append(
                    $("<img/>").attr("src", "img/p1.jpg")
                ).addClass("active"),
                $("<div></div>").addClass("wrapper").append(
                    $("<img/>").attr("src", "img/p2.jpg")
                ),
                $("<div></div>").addClass("wrapper").append(
                    $("<img/>").attr("src", "img/p3.jpg")
                ),
                $("<div></div>").addClass("wrapper").append(
                    $("<img/>").attr("src", "img/p4.jpg")
                ),
                $("<div></div>").addClass("wrapper").append(
                    $("<img/>").attr("src", "img/p5.webp")
                ),
            ]
        )
    })
    $("#valorados").on("click", ()=>{
        $("#slider1").attr("data-style", "fade").find(".slides").eq(0).html("") .append(
            [
                $("<div></div>").addClass("wrapper").append(
                    $("<img/>").attr("src", "img/pp1.jpg")
                ).addClass("active"),
                $("<div></div>").addClass("wrapper").append(
                    $("<img/>").attr("src", "img/pp2.jpg")
                ),
                $("<div></div>").addClass("wrapper").append(
                    $("<img/>").attr("src", "img/pp3.jpg")
                ),
                $("<div></div>").addClass("wrapper").append(
                    $("<img/>").attr("src", "img/pp4.jpg")
                ),
                $("<div></div>").addClass("wrapper").append(
                    $("<img/>").attr("src", "img/pp5.jpg")
                ),
            ]
        );
    })
}