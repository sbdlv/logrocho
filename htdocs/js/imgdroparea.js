/**
 * @author sbdlv
 */

/**
 * Initialice an img ordenable/draggable zone
 * @param {object} data The initialization data
 * @param {Array} imagesSrc The images src
 * @param {} data The initialization data
 * @param {} data The initialization data
 * @param {function} data.onAdd The initialization data
 * @returns 
 */
$.fn.ImgDropArea = function (data = {
    imagesSrc: [],
    additionalClass: "",
    onChange: () => { },
    onAdd: () => { },
    onDelete: () => { },
}) {
    //Remove any inner HTML
    this.html("");

    this.data("data", data);

    let imagesWrapper = $("<div></div>").addClass("images");
    imagesWrapper.data("data", data);

    //Append images etc
    data.imagesSrc.forEach((src, i) => {
        imagesWrapper.append(
            getImgAndDrop(src, i, data.additionalClass)
        )
    });

    //Append the add button
    this.append(
        $('<button onclick="uploadPic()">Subir imagen</button>').on("click", data.onAdd).addClass("btn btn-primary"),
        $('<p><i>Arrastra las imagenes para organizarlas.</i></p>').addClass("my-4"),
        imagesWrapper,
    );

    return this;
}

$.fn.ImgDropAreaAdd = function (imageSrc, filename) {
    let lastElemToAppend = this.find(".images").eq(0);

    let additionalClass = this.data("data").additionalClass;

    let lastPos = this.find("img").length - 1;

    lastElemToAppend.append(getImgAndDrop(imageSrc, ++lastPos, additionalClass, filename))

    return this;
}


function ImgDropAreaGetVal(root) {
    //Generate data and send to onchange function
    let finalImageStructure = [];
    root.find(".draggableImg ").each((i, elem) => {
        finalImageStructure.push($(elem).attr("src"));
    })

    return finalImageStructure;
}

/**
 * 
 * @param {string} imageSrc The image src
 * @param {int} pos The position of the image 
 * @param {string} additionalClass Additional class for the img element
 * @returns {JQuery} The img JQuery element
 */
function getImgAndDrop(imageSrc, pos, additionalClass = "", filename = "") {
    return $("<div></div>").addClass("img-draggable-wrapper").append(
        newDropZone(true).add(
            $("<img/>").attr("src", imageSrc).addClass("draggableImg").addClass(additionalClass).attr("data-img-pos", pos).on("dragstart", imgOnDragStart).on("dragend", imgOnDragEnd).add(
                newDropZone(false).add(
                    $('<button class="btn btn-danger"><i class="fas fa-times"></i></button>').on("click", deleteImage)
                )
            ).attr("data-file-name", filename)
        )
    )
}

/**
 * Generate a new drop zone
 * @param {boolean} isFront Where the drop zone goes (in front of the img tag or in the back) 
 * @returns {JQuery} The drop zone JQuery element
 */
function newDropZone(isFront = true) {
    return $("<div></div>").addClass("drop").attr("data-drop-type", isFront ? "f" : "b").on("drop", dropOnDrop).on("dragover", dropOnDragover).on("dragleave", dropOnDragleave);
}

function imgOnDragEnd(e) {
    $(e.target).removeClass("drag");
}

function imgOnDragStart(e) {
    e.originalEvent.dataTransfer.setData("ogTarget", $(e.target).attr("data-img-pos"));
    $(e.target).addClass("drag");
}

function dropOnDrop(e) {
    e.preventDefault();

    //Get DOM necessary elements 
    let dropTarget = $(e.target);
    let dropIsFront = dropTarget.attr("data-drop-type") == "f";

    let dropRelatedImg = dropIsFront ? dropTarget.next("img") : dropTarget.prev("img");
    let dropRelatedImgPos = dropRelatedImg.attr("data-img-pos");

    let ogImgTargetPos = e.originalEvent.dataTransfer.getData("ogTarget");
    let ogImgTarget = $(`[data-img-pos="${ogImgTargetPos}"]`);

    let parent = dropTarget.parent().parent();
    let data = parent.data("data");

    //Move DOM
    dropRelatedImg.insertAfter(ogImgTarget);

    dropIsFront ? ogImgTarget.insertAfter(dropTarget) : ogImgTarget.insertBefore(dropTarget);

    //Set metadata
    ogImgTarget.attr("data-img-pos", dropRelatedImgPos);
    dropRelatedImg.attr("data-img-pos", ogImgTargetPos);

    //Generate data and send to onchange function
    let finalImageStructure = [];
    parent.find("img").each((i, elem) => {
        finalImageStructure.push($(elem).attr("src"));
    })

    data.onChange(finalImageStructure);

    //Class for styling
    $(e.target).removeClass("draghover");
}

function dropOnDragover(e) {
    if (e.originalEvent.dataTransfer.getData("ogTarget")) {
        e.preventDefault();
        $(e.target).addClass("draghover");
    }
}

function dropOnDragleave(e) {
    $(e.target).removeClass("draghover");
}

function deleteImage(e) {
    let deleteButton = $(e.target);
    let filename = deleteButton.siblings().eq(1).attr("data-file-name");

    let data = deleteButton.closest(".imgdroparea").data().data;

    if (filename != null && filename != "") {
        data.onDelete(filename);
    }

    deleteButton.closest(".img-draggable-wrapper").remove();

    $("[data-img-pos]").each((i, elem) => {
        console.log(elem);
        $(elem).attr("data-img-pos", i);
    })

}