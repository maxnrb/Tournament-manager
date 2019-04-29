<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 28/03/2019
 * Time: 09:02
 */

session_start();

require(dirname(__DIR__) . '/model/Team_Model.php');


class NewTeam_Controller {
    private function printForm() {
        try {
            $CSRF_token = bin2hex(random_bytes(32));
            $_SESSION['CSRF_token'] = $CSRF_token;
        } catch (Exception $e) {
            // TODO : Add action
        }

        require_once(dirname(__DIR__) . '/view/newTeam-view.php');
    }

    public function controlForm() {
        if (isset($_POST['name']) AND isset($_FILES['logo'])) {      // Verification of POST
            if (isset($_POST['CSRF_token']) AND $_SESSION['CSRF_token'] == $_POST['CSRF_token']) {       // Verification of CRSF Token
                $name = htmlentities($_POST['name']);

                if(!Team_Model::verifyAvailabilityName($name)) {
                    $this->printForm();
                    exit();
                }

                $randomFileName = md5(uniqid(rand(), true));
                $fileExtension = strtolower(pathinfo($_FILES['logo']['name'],PATHINFO_EXTENSION));

                $width = 200;
                $height = 200;

                list($width_orig, $height_orig) = getimagesize( $_FILES['logo']['tmp_name'] );

                var_dump($width_orig);
                var_dump($height_orig);

                $ratio_orig = $width_orig/$height_orig;

                if ($width/$height > $ratio_orig) {
                    $width = $height*$ratio_orig;
                } else {
                    $height = $width/$ratio_orig;
                }

                $image_p = imagecreatetruecolor($width, $height);
                $image = imagecreatefrompng($_FILES['logo']['tmp_name']);
                imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

                var_dump($image_p);

                var_dump($_FILES['logo']['name']);
                var_dump($_FILES['logo']['tmp_name']);

                $dest = dirname(dirname(__DIR__)) . '/upload/' . $randomFileName . '.' . $fileExtension;


                if( move_uploaded_file($_FILES['logo']['tmp_name'], $dest) ) {
                    Team_Model::addNewTeam($name, $dest);
                }

            } else {
                $this->printForm(); // TODO Add error message
            }

        } else {
            $this->printForm();
        }
    }
}