<?php


class Admin_Controller {
    private $adminList_Model;

    private $admin_Model;
    private $editionMode = false;


    public function __construct() {
        $this->adminList_Model = new AdminList_Model();
    }

    public function actionsController() {
        if( isset($_POST['action']) && isset($_POST['admin_id']) ) {

            if($_POST['action'] == "delete") {

                if( $_POST['admin_id'] != 1 ) {
                    Admin_Model::deleteById($_POST['admin_id']);

                    iziToast_Model::printNotification('success', 'Username deleted');
                } else {
                    iziToast_Model::printNotification('error', 'You can not delete this SuperAdmin User');
                }
            }

            elseif ($_POST['action'] == 'edit') {
                $this->admin_Model = Admin_Model::getByID($_POST['admin_id']);

                if( $this->admin_Model != null) {
                    $this->editionMode = true;
                    $_SESSION['edit_admin_id'] = $_POST['admin_id'];
                }
            }
        }
    }

    public function controlForm() {
        if (isset($_POST['form'])) {
            if ($_POST['form'] == 'create') {

                if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirmPassword'])) {      // Verification of POST
                    if (isset($_POST['CSRF_token']) && $_SESSION['CSRF_token'] == $_POST['CSRF_token'])  {       // Verification of CRSF Token
                        $username = htmlentities($_POST['username']);
                        $password = htmlentities($_POST['password']);
                        $confirmPassword = htmlentities($_POST['confirmPassword']);

                        if (!Admin_Model::verifyAvailabilityUsername($username)) {
                            iziToast_Model::printNotification('warning', 'Username already used ! Please choose another');
                            return;
                        }

                        if ($password == $confirmPassword) {
                            $hash = password_hash($password, PASSWORD_DEFAULT);

                            if (Admin_Model::createAdmin($username, $hash)) {
                                iziToast_Model::printNotification('success', 'New admin created !');
                            } else {
                                iziToast_Model::printNotification('error', 'Error during creation ! Please retry');
                            }

                        } else {
                            iziToast_Model::printNotification('warning', 'The 2 passwords do not match !');
                        }

                    } else {
                        iziToast_Model::printNotification('error', 'Error of token ! Please retry');
                    }
                } else {
                    iziToast_Model::printNotification('warning', 'Missing data ! Please retry');
                }

            } elseif($_POST['form'] == 'edit') {
                if ($_POST['username'] != '') {
                    $username = htmlentities($_POST['username']);

                    if (!Admin_Model::verifyAvailabilityUsername($username)) {
                        iziToast_Model::printNotification('warning', 'Username already used ! Please choose another');
                        return;
                    }

                    if ( Admin_Model::editUsername($_SESSION['edit_admin_id'], $username) ) {
                        iziToast_Model::printNotification('success', 'Username edited !');
                    } else {
                        iziToast_Model::printNotification('error', 'Error during edition ! Please retry');
                    }
                }

                if (isset($_POST['password']) AND isset($_POST['confirmPassword'])) {
                    $password = htmlentities($_POST['password']);
                    $confirmPassword = htmlentities($_POST['confirmPassword']);

                    if ($password == $confirmPassword) {
                        $hash = password_hash($password, PASSWORD_DEFAULT);

                        if ( Admin_Model::editPassword($_SESSION['edit_admin_id'], $hash) ) {
                            // TODO msg
                        }

                    } else {
                        // TODO password not match
                    }
                }
                unset($_SESSION['edit_admin_id']);
            }
        }
    }

    public function printAllAdmin() {
        $this->adminList_Model->loadAllAdmin();
        $adminList = $this->adminList_Model->getAdminList();

        if ($adminList != null) {
            try {
                $CSRF_token = bin2hex(random_bytes(32));
                $_SESSION['CSRF_token'] = $CSRF_token;
            } catch (Exception $e) {
                // TODO : Add action
            }

            require_once(dirname(__DIR__) . '/view/admin/admin-view.php');
        } else {
            echo "Aucun admin !";
        }
    }
}