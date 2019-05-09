<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 28/03/2019
 * Time: 09:02
 */

if (session_status() == PHP_SESSION_NONE) { session_start(); }

spl_autoload_register(function($className) {
    $dir = strtolower(substr(strrchr($className, '_'), 1));
    require_once dirname(dirname(__DIR__)) . '/src/' . $dir . "/" . $className . '.php';
});

class NewTeam_Controller {
    public function controlForm() {
        if (isset($_POST['name']) AND isset($_FILES['logo'])) {
            // Verification of POST
            if (isset($_POST['CSRF_token']) AND $_SESSION['CSRF_token'] == $_POST['CSRF_token']) {
                // Verification of CRSF Token

                $name = htmlentities($_POST['name']);

                if(!Team_Model::verifyAvailabilityName($name)) {
                    // TODO Add error message
                    exit();
                }

                $randomFileName = md5(uniqid(rand(), true));
                $fileExtension = strtolower(pathinfo($_FILES['logo']['name'],PATHINFO_EXTENSION));

                $width = 200;
                $height = 200;

                list($width_orig, $height_orig) = getimagesize( $_FILES['logo']['tmp_name'] );

                $ratio_orig = $width_orig/$height_orig;

                if ($width/$height > $ratio_orig) {
                    $width = $height*$ratio_orig;
                } else {
                    $height = $width/$ratio_orig;
                }

                $image_p = imagecreatetruecolor($width, $height);
                $image = imagecreatefrompng($_FILES['logo']['tmp_name']);
                imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

                $partialDest = '/upload/' . $randomFileName . '.' . $fileExtension;
                $dest = dirname(dirname(__DIR__)) . $partialDest;

                if( move_uploaded_file($_FILES['logo']['tmp_name'], $dest) ) {
                    Team_Model::addNewTeam($name, $partialDest);
                }

            } else {
                // TODO Add error message
            }

        } else {
            // TODO Add error message
        }
    }
}