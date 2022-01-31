function AutoTables(table) {


    let root = $(table.root);

    root.find("th").on("click", (e) => {
        let target = $(e.target);

        if (table.orderBy == target.text()) {
            table.desc = !table.desc;
        } else {
            table.orderBy = target.text();
            table.desc = true;
        }
    });

    root.find("#autoTableTools").append("<td>Editar</td>");
}