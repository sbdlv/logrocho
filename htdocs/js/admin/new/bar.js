$("#save_btn").on("click", () => {
    if (!checkFields()) {
        return;
    }
    let bar = {
        name: $("#bar_name").val(),
        desc: $("#bar_desc").val(),
        address: $("#bar_address").val(),
        terrace: $("#bar_terrace").val(),
        lon: $("#bar_lon").val(),
        lat: $("#bar_lat").val(),
    }

    $.ajax({
        type: "POST",
        url: "index.php/bar/alta",
        data: bar,
        success: function (newBarID) {
            alert("¡Se han guardados los datos correctamente!");
            window.location.href = "index.php/bar/edit/" + newBarID;
        },
        error: function (response) {
            alert("Error: No se han podido guardar los cambios");
        },
    });
})

function checkFields() {
    if ($("#bar_name").val().length > 255) {
        alert("El nombre del bar no puede superar los 255 caracteres");
        return false;
    }

    if ($("#bar_desc").val().length > 255) {
        alert("La descripción del bar no puede superar los 255 caracteres");
        return false;
    }

    if ($("#bar_address").val().length > 255) {
        alert("La dirección del bar no puede superar los 255 caracteres");
        return false;
    }

    if ($("#bar_lon").val().split(".")[1].length > 5) {
        alert("La precisión máxima para las coordenadas de la longitud es de 5 decimales");
        return false;
    }

    if ($("#bar_lat").val().split(".")[1].length > 5) {
        alert("La precisión máxima para las coordenadas de la latitud es de 5 decimales");
        return false;
    }

    return true
}