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
        }
    });
    $("#amount").val("$" + $("#slider-range").slider("values", 0) +
        " - $" + $("#slider-range").slider("values", 1));
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
            $("<div></div>").addClass("col-3 imgWrapper").append(
            ),
            $("<div></div>").addClass("col p-4").append(
                $("<h3></h3>").text(data.name).addClass("mb-1"),
                stars,
                $("<div></div>").addClass("address").append(
                    $('<i class="fas fa-building"></i>'),
                    $("<p></p>").text(data.address)
                ).addClass("mb-2"),
                $("<div></div>").text("Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.")
            ),
        ).attr("href", "#")
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