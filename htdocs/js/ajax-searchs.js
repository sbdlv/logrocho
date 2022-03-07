$.fn.AjaxSearch = function (options = {}) {
    this.append(
        $("<div></div>").addClass("total h3 mb-4"),
        $("<div></div>").addClass("results")
    )

    //Pagination Wrapper
    this.append($("<nav></nav>"));

    let root = this;

    //Print first page
    root.find(".results").addClass("loading");
    $.ajax({
        type: "POST",
        url: getQueryUrlWithArgs(options),
        data: options.queryParams,
        dataType: "json",
        success: function (response) {
            options.currentData = response;
            printResults(root, options);
            printPagination(root, options);
        }
    });

    return (postValues) => {
        root.find(".results").addClass("loading");
        options.queryParams = postValues;
        $.ajax({
            type: "POST",
            url: getQueryUrlWithArgs(options),
            data: postValues,
            dataType: "json",
            success: function (response) {
                options.currentData = response;
                printResults(root, options);
                printPagination(root, options);
            }
        });
    };
}

/**
 * 
 * @param {JQuery} root 
 * @param {*} options 
 * @param {number} page 
 */
function printResults(root, options) {
    let resultsWrapper = root.find(".results");

    resultsWrapper.html("");

    resultsWrapper.removeClass("loading");

    if (options.currentData.length == 0) {
        resultsWrapper.append(
            $("<p></p>").addClass("h4").text("No se ha encontrado resultados")
        )
    } else {
        resultsWrapper.append(
            $("<div></div>"),
            $("<div></div>").append(
                options.currentData.map((data) => {
                    return options.getTemplate(data);
                })
            )
        );
    }
}

function printPagination(root, options) {
    let pageButtons = [];
    let nav = root.find("nav").eq(0);

    let resultsCountWrapper = root.find(".total");

    $.ajax({
        type: "POST",
        url: options.countUrl,
        data: options.queryParams,
        dataType: "json",
        success: function (response) {
            let total = parseInt(response);
            let isLastPage = total - options.page * options.resultsPerPage <= 0;

            //Total results
            resultsCountWrapper.text(`Resultados: ${total}`);

            //Prev number button
            if (options.page != 1) {
                pageButtons.push(generatePaginationNumericButton(options.page - 1, options.page - 1, root, options))
            }

            //Current button
            pageButtons.push(generatePaginationNumericButton(options.page, options.page, root, options, true))

            //Next number button
            if (!isLastPage) {
                pageButtons.push(generatePaginationNumericButton(options.page + 1, options.page + 1, root, options))
            }

            nav.html("");
            nav.append(
                $("<nav></nav>").append(
                    $("<ul></ul>").append(
                        generatePaginationNumericButton("Inicio", 1, root, options, false, options.page == 1),
                        pageButtons,
                        generatePaginationNumericButton("Última", Math.ceil(total / options.resultsPerPage), root, options, false, isLastPage)
                    ).addClass("pagination")
                )
            )
        }
    });
}

function getQueryUrlWithArgs(options) {
    let page = options.page ? options.page : 1;

    //Set current page for future operations
    options.page = page;

    let queryUrl = options.baseUrl + page + "/";

    queryUrl += options.resultsPerPage ? options.resultsPerPage : 4;

    return queryUrl;
}

function generatePaginationNumericButton(text, page, root, options, isActive = false, isDisabled = false) {
    return $(`<li class="page-item ${isActive ? "active" : ""}"></li>`).append($("<button></button>").addClass("page-link").text(text).attr("data-page", page)).prop("disabled", isDisabled).on("click", (e) => numericPagination_click(e, options, root));
}

/**
 * 
 * @param {*} e 
 * @param {*} options 
 * @param {JQuery} root 
 */
function numericPagination_click(e, options, root) {
    let pageToLoad = parseInt($(e.target).attr("data-page"));

    options.page = pageToLoad;

    root.find(".results").addClass("loading");

    $.ajax({
        type: "POST",
        url: getQueryUrlWithArgs(options),
        data: options.queryParams,
        dataType: "json",
        success: function (response) {
            options.currentData = response;
            printResults(root, options);
            printPagination(root, options);
            $("#results").get(0).scrollIntoView();
        }
    });

}