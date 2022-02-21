<?php

/**
 * @author Sergio Barrio <sergiobarriodelavega@gmail.com>
 */
class AllergenRepository
{
    function findAll()
    {
        return get_db_connection()->query("SELECT * FROM allergen")->fetchAll();
    }
}