$("#mainTableWrapper").AjaxTable(
    {
        baseUrl: "index.php/bar/jsonAll/",
        countUrl: "index.php/bar/total/",
        deleteUrl: "index.php/bar/delete/",
        infoBaseUrl: "index.php/bar/edit/",
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
                queryIndex: "address",
                header: {
                    displayName: "Dirección",
                },
                col: {
                    type: "text"
                },
            },
            {
                queryIndex: "lon",
                header: {
                    displayName: "Lon.",
                },
                col: {
                    type: "number"
                },
                class: "text-center"
            },
            {
                queryIndex: "lat",
                header: {
                    displayName: "Lat.",
                },
                col: {
                    type: "number"
                },
                class: "text-center"
            },
            {
                queryIndex: "terrace",
                header: {
                    displayName: "Terraza",
                },
                col: {
                    type: "checkbox"
                },
                class: "text-center"
            },
            {
                queryIndex: "rating",
                header: {
                    displayName: "Puntuación",
                },
                col: {
                    type: "number"
                },
                class: "text-center"
            }
        ],
        tableClass: "table"
    }
);