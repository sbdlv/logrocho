<div class="tarjeta tarjeta-btn card review p-4 flex-row">
    <div class="me-4"><img src="img/pfp.jpg" alt="" class="pfp"></div>
    <div class="w-100">
        <p class="h4"><?= $review->title ?></p>
        <p class="text_clamp_3 review-text"><?= $review->desc ?></p>
        <div class="card-subtitle mb-2"><span class="fw-bold">Presentación: </span><?php TemplateHelper::getStarts($review->presentation) ?></div>
        <div class="card-subtitle mb-2"><span class="fw-bold">Sabor: </span><?php TemplateHelper::getStarts($review->taste) ?></div>
        <div class="card-subtitle mb-2"><span class="fw-bold">Textura: </span><?php TemplateHelper::getStarts($review->texture) ?></div>
        <div class="d-flex justify-content-between">
            <div class="rating d-flex">
                <div class="likes">
                    <i class="fas fa-thumbs-up"></i>
                    <?= $review->likes ?>
                </div>
                <div class="ms-2 dislikes">
                    <i class="fas fa-thumbs-down"></i>
                    <?= $review->dislikes ?>
                </div>
            </div>
            <a class="btn btn-primary" href="<?= getServerAbsPathForActions() ?>pincho/detalles/<?= $review->pincho_id ?>">Ver pincho</a>
        </div>
    </div>
</div>