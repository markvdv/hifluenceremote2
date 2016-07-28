<?php

namespace MVDV\File\Service;

class FileService extends \MVDV\Core\Service\BaseService {

    protected static $uploadedfiledir = "/res/uploads/originals/";
    protected static $resizedfiledir = "/res/uploads/resized/";

    /**
     *
     * @var int max filesize in bytes, cannot be higher than upload_max_filesize
     */
    private static $maxfilesize;

    /**
     *
     * @var int max size for post requests 
     */
//    private static $maxpostsize;

    /**
     *
     * @var array the file extensions that are allowed for upload , associative array where key is file type(image, pdf, video)
     */
    protected static $allowedfileextensions = array("pdf", "txt");
    protected static $files;

    /**
     * 
     * @param int $maxfilesize maximum size for an uploaded file
     */
//    public function setMaxPostSize($maxpostsize) {
//        if (ini_get('post_max_size') < $maxpostsize) {
//            self::$maxpostsize = $maxpostsize;
//            return true;
//        }
//        return false;
//    }


    public function getFileIdByName($name) {
        \MVDV\File\DAO\FileDAO::getIdByName($name);
    }

    /**
     * 
     * @param int $maxfilesize maximum size for an uploaded file
     */
    public function setMaxFileSize($maxfilesize) {
        if (ini_get('upload_max_filesize') < $maxfilesize) {
            self::$maxfilesize = $maxfilesize;
            return true;
        }
        return false;
    }

    /**
     * hardcoded file size en resize moeten eruit
     * validates uploaded files
     * @param array $files files uploaded by a form
     * @return array self::$errors  array containing errors of file validation
     */
    public static function validateFiles($files) {
        self::$files = $files;
        //check if maxpostsize and maxuploadsize are set if not grab configuration values
        if (self::$maxfilesize == null) {
            self::$maxfilesize = ini_get('upload_max_filesize');
        }
        //file validation
        foreach (self::$files as $file) {
            self::$errors[$file['name']] = [];
            if ($file["error"] !== 0) {
                self::$errors[$file['name']][] = "erroronupload";
            }
            if (count($file['tmp_name']) == 0) {//checken of er fotos zijn geupload
                self::$errors[$file['name']][] = "nofilegiven";
            }
            $fileextension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            if (!in_array($fileextension, self::$allowedfileextensions)) {
                self::$errors[$file['name']][] = "extensionnotallowed";
            }
            if (!self::checkFileSize($file["size"])) {
                self::$errors[$file['name']][] = "exceededfilesize"; //add name of error so we can use it to search for the translated value when printing it out
            }
        }
    }

    protected static function saveFile($key, $file) {

        $target_time = time("now");
        mkdir($_SERVER['DOCUMENT_ROOT'] . self::$resizedfiledir . $key . $target_time);
        mkdir($_SERVER['DOCUMENT_ROOT'] . self::$uploadedfiledir . $key . $target_time);
        $imageFileType = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $nameWithoutExtension = str_replace($imageFileType, "", $file['name']);
        $cleanname = self::clean($nameWithoutExtension) . "." . $imageFileType;

        if (move_uploaded_file($file["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . self::$uploadedfiledir . $key . $target_time . "/" . $cleanname)) {
            $lastinsertid = \MVDV\File\DAO\FileDAO::insert($file["type"], $cleanname, self::$uploadedfiledir . $key . $target_time, $file['size']);
            return \MVDV\File\DAO\FileDAO::getById($lastinsertid);
        } else {
            self::$errors[$file['name']][] = "filenotuploaded";
            return false;
        }
    }

    /**
     * returns number of bytes of ini_values
     * @param string $val
     * @return int
     */
    static function return_bytes($val) {
        $val = trim($val);
        $last = strtolower($val[strlen($val) - 1]);
        switch ($last) {
            // The 'G' modifier is available since PHP 5.1.0
            case 'g':
                $val *= 1024;
            case 'm':
                $val *= 1024;
            case 'k':
                $val *= 1024;
        }

        return $val;
    }

    public static function checkFileSize($size) {
        if ($size > self::return_bytes(self::$maxfilesize)) {
            return false;
        }
        return true;
    }

    protected static function clean($string) {
        return preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $string)); // Removes special chars.Replaces all spaces with hyphens.
    }

    static function getAllowedfileextensions() {
        return self::$allowedfileextensions;
    }

}
