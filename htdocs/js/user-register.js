$("#user_email").on("change", (e) => {
    let input = $(e.target);
    checkEmail(input);
})

$("#user_password").on("change", (e) => {
    let input = $(e.target);
    checkPass(input);
})

$("#submit").on("click", (e) => {
    if (!checkEmail($("#user_email"))) {
        e.preventDefault();
        return;
    }

    if (!checkPass($("#user_password"))) {
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

function checkPass(root) {
    let val = root.val();

    if (val.length < 9) {
        alert("La contraseña debe de tener al menos 8 caracteres");
        return false;
    }

    if (!/[a-z]/.test(val)) {
        alert("La contraseña debe de tener al menos una minúscula");
        return false;
    }

    if (!/[A-Z]/.test(val)) {
        alert("La contraseña debe de tener al menos una mayúscula");
        return false;
    }

    if (!/[0-9]/.test(val)) {
        alert("La contraseña debe de tener al menos un número");
        return false;
    }

    return true;
}