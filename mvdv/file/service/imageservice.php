<?php

namespace MVDV\File\Service;

class ImageService extends FileService {

    /**
     *
     * @var int width of resizedpicture 
     */
    private static $resizedwidth = 50;

    /**
     *
     * @var int height of resizedpicture
     */
    private static $resizedheight = 50;
    /**
     * validates uploaded images
     * @param array $images images uploaded by a form
     * @return array $errors array containing errors of file validation
     */
    public static function validateImages($images) {
        self::$allowedfileextensions = array("jpg", "jpeg", "png", "gif");
        self::validateFiles($images);
        //check if files are really images
        foreach (self::$files as $file) {
            if (!getimagesize($file['tmp_name'])) {
                self::$errors[$file['name']][] = "filenotanimage";
            }
        }
        return self::getErrors();
    }

    /**
     * saves images to the server and database
     * @return array $errors : array containing error messages
     */
    public static function saveImages() {
        foreach (self::$files as $key => &$file) {
            $file = self::saveFile($key, $file);
            if ($file) {
                self::ak_img_resize($_SERVER['DOCUMENT_ROOT'] . $file->getBasefilepath() . "/" . $file->getBasefilename(), $_SERVER['DOCUMENT_ROOT'] . str_replace("originals", "resized", $file->getBasefilepath()) . "/" . $file->getBasefilename(), self::$resizedwidth, self::$resizedheight, strtolower(pathinfo($file->getBasefilename(), PATHINFO_EXTENSION)));
            }
        }
        if (!empty(self::getErrors())) {
            return self::getErrors();
        }
        return self::$files;
    }

    /**
     * updates images on the server and in database
     * @param array $files : uploaded files
     * @param type $contentid : ???
     * @param type $resizedwidth : width to resize image to for showing on pages 
     * @param type $resizedheight : height to resize image to for showing on pages
     * @return array $errors : array containing error messages
     */
    public static function updateImage($files, $contentid, $resizedwidth = 700, $resizedheight = 700) {
        //oude file unlinken
        $oudefoto = \MVDV\File\DAO\ImageDAO::getByContentId($contentid);
        $arrKeys = array_keys($oudefoto);
        unlink($oudefoto[$arrKeys[0]]->getPath());
        //  unlink($oudefoto[$arrKeys[0]]->getResizedPath());
//nieuwe file saven    
        $errors = array();
        $filekeys = array_keys($files);
        foreach ($filekeys as $fileKey) {
            $timestamp = time('now');
            $target_dir = "uploads/" . $fileKey . "/originals/" . $timestamp . "/";
            if (!is_dir($target_dir)) {
                mkdir($target_dir, "0666", true);
            }
            $resized_dir = "uploads/" . $fileKey . "/resized/" . $timestamp . "/";
            if (!is_dir($resized_dir)) {
                mkdir($resized_dir, "0666", true);
            }
            for ($i = 0; $i < count($files[$fileKey]['name']); $i++) {
                $target_time = time("now");
                $nameWithoutExtension = str_replace($imageFileType, "", $files[$fileKey]['name'][$i]);
                $cleanName = self::clean($nameWithoutExtension) . "." . $imageFileType;
                $name = $i . $target_time . $cleanName;
                $target_file = $target_dir . $name;
                $target_resized_file = $resized_dir . $name;
                $type = $files[$fileKey]["type"][$i];
                $size = $files[$fileKey]["size"][$i];
                $tmpFile = $files[$fileKey]["tmp_name"][$i];
                if (move_uploaded_file($tmpFile, $target_file)) {
                    self::ak_img_resize($_SERVER['DOCUMENT_ROOT'] . $target_file, $_SERVER['DOCUMENT_ROOT'] . $target_resized_file, $resizedwidth, $resizedheight, strtolower(pathinfo(self::$files[$fileKey]['name'][$i], PATHINFO_EXTENSION)));
//rij updaten 
                    $test = \MVDV\File\DAO\ImageDAO::update($oudefoto[$arrKeys[0]]->getId(), $name, $type, $target_file, $size, $contentid, $target_resized_file);
                    echo "<pre>";
                    var_dump($test);
                    echo "</pre>";
                    echo __LINE__ . "<br>" . __FILE__ . "<br>";
//$arrIds[$fileKey][]=\MVDV\File\DAO\ImageDAO::insert($name, $type, $target_file, $size, $contentid,$target_resized_file);
                } else {
                    $errors[$fileKey]["uploaderror"] = "File could not be uploaded please try again later";
                }
            }
        }
        return $errors;
    }

    /**
     * resizes images
     * @param string $target target file name of resize
     * @param string $newcopy outputted file after resize
     * @param int $width width
     * @param int $height height
     * @param string $ext : image extension
     */
    private static function ak_img_resize($target, $newcopy, $width, $height, $ext) {
        list($width_orig, $height_orig) = getimagesize($target);
        $scale_ratio = $width_orig / $height_orig;
        if (($width / $height) > $scale_ratio) {
            $width = $height * $scale_ratio;
        } else {
            $height = $width / $scale_ratio;
        }
        $img = "";
        $ext = strtolower($ext);
        if ($ext == "gif") {
            $img = imagecreatefromgif($target);
        } else if ($ext == "png") {
            $img = imagecreatefrompng($target);
        } else {
            $img = imagecreatefromjpeg($target);
        }
        $tci = imagecreatetruecolor($width, $height);
        // imagecopyresampled(dst_img, src_img, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h)
        imagecopyresampled($tci, $img, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
        imagejpeg($tci, $newcopy, 80);
    }

    public static function getImageByContentId($id) {
        return \MVDV\File\DAO\ImageDAO::getByContentId($id);
    }

}
