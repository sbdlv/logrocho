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

function header_click(e, options, root) {
    let th = $(e.target);

    if (options.orderBy == th.attr("data-order-index")) {
        options.orderAsc = !options.orderAsc;
    } else {
        options.orderBy = th.attr("data-order-index");
        options.orderAsc = false;
    }

    printTableAndPaginator(root, options);
}