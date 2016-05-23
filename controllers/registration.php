<?php

Class Controller_Registration Extends Controller_Base {
    
        function index() {
            
            include_once($site_dir . DIRSEP . 'models' . DIRSEP . 'users.php');
            $usersModel = new Model_Users($this->registry);
            $isAuthorized = $usersModel->isAuthorized();
            
            include_once($site_dir . DIRSEP . 'models' . DIRSEP . 'ajax.php');
            $ajaxModel = new Model_Ajax($this->registry);
            $countries = $ajaxModel->getCountries();
            
            if (isset($_POST['login'])) {
                if ($_POST['password'] == $_POST['password-confirm']) {
                    
                    // регистрируем
                    if ($usersModel->add($_POST['login'], $_POST['password'], $_POST['email'], $_POST['name'], $_POST['city'])) {
                        $usersModel->login($_POST['login'], $_POST['password']);
                        $isRegisterSuccess = true;
                    } else {
                        $isRegisterSuccess = false;
                    }
                } else {
                    setError('Passwords do not match');
                    $isRegisterSuccess = false;
                }
            }

            if ($isAuthorized) {
                
                $needAlert = true;
                $alert = ['type' => 'warning', 'text' => 'You are already registered<br>
                    <a href="comments">Go to comments</a>'];
                
            } else {   
                if (isset($_POST['login'])) {
                    if ($isRegisterSuccess) {
                        $needAlert = true;
                        $alert = ['type' => 'success', 'text' => 'Registration completed successfully<br>
                            <a href="comments">Go to comments</a>'];
                    } else {
                        $needAlert = true;
                        $needForm = true;
                        $alert = ['type' => 'danger', 'text' => 'Registration failed<br>' . lastError()];
                    }
                } else { 
                    $needForm = true;
                }
            }
            
            include_once($site_dir . DIRSEP . 'views' . DIRSEP . 'registration.php');
            
        }
        
}

?>