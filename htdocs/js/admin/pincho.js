$("#mainTableWrapper").AjaxTable(
    {
        baseUrl: "index.php/pincho/jsonAll/",
        countUrl: "index.php/pincho/total/",
        deleteUrl: "index.php/pincho/delete/",
        infoBaseUrl: "index.php/pincho/info/",
        resultsPerPage: 4,
        structure: [
            {
                queryIndex: "name",
                header: {
                    displayName: "Nombre",
                },
                col: {
                    type: "text"
                }
            },
            {
                queryIndex: "bar_id",
                header: {
                    displayName: "Bar ID",
                },
                col: {
                    type: "text"
                },
                class: "text-center"                
            },
        ],
        tableClass: "table"
    }
);