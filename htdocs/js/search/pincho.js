$(function () {
    $("#pincho_rating").slider({
        range: true,
        min: 0,
        max: 5,
        values: [0, 5],
        slide: function (event, ui) {
            queryData.minRating = ui.values[0];
            queryData.maxRating = ui.values[1];
            requestData();
            $("#amount").html('<i class="fas fa-star me-2"></i>' + ui.values[0] +
                " - " + ui.values[1]);
        }
    });
    $("#amount").html('<i class="fas fa-star me-2"></i>' + $("#pincho_rating").slider("values", 0) +
        " - " + $("#pincho_rating").slider("values", 1));
});


//Filters
let makeQuery = $("#results").AjaxSearch({
    baseUrl: "index.php/pincho/searchQuery/",
    countUrl: "index.php/pincho/searchTotal/",
    resultsPerPage: 6,
    getTemplate: (data) => {
        let stars = $("<div></div>").addClass("mb-2");

        for (let i = 0; i < Math.floor(data.rating); i++) {
            stars.append('<i class="fas fa-star"></i>')
        }

        for (let i = 0; i < 5 - data.rating; i++) {
            stars.append('<i class="fas fa-star off"></i>')
        }

        return $("<a></a>").addClass("tarjeta tarjeta-btn pincho-search-card row mx-auto mb-4").append(
            $("<div></div>").addClass("col-lg-3 col-12 imgWrapper img-card-responsive").append(
            ),
            $("<div></div>").addClass("col-lg-9 col-12 p-4").append(
                $("<h3></h3>").text(data.name).addClass("mb-1"),
                stars,
                $("<div></div>").addClass("address").append(
                    $('<i class="fas fa-utensils"></i>'),
                    $("<p></p>").text(data.bar_name)
                ).addClass("mb-2"),
                $("<div></div>").text(data.desc).addClass("text_clamp_3")
            ),
        ).attr("href", `index.php/pincho/${data.id}`)
    }
});

let queryData = {};

function requestData() {
    makeQuery(queryData);
}

$("#pincho_name").on("input", (e) => {
    queryData.name = $("#pincho_name").val();
    requestData();
});

$("#pincho_bar_name").on("input", (e) => {
    queryData.bar_name = $("#pincho_bar_name").val();
    requestData();
});