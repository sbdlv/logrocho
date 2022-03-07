$("#save_btn").on("click", () => {
    if (!checkFields()) {
        return;
    }
    let data = {
        name: $("#pincho_name").val(),
        desc: $("#pincho_desc").val(),
        bar_id: $("#pincho_bar_id").val(),
        price: $("#pincho_price").val(),
        allergens: $("#pincho_allergens").val(),
    }

    $.ajax({
        type: "POST",
        url: "index.php/pincho/alta",
        data: data,
        success: function (newID) {
            alert("¡Se han guardados los datos correctamente!");
            window.location.href = "index.php/pincho/edit/" + newID;
        },
        error: function (response) {
            alert("Error: No se han podido guardar los cambios");
        },
    });
})

function checkFields() {

    if ($("#pincho_name").val() === "") {
        alert("El campo nombre es obligatorio");
        return false;
    }

    if ($("#pincho_desc").val() === "") {
        alert("El campo descripción es obligatorio");
        return false;
    }

    if ($("#pincho_price").val() === "") {
        alert("El campo precio es obligatorio");
        return false;
    }

    if ($("#pincho_name").val().length > 255) {
        alert("El nombre del pincho no puede superar los 255 caracteres");
        return false;
    }

    if ($("#pincho_desc").val().length > 255) {
        alert("La descripción del pincho no puede superar los 255 caracteres");
        return false;
    }

    if ($("#pincho_price").val().split(".")[0].length > 10) {
        alert("La parte entera para el precio no puede tener un máximo de 10 números");
        return false;
    }

    if ($("#pincho_price").val().split(".").length > 1) {
        if ($("#pincho_price").val().split(".")[1].length > 2) {
            alert("La precisión máxima para el precio es de 2 decimales");
            return false;
        }
    }

    return true
}