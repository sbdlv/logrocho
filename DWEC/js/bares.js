$.ajax({
    type: "GET",
    url: "http://logrocho.local/index.php/bar/jsonAll/1",
    dataType: "json",
    success: function (response) {

        let tableRows = [];

        response.forEach(bar => {
            tableRows.push(
                $("<tr></tr>").append(
                    $("<td></td>").text(bar.name).attr("data-propName", "name"),
                    $("<td></td>").text(bar.address).attr("data-propName", "address"),
                    $("<td></td>").text(bar.lon).addClass("text-center").attr("data-propName", "lon"),
                    $("<td></td>").text(bar.lat).addClass("text-center").attr("data-propName", "lat"),
                    $("<td></td>").text(bar.terrace ? "Si" : "No").addClass("text-center").attr("data-propName", "terrace"),
                    $("<td></td>").text("Herramientas"),
                )
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
            $("<tbody></tbody>").append(
                tableRows,
            )
        ).addClass("table customize-table mb-0 v-middle table-borderless");

        $("#mainTableWrapper").append(table);

        AutoTables({
            root: table
        });
    }
});
