$("#save_btn").on("click", () => {
    let bar = {
        name: $("#bar_name").val(),
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