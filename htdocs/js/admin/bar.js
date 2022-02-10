$("#mainTableWrapper").AjaxTable(
    {
        baseUrl: "index.php/bar/jsonAll/",
        countUrl: "index.php/bar/total/",
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
                queryIndex: "address",
                header: {
                    displayName: "Dirección",
                },
                col: {
                    type: "text"
                }
            },
            {
                queryIndex: "lon",
                header: {
                    displayName: "Lon.",
                },
                col: {
                    type: "number"
                }
            },
            {
                queryIndex: "lat",
                header: {
                    displayName: "Lat.",
                },
                col: {
                    type: "number"
                }
            },
            {
                queryIndex: "terrace",
                header: {
                    displayName: "Terraza",
                },
                col: {
                    type: "checkbox"
                }
            }
        ],
        tableClass: "table"
    }
);