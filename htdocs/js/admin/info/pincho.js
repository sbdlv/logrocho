let ID = parseInt($("#pincho_id").val());
let barimgs = $(".pinchoimgs");
let pendingUploadImages = [];

$.ajax({
    type: "GET",
    url: "index.php/pincho/images/" + ID,
    dataType: "json",
    success: function (imagesArray) {
        barimgs.ImgDropArea({
            imagesSrc: imagesArray,
            additionalClass: "tarjeta",
            onChange: (data) => {
                console.log(data);
            },
            onAdd: () => { },
            onDelete: (imgFileName) => {
                console.log(imgFileName);
                delete pendingUploadImages[imgFileName];
                console.log(pendingUploadImages);
            }
        })
    }
});

function uploadPic() {
    let input = document.createElement('input');
    input.type = 'file';
    input.accept = "image/png, image/jpeg";
    input.onchange = _ => {
        // you can use this method to get file and perform respective operations
        let files = Array.from(input.files);
        console.log(files);

        files.forEach(file => {
            barimgs.ImgDropAreaAdd(URL.createObjectURL(file), file.name);

            pendingUploadImages[file.name] = file;

            console.log(pendingUploadImages);
        });
    };
    input.click();
}

$("#save_btn").on("click", () => {
    if (!checkFields()) {
        return;
    }
    let data = {
        id: $("#pincho_id").val(),
        name: $("#pincho_name").val(),
        desc: $("#pincho_desc").val(),
        bar_id: $("#pincho_bar_id").val(),
        price: $("#pincho_price").val(),
        allergens: $("#pincho_allergens").val(),
        images: ImgDropAreaGetVal($("#pincho_images")),
    }

    //First upload new images then process all
    Object.values(pendingUploadImages).forEach((file) => {
        let fd = new FormData();
        fd.append("pic", file);
        fd.append("name", file.name);
        fd.append("pk", ID);

        $.when($.ajax({
            type: "POST",
            url: "index.php/pincho/uploadPic",
            data: fd,
            contentType: false,
            processData: false,
            error: (res) => {
                console.log(res);
            }
        })).then();
    });

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