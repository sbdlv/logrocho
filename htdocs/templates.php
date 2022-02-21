<?php

class TemplateHelper
{
    static function getStarts(int $score)
    {
        for ($i = 0; $i < $score; $i++) : ?>
            <i class="fas fa-star"></i>
        <?php endfor;
    }
}
