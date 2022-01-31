const URL_BASE = "http://logrocho.local";

let actualPage = 1;
let tableObj = {};

$.ajax({
    type: "GET",
    url: URL_BASE + "/index.php/bar/jsonAll/1",
    dataType: "json",
    success: function (response) {

        let tableRows = [];

        response.forEach(bar => {
            tableRows.push(
                $("<tr></tr>").append(
                    $("<td></td>").append($("<input type='text'/>").val(bar.name)).attr("data-propName", "name"),
                    $("<td></td>").append($("<input type='text'/>").val(bar.address)).attr("data-propName", "address"),
                    $("<td></td>").append($("<input type='text'/>").val(bar.lon)).addClass("text-center").attr("data-propName", "lon"),
                    $("<td></td>").append($("<input type='text'/>").val(bar.lat)).addClass("text-center").attr("data-propName", "lat"),
                    $("<td></td>").append($(`<input type='checkbox' ${bar.terrace ? "checked" : ""}/>`)).addClass("text-center").attr("data-propName", "terrace"),
                    $("<td></td>").append(
                        $("<button>Borrar</button>").on("click", deleteRow).addClass("btn btn-danger"),
                        $("<a>Ver ficha</a>").attr("href", "#").addClass("btn btn-primary")
                    ),
                ).attr("data-id", bar.id)
            );
        });

        let table = $("<table></table>").append(
            $("<thead></thead>").append(
                $("<tr></tr>").append(
                    $("<th></th>").text("Nombre").attr("data-propName", "name"),
                    $("<th></th>").text("Dirección").attr("data-propName", "address"),
                    $("<th></th>").text("Lon.").addClass("text-center").attr("data-propName", "lon"),
                    $("<th></th>").text("Lat.").addClass("text-center").attr("data-propName", "lat"),
                    $("<th></th>").text("Tiene terraza").addClass("text-center").attr("data-propName", "terrace"),
                    $("<th></th>").text("Acciones").addClass("text-center"),
                ),
            ).addClass("table-light"),
            $("<tbody id='tableBody'></tbody>").append(
                tableRows,
            )
        ).addClass("table customize-table mb-0 v-middle table-borderless");

        $("#mainTableWrapper").append(table);

        tableObj.root = table;
        tableObj.process = processPage;

        tableObj.root.find("input").on("change", updateRow);

        AutoTables(tableObj);
    }
});


function next() {
    actualPage++;
    updateBtnPage();

    processPage();

}

function prev() {
    if (actualPage != 1) {
        actualPage--;
        updateBtnPage();
    }

    processPage();
}

function page(event) {
    actualPage = parseInt($(event.target).attr("data-page"));
    updateBtnPage();
    processPage();

    console.log(tableObj);
}

function updateBtnPage() {
    $(".btn-page").each((i, elem) => {
        $(elem).attr("data-page", i + actualPage);
        $(elem).text(i + actualPage);
    });
}

function processPage() {
    let url;

    if (tableObj.orderBy != null) {
        url = URL_BASE + `/index.php/bar/jsonAll/${actualPage}/${tableObj.orderBy}/${tableObj.desc ? "DESC" : "ASC"}`;
    } else {
        url = URL_BASE + "/index.php/bar/jsonAll/" + actualPage;
    }

    $.ajax({
        type: "GET",
        url: url,
        dataType: "json",
        success: function (response) {

            let tableRows = [];

            if (response.length == 0) {
                tableRows = $("<p>No hay resultados para esta página</p>");
            }

            response.forEach(bar => {
                tableRows.push(
                    $("<tr></tr>").append(
                        $("<td></td>").append($("<input type='text'/>").val(bar.name)).attr("data-propName", "name"),
                        $("<td></td>").append($("<input type='text'/>").val(bar.address)).attr("data-propName", "address"),
                        $("<td></td>").append($("<input type='number'/>").val(bar.lon)).addClass("text-center").attr("data-propName", "lon"),
                        $("<td></td>").append($("<input type='number'/>").val(bar.lat)).addClass("text-center").attr("data-propName", "lat"),
                        $("<td></td>").append($(`<input type='checkbox' ${bar.terrace ? "checked" : ""}/>`)).addClass("text-center").attr("data-propName", "terrace"),
                        $("<td></td>").append(
                            $("<button>Borrar</button>").on("click", deleteRow).addClass("btn btn-danger"),
                            $("<a>Ver ficha</a>").attr("href", "#").addClass("btn btn-primary")
                        ),
                    ).attr("data-id", bar.id)
                );
            });

            $("#tableBody").html("").append(tableRows);

            hideShowFields();
        }
    });

}


function updateRow(e) {
    let target = $(e.currentTarget);

    let tr = target.parent().parent();
    let barId = target.parent().parent().attr("data-id");

    let bar = {
        id: barId
    };

    tr.find("td").each((i, elem) => {
        let propName = $(elem).attr("data-propname");
        if (propName != null) {
            let input = $(elem).children().eq(0);
            let val;

            switch (input.attr("type")) {
                case "checkbox":
                    val = input.val() == "on";
                    break;
                default:
                    val = input.val();
                    break;
            }

            bar[propName] = val;
        }
    })

    $.ajax({
        type: "POST",
        url: URL_BASE + "/index.php/bar/update",
        data: bar,
        success: function (response) {
            
        }
    });
}   



function deleteRow(e){
    let target = $(e.currentTarget);

    let tr = target.parent().parent();
    let barId = target.parent().parent().attr("data-id");

    $.ajax({
        type: "POST",
        url: URL_BASE + "/index.php/bar/delete",
        data: {
            id: barId
        },
        success: function (response) {
            alert("Fila eliminada");
        },
        error: ()=>{
            alert("Error: No se ha borrado la fila");
        }
    });
}