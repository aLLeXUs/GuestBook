<?php

Class Controller_Index Extends Controller_Base {
    
        function index() {
            
            include_once(site_path . DIRSEP . 'models' . DIRSEP . 'users.php');
            $usersModel = new Model_Users($this->registry);
            $isAuthorized = $usersModel->isAuthorized();
            
            if ($isAuthorized) {
                if ($_GET['mode'] == 'logout') {
                    $usersModel->logout();
                    header('Location: index');
                } else {
                    header('Location: comments');
                }  
            } else {       
                if (isset($_POST['login']) && isset($_POST['password'])) {
                    //header('Refresh: 3; url=' . $_SERVER['SCRIPT_NAME']);
                    // на странице авторизации
                    if ($usersModel->tryAuth($_POST['login'], $_POST['password'])) {
                        $usersModel->login($_POST['login'], $_POST['password']);
                        header('Location: comments');
                    } else {
                        $needAlert = true;
                        $needForm = true;
                        $alert = ['type' => 'danger', 'text' => 'Authorization failed'];
                    }
                } else {  
                    $needForm = true;
                }
            include_once(site_path . DIRSEP . 'views' . DIRSEP . 'auth.php');
            }
            
        }
        
}

?>