<?php

/**
 * Manage operations in the database for entities.
 * 
 * @author Sergio Barrio <sergiobarriodelavega@gmail.com>
 */
class AllergenRepository
{
    /**
     * Obtains all the allergens from the database.
     *
     * @return PDOStatement The fetched allergens.
     */
    function findAll()
    {
        return get_db_connection()->query("SELECT * FROM allergen")->fetchAll();
    }
}