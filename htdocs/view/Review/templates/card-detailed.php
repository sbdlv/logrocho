<div class="tarjeta tarjeta-btn card review p-4 flex-row">
    <div class="me-4 pfp"><?php if (isset($review->user_img) && $review->user_img != null) : ?><img src="<?= $review->user_img ?>" alt=""><?php endif; ?></div>
    <div class="w-100">
        <p class="h4"><?= $review->title ?></p>
        <p class="text_clamp_3 review-text"><?= $review->desc ?></p>
        <div class="card-subtitle mb-2"><span class="fw-bold">Presentación: </span><?php TemplateHelper::getStarts($review->presentation) ?></div>
        <div class="card-subtitle mb-2"><span class="fw-bold">Sabor: </span><?php TemplateHelper::getStarts($review->taste) ?></div>
        <div class="card-subtitle mb-2"><span class="fw-bold">Textura: </span><?php TemplateHelper::getStarts($review->texture) ?></div>
        <div class="d-flex justify-content-between align-items-center">
            <div class="rating d-flex">
                <div class="likes">
                    <i class="fas fa-thumbs-up text-success"></i>
                    <?= $review->likes ?>
                </div>
                <div class="ms-2 dislikes">
                    <i class="fas fa-thumbs-down text-danger"></i>
                    <?= $review->dislikes ?>
                </div>
            </div>
            <div>
                <a class="btn btn-primary" href="<?= get_server_index_base_url() ?>pincho/<?= $review->pincho_id ?>#review_<?= $review->id ?>">Ver pincho</a>
                <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
            </div>
        </div>
    </div>
</div>