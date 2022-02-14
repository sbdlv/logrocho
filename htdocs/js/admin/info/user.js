$("#save_btn").on("click", () => {
    let data = {
        id: $("#user_id").val(),
        first_name: $("#user_first_name").val(),
        last_name: $("#user_last_name").val(),
        email: $("#user_email").val(),
        created_date: $("#user_created_date").val(),
    }

    $.ajax({
        type: "POST",
        url: "index.php/user/update",
        data: data,
        success: function (response) {
            alert("¡Se han guardados los datos correctamente!");
        },
        error: function (response) {
            alert("Error: No se han podido guardar los cambios");
        },
    });
})