<?php


class Admin_Controller {
    private $adminList_Model;

    private $admin_Model;
    private $editionMode = false;


    public function actionsController() {
        if( isset($_POST['action']) && isset($_POST['admin_id']) ) {

            if($_POST['action'] == "delete") {
                Admin_Model::deleteById($_POST['admin_id']);
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

    public function __construct() {
        $this->adminList_Model = new AdminList_Model();
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