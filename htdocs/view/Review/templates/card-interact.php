<div class="tarjeta card review p-4 flex-row no-hyperlink" id="review_<?= $review->id ?>">
    <div class="me-4"><img src="img/pfp.jpg" alt="" class="pfp"></div>
    <div class="w-100">
        <p class="h4"><?= $review->title ?></p>
        <p class="text_clamp_3 review-text"><?= $review->desc ?></p>
        <div class="card-subtitle mb-2"><span class="fw-bold">Sabor: <?php TemplateHelper::getStarts($review->taste) ?></div>
        <div class="card-subtitle mb-2"><span class="fw-bold">Presentación: <?php TemplateHelper::getStarts($review->presentation) ?></div>
        <div class="card-subtitle mb-2"><span class="fw-bold">Textura: <?php TemplateHelper::getStarts($review->texture) ?></div>
        <div class="d-flex justify-content-end">
            <button class="likes btn">
                <i class="fas fa-thumbs-up text-success"></i>
                <?=$review->likes?>
            </button>
            <button class="dislikes btn">
                <i class="fas fa-thumbs-down text-danger"></i>
                <?=$review->dislikes?>
            </button>
        </div>
    </div>
</div>