<?php

/**
 * Makes easier to convert SQL fetch data into instance of an class by just calling the getInstance() method.
 * @author Sergio Barrio <sergiobarriodelavega@gmail.com>
 */
abstract class AbstractMappedSQLModel{

    /**
     * Gets the object properties relations with the SQL result fields
     *
     * @return array Key = Object property - Value = SQL Column name
     */
    abstract static function getPropertiesMapArray(): array;

    /**
     * Gets a new instance from the fetch data.
     *
     * @param mixed $data
     * @return mixed The instance created from the data
     */
    static function getInstance($fetchData, $images = false){

        if($fetchData instanceof stdClass){
            $fetchData = json_decode(json_encode($fetchData), true);
        }

        $class = get_called_class();
        
        $instance = new $class;

        $mappedProperties = $class::getPropertiesMapArray();
        
        foreach ($mappedProperties as $objProperty => $sqlFieldName) {
            $instance->$objProperty = $fetchData[$sqlFieldName];
        }

        return $instance;
    }
}