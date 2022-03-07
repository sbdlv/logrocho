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


function like(event, reviewId) {
    vote(true, reviewId, event.target);
}

function dislike(event, reviewId) {
    vote(false, reviewId, event.target);
}

function vote(isLike, reviewId, target) {
    target = $(target);

    if (target.find("i").eq(0).hasClass("text-success") || target.find("i").eq(0).hasClass("text-danger")) {
        //Se le ha dado a una votación que ya teníamos hecha -> Borrar voto
        $.ajax({
            type: "GET",
            url: "index.php/user/removeVote/" + reviewId,
            success: function (res) {
                target.find("i").eq(0).removeClass(isLike ? "text-success" : "text-danger");

                let targetText = target.find(".text").eq(0);
                targetText.text(parseInt(targetText.text()) - 1);
            }
        });
    } else {
        $.ajax({
            type: "POST",
            url: "index.php/user/voteReview",
            data: {
                isLike: isLike ? 1 : 0,
                review_id: reviewId
            },
            success: function (response) {
                target.find("i").eq(0).addClass(isLike ? "text-success" : "text-danger");
                target.find(".text").eq(0).text(parseInt(target.find(".text").eq(0).text()) + 1);

                let theOtherBtn = target.siblings().eq(0);
                let theOtherBtnText = theOtherBtn.find(".text").eq(0);
                let theOtherBtnIcon = theOtherBtn.find("i").eq(0);

                if (theOtherBtnIcon.hasClass(!isLike ? "text-success" : "text-danger")) {
                    theOtherBtnIcon.removeClass(!isLike ? "text-success" : "text-danger");
                    if (theOtherBtnText.text() != "0") {
                        theOtherBtnText.text(parseInt(theOtherBtnText.text()) - 1);
                    }
                }
                
                //alert("Se ha votado la reseña correctamente")
            },
            error: function (res) {
                alert(res);
            }
        });
    }
}