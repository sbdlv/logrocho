<?php

/**
 * General purpose class to help with repetitive HTML code generation. 
 */
class TemplateHelper
{
    /**
     * Generates the stars for a given rating and prints it.
     *
     * @param integer $rating The rating to represent.
     */
    static function getStarts(int $rating)
    {
        for ($i = 0; $i < $rating; $i++) : ?>
            <i class="fas fa-star"></i>
        <?php endfor;
        
        for ($i = 5 - $rating; $i > 0; $i--) : ?>
            <i class="fas fa-star off"></i>
        <?php endfor;
    }
}
