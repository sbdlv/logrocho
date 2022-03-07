$(function () {
    $("#bar_rating").slider({
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
    $("#amount").html('<i class="fas fa-star me-2"></i>' + $("#bar_rating").slider("values", 0) +
        " - " + $("#bar_rating").slider("values", 1));
});


//Filters
let makeQuery = $("#results").AjaxSearch({
    baseUrl: "index.php/bar/searchQuery/",
    countUrl: "index.php/bar/searchTotal/",
    resultsPerPage: 6,
    getTemplate: (data) => {
        let stars = $("<div></div>").addClass("mb-2");

        for (let i = 0; i < data.rating; i++) {
            stars.append('<i class="fas fa-star"></i>')
        }

        for (let i = 0; i < 5 - data.rating; i++) {
            stars.append('<i class="fas fa-star off"></i>')
        }

        return $("<a></a>").addClass("tarjeta tarjeta-btn bar-search-card row mx-auto mb-4").append(
            $("<div></div>").addClass("col-lg-3 col-12 imgWrapper img-card-responsive").append(
            ),
            $("<div></div>").addClass("col-lg-9 col-12 p-4").append(
                $("<h3></h3>").text(data.name).addClass("mb-1"),
                stars,
                $("<div></div>").addClass("address").append(
                    $('<i class="fas fa-building"></i>'),
                    $("<p></p>").text(data.address)
                ).addClass("mb-2"),
                $("<div></div>").text(data.desc).addClass("text_clamp_3")
            ),
        ).attr("href", `index.php/bar/${data.id}`)
    }
});

let queryData = {};

function requestData() {
    makeQuery(queryData);
}

$("#bar_name").on("input", (e) => {
    queryData.name = $("#bar_name").val();
    requestData();
});

$("#bar_address").on("input", (e) => {
    queryData.address = $("#bar_address").val();
    requestData();
});