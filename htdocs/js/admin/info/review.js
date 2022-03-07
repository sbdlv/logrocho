$("#save_btn").on("click", () => {
    if (!checkFields()) {
        return;
    }
    let data = {
        id: $("#review_id").val(),
        user_id: $("#review_user_id").val(),
        pincho_id: $("#review_pincho_id").val(),
        title: $("#review_title").val(),
        desc: $("#review_desc").val(),
        taste: $("#review_taste").val(),
        presentation: $("#review_presentation").val(),
        texture: $("#review_texture").val(),
    }

    $.ajax({
        type: "POST",
        url: "index.php/review/update",
        data: data,
        success: function (response) {
            alert("¡Se han guardados los datos correctamente!");
        },
        error: function (response) {
            alert("Error: No se han podido guardar los cambios");
        },
    });
})


$("#open_pincho").on("click", () => {
    window.location.href = `index.php/pincho/edit/${$("#review_pincho_id").val()}`;
})


function checkFields() {
    if ($("#review_title").val() === "") {
        alert("El campo titulo es obligatorio");
        return false;
    }

    if ($("#review_desc").val() === "") {
        alert("El campo descripción es obligatorio");
        return false;
    }

    if ($("#review_taste").val() === "") {
        alert("El campo sabor es obligatorio");
        return false;
    }

    if ($("#review_texture").val() === "") {
        alert("El campo textura es obligatorio");
        return false;
    }

    if ($("#review_presentation").val() === "") {
        alert("El campo presentación es obligatorio");
        return false;
    }

    if (parseInt($("#review_taste").val()) > 5 || parseInt($("#review_taste").val()) < 0) {
        alert("El campo sabor solo admite valores entre 0 y 5 incluidos");
        return false;
    }

    if (parseInt($("#review_texture").val()) > 5 || parseInt($("#review_texture").val()) < 0) {
        alert("El campo textura solo admite valores entre 0 y 5 incluidos");
        return false;
    }

    if (parseInt($("#review_presentation").val()) > 5 || parseInt($("#review_presentation").val()) < 0) {
        alert("El campo presentación solo admite valores entre 0 y 5 incluidos");
        return false;
    }

    return true
}