$.fn.AjaxTable = function (options = {
    structure: [],
}) {
    //Table heads
    let tableHeads = $("<tr></tr>");

    this.data("options", options);

    options.structure.forEach(col => {
        tableHeads.append(
            $("<th></th>").text(col.header.displayName).attr("data-order-index", col.queryIndex).on("click", (e) => header_click(e, options, this))
        )
    });

    //Table body
    this.append(
        $("<table></table>").append(
            [
                $("<thead></thead>").append(
                    tableHeads
                ),
                $("<tbody></tbody>")
            ]
        )
    )

    //Pagination Wrapper
    this.append($("<nav></nav>"));

    //Print first page
    printTableAndPaginator(this, options);

    return this;
}

/**
 * 
 * @param {JQuery} root 
 * @param {*} options 
 * @param {number} page 
 */
function printTableAndPaginator(root, options) {
    let tbody = root.find("tbody").eq(0);

    //Refresh pagination
    printPagination(root, options);

    $.ajax({
        type: "GET",
        url: getQueryUrlWithArgs(options),
        dataType: "json",
        success: function (response) {
            console.log(response);
            //Reset table rows
            tbody.html("");

            //Display the data
            response.forEach(rowData => {
                let tr = $("<tr></tr>");

                //Generate td's based on the options
                options.structure.forEach(colStructure => {
                    tr.append(
                        $("<td></td>").append(
                            generateInputForField(colStructure.queryIndex, colStructure.col.type, rowData[colStructure.queryIndex])
                        )
                    )
                });

                tbody.append(tr);
            });

        }
    });
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
                        generatePaginationNumericButton("Última", total / options.resultsPerPage, root, options, false, isLastPage)
                    ).addClass("pagination")
                )
            )
        }
    });
}

function getQueryUrlWithArgs(options) {
    let page = options.page ? options.page : 1;

    let url = options.baseUrl + page;

    if (options.orderBy) {
        url += "/" + options.orderBy;

        if (options.orderAsc != null) {
            url += "/" + (options.orderAsc ? "ASC" : "DESC");
        }
    }

    //Set current page for future operations
    options.page = page;

    return url;
}

function generateInputForField(queryIndex, type, value) {
    switch (type) {
        case "text":
            return $("<input>").attr("type", "text").val(value);
        case "checkbox":
            return $(`<input ${value ? "checked" : ""}>`).attr("type", "checkbox");
        default:
            return String(value);
    }
}

function generatePaginationNumericButton(text, page, root, options, isActive = false, isDisabled = false) {
    return $(`<li class="page-item ${isActive ? "active" : ""}"></li>`).append($("<button></button>").addClass("page-link").text(text).attr("data-page", page)).prop("disabled", isDisabled).on("click", (e) => numericPagination_click(e, options, root));
}

function header_click(e, options, root) {
    let th = $(e.target);

    if (options.orderBy == th.attr("data-order-index")) {
        options.orderAsc = !options.orderAsc;

        th.attr("data-current-order", options.orderAsc ? "asc" : "desc");
    } else {
        options.orderBy = th.attr("data-order-index");
        options.orderAsc = false;

        $("[data-current-order]").eq(0).removeAttr("data-current-order");
        th.attr("data-current-order", options.orderAsc ? "asc" : "desc");
    }

    printTableAndPaginator(root, options);
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

    printTableAndPaginator(root, options);
}