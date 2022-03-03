$("#save_btn").on("click", () => {
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