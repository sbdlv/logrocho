<?php

class TemplateHelper
{
    static function getStarts(int $score)
    {
        for ($i = 0; $i < $score; $i++) : ?>
            <i class="fas fa-star"></i>
        <?php endfor;
        
        for ($i = 5 - $score; $i > 0; $i--) : ?>
            <i class="fas fa-star off"></i>
        <?php endfor;
    }
}
