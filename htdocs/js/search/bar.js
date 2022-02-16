$(function () {
    $("#slider-range").slider({
        range: true,
        min: 0,
        max: 5,
        values: [0, 5],
        slide: function (event, ui) {
            $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
        }
    });
    $("#amount").val("$" + $("#slider-range").slider("values", 0) +
        " - $" + $("#slider-range").slider("values", 1));
});


//Filters
$("#results").AjaxSearch({
    baseUrl: "index.php/bar/jsonAll/",
    countUrl: "index.php/bar/total/",
    deleteUrl: "index.php/bar/delete/",
    infoBaseUrl: "index.php/bar/edit/",
    resultsPerPage: 4,
    getTemplate: (data) => {
        return $("<a></a>").addClass("tarjeta tarjeta-btn bar-search-card row mx-auto mb-4").append(
            $("<div></div>").addClass("col-3 imgWrapper").append(
            ),
            $("<div></div>").addClass("col p-4").append(
                $("<h3></h3>").text(data.name),
                $("<div></div>").addClass("address").append(
                    $('<i class="fas fa-building"></i>'),
                    $("<p></p>").text(data.address)
                ),
                $("<div></div>").text("Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.")
            ),
        ).attr("href", "#")

    }
});