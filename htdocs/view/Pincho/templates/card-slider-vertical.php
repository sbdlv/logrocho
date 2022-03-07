<a class="tarjeta tarjeta-btn pincho-card-slider-vertical row mx-auto mb-4 no-hyperlink flex-column" href="index.php/pincho/<?=$pincho->id?>">
    <div class="col-12 imgWrapper"></div>
    <div class="col-12 p-4 d-flex flex-column">
        <h3 class="mb-1"><?=$pincho->name?></h3>
        <div class="mb-2"><?php TemplateHelper::getStarts($pincho->rating) ?></div>
        <div class="text_clamp_3 flex-grow-1"><?=$pincho->desc?></div>
    </div>
</a>