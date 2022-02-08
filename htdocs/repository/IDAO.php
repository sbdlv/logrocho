<?php

/**
 * @author Sergio Barrio <sergiobarriodelavega@gmail.com>
 */
interface IDAO
{
    /**
     * Searches the entity by id from the DB
     *
     * @param mixed $id The entity's ID
     * @return mixed The entity
     */
    public function find($id);

    /**
     * Gets all the data from the table.
     *
     * @return array All the results
     */
    public function findAll();

    /**
     * Saves/inserts the entity into the DB
     *
     * @param mixed $obj The entity
     * @return bool True if all went ok, false if not
     */
    public function save($obj);

    /**
     * Updates an entity fields
     *
     * @param mixed $obj The entity data
     * @return bool True if all went ok, false if not
     */
    public function update($obj);

    /**
     * Deletes an entity by ID
     *
     * @param mixed $id The entity's ID
     * @return bool True if all went ok, false if not
     */
    public function delete($id);
}
