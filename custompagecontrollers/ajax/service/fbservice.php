<?php

namespace CustomPageControllers\Ajax\Service;

/**
 * Description of fbservice
 *
 * @author mark
 */
class FBService {

    /**
     * saves the received facebook data if it doesnt exist in the database, if the information received is different, it gets updated
     * @param string $email : emailaddress associated with the facebook account
     * @param int $fbid : facebookid of the user
     * @param string $fbname : name of the user as shown on facebook
     * @param string $fbimageurl : remote path to userimage of the user on facebook
     * @param string $thirdpartyid : thirdpartyid (just in case)
     * @return boolean : not really a boolean but this returns either the number of rows affected (which should be one) or false
     */
    public static function saveData($email, $fbid, $fbname, $fbimageurl, $thirdpartyid) {
        $fbdata = \CustomPageControllers\Ajax\DAO\FBDAO::getByEmail($email);
        if (!$fbdata) {
            return \CustomPageControllers\Ajax\DAO\FBDAO::insert($email, $fbid, $fbname, $fbimageurl, $thirdpartyid);
        }
        return false;
    }

    public static function saveImage($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $contents = curl_exec($ch);
        if (curl_errno($ch)) {
            echo curl_error($ch);
            echo "\n<br />";
            $contents = '';
        } else {
            curl_close($ch);
        }


        $imageinfo = getimagesizefromstring($contents);
        if ($imageinfo) { //check if the url points to an actual image
            //Get filextension
            $extension = reset(explode("?", pathinfo($url, PATHINFO_EXTENSION)));
            if ($extension === "jpg") {
                $extension = "jpeg";
            }
            $functionname = "imagecreatefrom" . $extension;
            $resource = imagecreatefromstring($contents);
            $functionname = "image" . $extension;

            //save file to file system
            $targetdir = "/res/uploads/fb"; //destination for the image
            $targetfilename = time('now') . "." . reset(explode("?", pathinfo($url, PATHINFO_EXTENSION))); //destination for the image
            if (!is_dir($_SERVER["DOCUMENT_ROOT"] . $targetdir)) {
                echo "amking dir";
                mkdir($_SERVER["DOCUMENT_ROOT"] . $targetdir);
            }
            if ($functionname($resource, $_SERVER["DOCUMENT_ROOT"] . $targetdir . "/" . $targetfilename, 100)) {//if file gets saved to filesystem, save file to dbsystem
                $lastinsertid = \MVDV\File\DAO\FileDAO::insert($imageinfo['mime'], $targetfilename, $targetdir, $imageinfo['bits']);
                return \MVDV\File\DAO\FileDAO::getById($lastinsertid);
            }
        }
        return false;
    }

}
