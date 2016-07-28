<?php
namespace MVDV\Core\Security\Service;

/**
 * Description of iploggerservice
 *
 * @author mark
 */
class IpLoggerService {
    public static function logIp($ipaddress) {
        $ipaddress=$_SERVER['REMOTE_ADDR'];
        //check if IP has already been logged
        $loggedip=\MVDV\Core\Security\DAO\IpLoggerDAO::getByIp($ipaddress);
        if(!$loggedip){
            //update correspondng row
            \MVDV\Core\Security\DAO\IpLoggerDAO::create($ipaddress);
        }
        else{
            //Create new row
            \MVDV\Core\Security\DAO\IpLoggerDAO::update($ipaddress);
        }
    }
    /*
     * checks whether the ip has been logged toomany times
     */
    public static function checkIpAccess($ipaddress,$maxlogged=5) {
       return \MVDV\Core\Security\DAO\IpLoggerDAO::getByIpAndMaxlimit($ipaddress, $maxlogged);
    }
}
