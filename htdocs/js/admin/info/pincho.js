$("#save_btn").on("click", () => {
    let data = {
        id: $("#pincho_id").val(),
        name: $("#pincho_name").val(),
        desc: $("#pincho_desc").val(),
        bar_id: $("#pincho_bar_id").val(),
        price: $("#pincho_price").val(),
        allergens: $("#pincho_allergens").val(),
        images: ImgDropAreaGetVal($("#pincho_images")),
    }

    $.ajax({
        type: "POST",
        url: "index.php/pincho/update",
        data: data,
        success: function (response) {
            alert("¡Se han guardados los datos correctamente!");
        },
        error: function (response) {
            alert("Error: No se han podido guardar los cambios");
        },
    });
})