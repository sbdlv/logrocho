<a class="tarjeta tarjeta-btn card review p-4 flex-row no-hyperlink review-card-slider" href="<?= get_server_index_base_url() ?>pincho/<?= $review->pincho_id ?>#review_<?= $review->id ?>">
    <div class="me-4 pfp"><?php if (isset($review->user_img) && $review->user_img != null) : ?><img src="<?= $review->user_img ?>" alt=""><?php endif; ?></div>
    <div class="d-flex flex-column">
        <p class="h4"><?= $review->title ?></p>
        <p class="text_clamp_3 review-text flex-grow-1"><?= $review->desc ?></p>
        <div class="card-subtitle mb-2"><span class="fw-bold">Sabor: <?php TemplateHelper::getStarts($review->taste) ?></div>
        <div class="card-subtitle mb-2"><span class="fw-bold">Presentación: <?php TemplateHelper::getStarts($review->presentation) ?></div>
        <div class="card-subtitle mb-2"><span class="fw-bold">Textura: <?php TemplateHelper::getStarts($review->texture) ?></div>
    </div>
</a>