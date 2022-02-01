$(".last_pinchos_slider").owlCarousel({
    dots:true,
    margin:10,
    nav:false,
    items: 3,
    responsive:{
        0:{
            items:1
        },
        760:{
            items:2
        },
        1200: {
            items:3
        }
    }
});

$(".last_reviews_slider").owlCarousel({
    dots:true,
    margin:10,
    nav:false,
    items: 2,
    autoplay: true,
    responsive:{
        0:{
            items:1
        },
        760:{
            items:2
        },
        1200: {
            items:2
        }
    }
});


$(".best_slider").owlCarousel({
    dots: true,
    margin:10,
    nav:false,
    items: 1,
    navText: ['<i class="fas fa-chevron-left"></i>','<i class="fas fa-chevron-right"></i>'],
    loop: true,
});
