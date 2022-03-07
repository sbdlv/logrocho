$("#mainTableWrapper").AjaxTable(
    {
        baseUrl: "index.php/pincho/jsonAll/",
        countUrl: "index.php/pincho/total/",
        deleteUrl: "index.php/pincho/delete/",
        infoBaseUrl: "index.php/pincho/edit/",
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
                queryIndex: "desc",
                header: {
                    displayName: "Descripción",
                },
                col: {
                    type: "text"
                }
            },
            {
                queryIndex: "rating",
                header: {
                    displayName: "Puntuación",
                },
                col: {
                    type: "text"
                },
                class: "text-center"
            },
            {
                queryIndex: "price",
                header: {
                    displayName: "Precio",
                },
                col: {
                    type: "text"
                },
                class: "text-center"
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