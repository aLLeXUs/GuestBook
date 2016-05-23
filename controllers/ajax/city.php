<?php

class Controller_City Extends Controller_Base {

    function index() {
        
        include_once($site_dir . DIRSEP . 'models' . DIRSEP . 'ajax.php');
        $ajaxModel = new Model_Ajax($this->registry);
            
        if (!empty($_GET['country'])) {
            $result = $ajaxModel->getRegions($_GET['country']);
        } elseif (!empty($_GET['region'])) {
            $result = $ajaxModel->getCities($_GET['region']);
        } else {
            $result = 'Error';
        }
        
        echo json_encode($result);
    }

}

?>