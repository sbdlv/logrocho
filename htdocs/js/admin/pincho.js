$("#mainTableWrapper").AjaxTable(
    {
        baseUrl: "index.php/pincho/jsonAll/",
        countUrl: "index.php/pincho/total/",
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
                    displayName: "Bar",
                },
                col: {
                    type: "text"
                }
            },
        ],
        tableClass: "table"
    }
);