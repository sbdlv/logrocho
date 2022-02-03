<?php
global $breadcrumbs;
$lastBreadcrumb = end($breadcrumbs);
?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) :
            if ($breadcrumb == $lastBreadcrumb) : ?>
                <li class="breadcrumb-item active"><?= $breadcrumb["text"] ?></li>
            <?php else : ?>
                <li class="breadcrumb-item"><a href="<?= $breadcrumb["url"] ?>"><?= $breadcrumb["text"] ?></a></li>
        <?php endif;
        endforeach; ?>
    </ol>
</nav>