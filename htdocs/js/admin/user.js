$("#mainTableWrapper").AjaxTable(
    {
        baseUrl: "index.php/user/jsonAll/",
        countUrl: "index.php/user/total/",
        deleteUrl: "index.php/user/delete/",
        infoBaseUrl: "index.php/user/edit/",
        resultsPerPage: 4,
        structure: [
            {
                queryIndex: "first_name",
                header: {
                    displayName: "Nombre",
                },
                col: {
                    type: "text"
                }
            },
            {
                queryIndex: "last_name",
                header: {
                    displayName: "Apellidos",
                },
                col: {
                    type: "text"
                }
            },
            {
                queryIndex: "email",
                header: {
                    displayName: "Email",
                },
                col: {
                    type: "text"
                }
            },
            {
                queryIndex: "admin",
                header: {
                    displayName: "Administrador",
                },
                col: {
                    type: "checkbox"
                },
                class: "text-center"
            },
            {
                queryIndex: "created_date",
                header: {
                    displayName: "Cuenta creada",
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