<?php
namespace MVDV\Core\Error\PageNotFound\Service;
class PageNotFoundService {
    public static function log404($url,$ip) {
        $count=  \MVDV\Core\Error\PageNotFound\DAO\PageNotFoundDAO::insert($url, $ip);
        if($count===1){
            return true;
        }
        return false;
    }
    
}
