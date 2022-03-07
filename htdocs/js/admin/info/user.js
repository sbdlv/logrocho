$("#save_btn").on("click", () => {
    if (!checkFields()) {
        return;
    }

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


function checkFields() {
    if ($("#user_first_name").val() === "") {
        alert("El campo nombre es obligatorio");
        return false;
    }

    if ($("#user_last_name").val() === "") {
        alert("El campo apellidos es obligatorio");
        return false;
    }

    if ($("#user_email").val() === "") {
        alert("El campo email es obligatorio");
        return false;
    }

    if ($("#user_created_date").val() === "") {
        alert("El campo fecha de alta es obligatorio");
        return false;
    }

    if ($("#user_first_name").val().length > 255) {
        alert("El nombre del usuario no puede superar los 255 caracteres");
        return false;
    }

    if ($("#user_last_name").val().length > 255) {
        alert("Los apellidos del usuario no puede superar los 255 caracteres");
        return false;
    }

    if ($("#user_email").val().length > 255) {
        alert("El email del usuario no puede superar los 255 caracteres");
        return false;
    }

    return true
}