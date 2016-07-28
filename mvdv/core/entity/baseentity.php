<?php

namespace MVDV\Core\Entity;

/**
 * the core baseentity that is the base class for every other entity in the system
 */
class BaseEntity {
    /**
     *
     * @var array an array that holds all the entities sorted by classname then id as keys e.g. $idMap[$classname][$entityid]
     */
    protected static $idMap = array();

    /**
     * 
     * @param array $result optional argument (if null an empty object the called class gets instantiated for example to keep formdata after unsuccessful submit)
     */
    function __construct($result = null) {
        $classvars = get_class_vars(get_called_class());
        unset($classvars['idMap']);
        if ($result) {
            $result = array_intersect_key(array_change_key_case($result), $classvars);
            foreach ($result as $key => $value) {
                if ($value !== null) {
                    $this->{$key} = $value;
                }
            }
        }
    }

    /**
     * returns last part of entity classname
     * @param string $fullClassName
     * @return string 
     */
    protected static function getClassName($fullClassName) {
        $classNameParts = explode('\\', $fullClassName);
        return $classNameParts[count($classNameParts) - 1];
    }

    /**
     * static function that ensures objects only get instantiated once
     * @param array $result
     * @return object of called_class()
      s */
    public static function create($result) {
        $calledclass=  get_called_class();
        $class=  self::getClassName($calledclass);
        $id = $result[strtolower($class . 'id')];
        if (!isset(self::$idMap[$calledclass][$id])) {
            self::$idMap[$calledclass][$id] = new $calledclass($result);
        }
        return self::$idMap[$calledclass][$id];
    }

    /**
     * return all entities of the called class
     * @return mixed returns either an array or false if the array isnt present
     */
    static function getIdMap() {
        $calledclass=get_called_class();
        if (isset(self::$idMap[$calledclass])) {
            return self::$idMap[$calledclass];
        } else {
            return false;
        }
    }
}
