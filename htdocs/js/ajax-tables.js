$.fn.AjaxTable = function (options = {}) {
    //Show cols selector
    this.append(
        $("<div></div>").append(
            $("<h2>Mostrar columnas</h2>").addClass("h4 mb-4"),
            $("<select multiple autocomplete='off'></select>").addClass("form-select mb-4").append(
                options.structure.map((colStructure) => {
                    return $("<option selected></option>").text(colStructure.header.displayName).attr("value", colStructure.queryIndex)
                })
            ).on("change", (e) => { colselector_change(e, this, options) })
        )
    )

    //Results per page

    //Table
    this.append(
        $(`<table></table>`).append(
            [
                $("<thead></thead>"),
                $("<tbody></tbody>")
            ]
        ).addClass(options.tableClass)
    )

    printHeaders(this, options);

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
            printTable(root, options);
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
function printTable(root, options) {
    let tbody = root.find("tbody").eq(0);

    orderResults(root, options);

    //Reset table rows
    tbody.html("");

    //Display the data
    options.currentData.forEach(rowData => {
        let tr = $("<tr></tr>");

        //Generate td's based on the options
        options.structure.forEach(colStructure => {
            if (!options.showCols || options.showCols.includes(colStructure.queryIndex)) {
                tr.append(
                    $("<td></td>").append(
                        generateInputForField(colStructure.queryIndex, colStructure.col.type, rowData[colStructure.queryIndex])
                    ).addClass(colStructure.class)
                )
            }
        });

        //Link to entity info page
        tr.append(
            $("<td></td>").append(
                $("<div></div>").append(
                    $("<a></a>").attr("href", options.infoBaseUrl + rowData["id"]).append(
                        $('<i class="fas fa-external-link-alt"></i>')
                    ).addClass("btn btn-primary"),
                    $("<button></button>").append(
                        $('<i class="fas fa-trash"></i>')
                    ).addClass("btn btn-danger").on("click", () => {
                        deleteRow(rowData["id"], root, options);
                    }).addClass("ms-2")
                ).addClass("d-flex justify-content-center")
            )
        )

        tbody.append(tr);
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

function generateInputForField(queryIndex, type, value) {
    // Este case estaba para la crear inputs para las tablas, pero como solo se va a poder editar desde las fichas, no hace falta de momento.
    switch (type) {
        // case "text":
        //     return $("<input>").attr("type", "text").val(value);
        case "checkbox":
            // return $(`<input ${value ? "checked" : ""}>`).attr("type", "checkbox");
            return value ? "Si" : "No";
        default:
            return String(value);
    }
}

function generatePaginationNumericButton(text, page, root, options, isActive = false, isDisabled = false) {
    return $(`<li class="page-item ${isActive ? "active" : ""}"></li>`).append($("<button></button>").addClass("page-link").text(text).attr("data-page", page)).prop("disabled", isDisabled).on("click", (e) => numericPagination_click(e, options, root));
}

function header_click(e, options, root) {
    let th = $(e.target);

    //Determine the index to order by and order direction
    if (options.orderBy == th.attr("data-order-index")) {
        options.orderAsc = !options.orderAsc;

        th.attr("data-current-order", options.orderAsc ? "asc" : "desc");
    } else {
        options.orderBy = th.attr("data-order-index");
        options.orderAsc = false;

        $("[data-current-order]").eq(0).removeAttr("data-current-order");
        th.attr("data-current-order", options.orderAsc ? "asc" : "desc");
    }

    printTable(root, options);
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
            printTable(root, options);
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