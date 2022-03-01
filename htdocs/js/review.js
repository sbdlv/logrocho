let title = $("#review_title");
let desc = $("#review_desc");
let pincho_id = $("#review_pincho_id");

let texture = $("#review_texture");
let presentation = $("#review_presentation");
let taste = $("#review_taste");

let texture_preview = $("#review_texture_preview");
let presentation_preview = $("#review_presentation_preview");
let taste_preview = $("#review_taste_preview");

linkRangeWithPreview(texture, texture_preview);
linkRangeWithPreview(presentation, presentation_preview);
linkRangeWithPreview(taste, taste_preview);

function linkRangeWithPreview(range, previewElem) {
    range.on("input", () => {
        previewElem.text(range.val());
    })
}

function publish() {
    let data = {
        pincho_id: pincho_id.val(),
        title: title.val(),
        desc: desc.val(),
        taste: taste.val(),
        presentation: presentation.val(),
        texture: texture.val()
    }

    $.ajax({
        type: "POST",
        url: "index.php/review/publish",
        data: data,
        success: function (response) {
            alert("Se ha publicado la reseña correctamente");
            document.getElementById("close_review_modal").click();
        },
        error: function (res) {
            alert("Error: No se ha podido publicar la reseña.");
        }
    });
}


function like(reviewId) {
    vote(true, reviewId);
}

function dislike(reviewId) {
    vote(false, reviewId);
}

function vote(isLike, reviewId) {
    $.ajax({
        type: "POST",
        url: "index.php/user/voteReview",
        data: {
            isLike: isLike ? 1 : 0,
            review_id: reviewId
        },
        success: function (response) {
            alert("Se ha votado la reseña correctamente")
        },
        error: function (res) {
            alert(res);
        }
    });
}