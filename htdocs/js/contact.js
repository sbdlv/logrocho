$("#email").on("change", (e) => {
    checkEmail($(e.target));
})

$("#message").on("change", (e) => {
    checkMessage($(e.target));
})

$("#submit").on("click", (e) => {
    if (!checkEmail($("#email"))) {
        e.preventDefault();
        return;
    }

    if (!checkMessage($("#message"))) {
        e.preventDefault();
        return;
    }
})

function checkEmail(root) {
    if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,7})+$/.test(root.val())) {
        alert("Debes de introducir una dirección de email valida en el campo de email");
        return false;
    }
    return true;
}

function checkMessage(root) {
    if (root.val().trim() === "") {
        alert("El campo mensaje es obligatorio, y debe de tener contenido");
        return false;
    }

    return true;
}