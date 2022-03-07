let barID = parseInt($("#bar_id").val());
let barimgs = $(".barimgs");

let pendingUploadImages = [];

$.ajax({
    type: "GET",
    url: "index.php/bar/images/" + barID,
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
    let bar = {
        id: $("#bar_id").val(),
        name: $("#bar_name").val(),
        desc: $("#bar_desc").val(),
        address: $("#bar_address").val(),
        terrace: $("#bar_terrace").val(),
        lon: $("#bar_lon").val(),
        lat: $("#bar_lat").val(),
        images: ImgDropAreaGetVal($("#bar_images")),
    }

    //First upload new images then process all
    Object.values(pendingUploadImages).forEach((file) => {
        let fd = new FormData();
        fd.append("pic", file);
        fd.append("name", file.name);
        fd.append("pk", barID);

        $.when($.ajax({
            type: "POST",
            url: "index.php/bar/uploadPic",
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

function checkFields() {
    if ($("#bar_name").val() === "") {
        alert("El campo nombre es obligatorio");
        return false;
    }

    if ($("#bar_desc").val() === "") {
        alert("El campo descripción es obligatorio");
        return false;
    }

    if ($("#bar_address").val() === "") {
        alert("El campo dirección es obligatorio");
        return false;
    }
    
    if ($("#bar_lon").val() === "") {
        alert("El campo longitud es obligatorio");
        return false;
    }

    if ($("#bar_lat").val() === "") {
        alert("El campo latitud es obligatorio");
        return false;
    }

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

    if ($("#bar_lon").val().split(".").length > 1) {
        if ($("#bar_lon").val().split(".")[1].length > 5) {
            alert("La precisión máxima para las coordenadas de la longitud es de 5 decimales");
            return false;
        }
    }

    if ($("#bar_lat").val().split(".").length > 1) {
        if ($("#bar_lat").val().split(".")[1].length > 5) {
            alert("La precisión máxima para las coordenadas de la latitud es de 5 decimales");
            return false;
        }
    }

    return true
}