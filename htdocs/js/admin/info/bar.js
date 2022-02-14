$("#save_btn").on("click", () => {
    let bar = {
        id: $("#bar_id").val(),
        name: $("#bar_name").val(),
        address: $("#bar_address").val(),
        terrace: $("#bar_terrace").val(),
        lon: $("#bar_lon").val(),
        lat: $("#bar_lat").val(),
        images: ImgDropAreaGetVal($("#bar_images")),
    }

    $.ajax({
        type: "POST",
        url: "index.php/bar/update",
        data: bar,
        success: function (response) {
            alert("¡Se han guardados los datos correctamente!");
        },
        error: function (response) {
            alert("Error: No se han podido guardar los cambios");
        },
    });
})