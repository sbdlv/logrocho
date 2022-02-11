$("#mainTableWrapper").AjaxTable(
    {
        baseUrl: "index.php/review/jsonAll/",
        countUrl: "index.php/review/total/",
        resultsPerPage: 4,
        structure: [
            {
                queryIndex: "title",
                header: {
                    displayName: "Título",
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
                queryIndex: "presentation",
                header: {
                    displayName: "Presentación",
                },
                col: {
                    type: "number"
                }
            },
            {
                queryIndex: "texture",
                header: {
                    displayName: "Textura",
                },
                col: {
                    type: "number"
                }
            },
            {
                queryIndex: "taste",
                header: {
                    displayName: "Sabor",
                },
                col: {
                    type: "number"
                }
            },
        ],
        tableClass: "table"
    }
);