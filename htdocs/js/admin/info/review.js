$("#save_btn").on("click", () => {
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