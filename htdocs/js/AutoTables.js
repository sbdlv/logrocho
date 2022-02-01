let allFields;

window.onload = ()=>{
    allFields = $("#fields>option").map(function () { return $(this).val(); }).toArray();
}

let lastTargetCol;

let currentPage = 1;

let globalTable;

function AutoTables(table) {
    let root = $(table.root);
    globalTable = table;

    root.find("th").on("click", (e) => {
        let target = $(e.target);

        if (table.orderBy == target.attr("data-propname")) {
            table.desc = !table.desc;
            target.addClass(table.desc ? "orderDesc" : "orderAsc");
            target.removeClass(table.desc ? "orderAsc" : "orderDesc");
        } else {
            table.orderBy = target.attr("data-propname");
            table.desc = true;
            target.addClass("orderDesc");

            if(lastTargetCol != null){
                lastTargetCol.removeClass("orderAsc");
                lastTargetCol.removeClass("orderDesc");
            }
        }

        lastTargetCol = target;

        hideShowFields();
        table.process();
    });
}

$("#fields").on("change", (e) => {
    hideShowFields();
})

function hideShowFields(target = $("#fields")){
    let selector = $(target).val().map(i => `[data-propname="${i}"]`).join(", ");


    let hideThisFields = allFields.filter(x => !$(target).val().includes(x)).map(i => `[data-propname="${i}"]`);
    let selectorFieldsToHide = hideThisFields.join(", ");

    if(lastTargetCol != null && !$(target).val().map(i => i).includes(lastTargetCol.attr("data-propname"))){
        globalTable.orderBy = null;
    }

    $(selector).css("display", "table-cell")
    $(selectorFieldsToHide).css("display", "none");
}