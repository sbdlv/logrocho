$.fn.AjaxSearch = function (options = {}) {
    this.append(
        $("<div></div>")
    )

    //Pagination Wrapper
    this.append($("<nav></nav>"));

    let root = this;

    //Print first page
    $.ajax({
        type: "GET",
        url: getQueryUrlWithArgs(options),
        dataType: "json",
        success: function (response) {
            options.currentData = response;
            printResults(root, options);
        }
    });
    printPagination(this, options);
    return this;
}

/**
 * 
 * @param {JQuery} root 
 * @param {*} options 
 * @param {number} page 
 */
function printResults(root, options) {
    let resultsWrapper = root.find("div").eq(0);

    //orderResults(root, options);

    //Reset table rows
    resultsWrapper.html("");

    //Display the data
    resultsWrapper.append(
        options.currentData.map((data) => {
            return options.getTemplate(data);
        })
    )
}

function printPagination(root, options) {
    let pageButtons = [];
    let nav = root.find("nav").eq(0);

    $.ajax({
        type: "GET",
        url: options.countUrl,
        dataType: "json",
        success: function (response) {
            let total = parseInt(response);
            let isLastPage = total - options.page * options.resultsPerPage <= 0;


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

    return options.baseUrl + page;
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

    $.ajax({
        type: "GET",
        url: getQueryUrlWithArgs(options),
        dataType: "json",
        success: function (response) {
            options.currentData = response;
            printResults(root, options);
        }
    });

    printPagination(root, options);
}

function orderResults(root, options) {
    if (options.orderBy == null) {
        return;
    }
    options.currentData.sort((a, b) => {
        let result = 0;
        if (a[options.orderBy] > b[options.orderBy]) {
            result = 1;
        } else if (a[options.orderBy] < b[options.orderBy]) {
            result = -1;
        }

        if (options.orderAsc) {
            return -result;
        }

        return result;
    });
}

function colselector_change(e, root, options) {
    options.showCols = $(e.target).val();

    printHeaders(root, options);
    printTable(root, options);
}

function printHeaders(root, options) {
    let thead = root.find("thead").eq(0);
    thead.html("");

    thead.append(
        $("<tr></tr>").append(
            options.structure.map((col) => {
                if (!options.showCols || options.showCols.includes(col.queryIndex)) {
                    let th = $("<th></th>").text(col.header.displayName).attr("data-order-index", col.queryIndex).on("click", (e) => header_click(e, options, root)).addClass(col.class);
                    if (col.queryIndex == options.orderBy) {
                        th.attr("data-current-order", options.orderAsc ? "asc" : "desc");
                    }

                    return th;
                }
            }),
            $("<th></th>").text("Acciones").addClass("text-center")
        )
    )
}

function deleteRow(id, root, options) {
    $.ajax({
        type: "POST",
        url: options.deleteUrl,
        data: {
            id: id
        },
        success: function (response) {
            $.ajax({
                type: "GET",
                url: getQueryUrlWithArgs(options),
                dataType: "json",
                success: function (response) {
                    options.currentData = response;
                    printTable(root, options);
                }
            });
            alert("¡Fila eliminada!");
        },
        error: function (response) {
            alert("Error al eliminar la fila");
        },
    });

}