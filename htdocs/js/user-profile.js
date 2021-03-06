function checkOnlyText(e) {

}

function saveProfile() {
    let userData = {
        first_name: $("#user_first_name").val(),
        last_name: $("#user_last_name").val(),
        email: $("#user_email").val(),
    }

    $.ajax({
        type: "POST",
        url: "index.php/user/update_profile",
        data: userData,
        success: function (response) {
            alert("¡Se ha actualizado el perfil correctamente!");
        },
        error: function (res) {
            alert("Error: " + res.responseText);
        }
    });
}

function removeVote(review_id, event) {
    $.ajax({
        type: "GET",
        url: "index.php/user/removeVote/" + review_id,
        success: function (response) {
            let reviewWrapper = $(event.target).closest(".review-card-detailed").eq(0);

            reviewWrapper.addClass("disappear");
            setTimeout(() => {
                reviewWrapper.remove();
            }, 380);
        },
        error: function (res) {
            alert("Lo sentimos, no se ha podido eliminar tu voto.");
        }
    });
}

function deleteReview(review_id, event) {
    $.ajax({
        type: "GET",
        url: "index.php/user/deleteMyReview/" + review_id,
        success: function (response) {
            let reviewWrapper = $(event.target).closest(".review-card-detailed").eq(0);

            reviewWrapper.addClass("disappear");
            setTimeout(() => {
                reviewWrapper.remove();
            }, 380);
        },
        error: (res) => {
            alert("Error: No se ha podido eliminar tu reseña.");
        }
    });

}