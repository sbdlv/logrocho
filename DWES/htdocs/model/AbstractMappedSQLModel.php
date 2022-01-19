<?php

/**
 * Makes easier to convert SQL fetch data into instance of an class by just calling the getInstance() method.
 */
abstract class AbstractMappedSQLModel{

    /**
     * Gets the object properties relations with the SQL result fields
     *
     * @return array
     */
    abstract static function getPropertiesMapArray(): array;

    /**
     * 
     *
     * @param mixed $data
     * @return mixed The instance created from the data
     */
    static function getInstance($fetchData){
        $class = get_called_class();
        
        $instance = new $class;

        $mappedProperties = $class::getPropertiesMapArray();
        
        foreach ($mappedProperties as $objProperty => $sqlFieldName) {
            $instance->$objProperty = $fetchData[$sqlFieldName];
        }

        return $instance;
    }
}