<a class="tarjeta tarjeta-btn card review p-4 flex-row no-hyperlink" href="<?=get_server_index_base_url()?>pincho/<?=$review->pincho_id?>#review_<?=$review->id?>">
    <div class="me-4"><img src="img/pfp.jpg" alt="" class="pfp"></div>
    <div>
        <p class="h4"><?= $review->title ?></p>
        <p class="text_clamp_3 review-text"><?= $review->desc ?></p>
        <div class="card-subtitle mb-2"><span class="fw-bold">Sabor: <?php TemplateHelper::getStarts($review->taste) ?></div>
        <div class="card-subtitle mb-2"><span class="fw-bold">Presentación: <?php TemplateHelper::getStarts($review->presentation) ?></div>
        <div class="card-subtitle mb-2"><span class="fw-bold">Textura: <?php TemplateHelper::getStarts($review->texture) ?></div>
    </div>
</a>