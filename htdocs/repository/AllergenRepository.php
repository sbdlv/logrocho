<?php

/**
 * @author Sergio Barrio <sergiobarriodelavega@gmail.com>
 */
class AllergenRepository
{
    function findAll()
    {
        return getConexion()->query("SELECT * FROM allergen")->fetchAll();
    }
}