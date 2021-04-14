<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Service;

use App\Library\FileUpload;

/**
 * Description of FileUploadService
 *
 * @author TSassen
 */
class FileUploadService {

    static function upload_file($name = 'file', $path = null) {/// Dit bijvoorkeur uit je .env halen!
        $path = $path ?? \getenv('FILE_UPLOAD_PATH');

        $file_id = \uniqid();
        $uploader = new FileUpload($name);
        $uploader->newFileName = $file_id . "-" . strtolower(str_replace(" ", "-", $uploader->getFileName()));
        $result = $uploader->handleUpload(__DIR__."/../../$path");

        /// Voor afbeeldingen
        // list($w, $h) = getimagesize($path . $uploader->newFileName);

        if (!$result) {
            return [false,$uploader->getErrorMsg()];
        }
        return [true,$uploader->newFileName];
    }

}
