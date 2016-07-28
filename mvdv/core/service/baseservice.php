<?php

namespace MVDV\Core\Service;

class BaseService {

    /**
     *
     * @var array associative array where key is errorname
     */
    protected static $errors = array();

    protected static function getErrors() {
        //return self::$errors;
        return array_filter(self::$errors);
    }

}
