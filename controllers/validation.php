<?php

class Controller_Validation Extends Controller_Base {

        function index() {
                include_once(site_path . DIRSEP . 'models' . DIRSEP . 'users.php');
                $usersModel = new Model_Users($this->registry);
                
                // если в запросе есть код подтверждения
                if (strlen($_GET['code']) > 0) {
                        if ($usersModel->validateUser($_GET['code'])) {
                                $alert = ['type' => 'success', 'text' => 'Почта успешно подтверждена<br>
                                <a href="comments">Перейти к комментариям</a>'];
                        } else {
                                $alert = ['type' => 'warning', 'text' => 'Почта не подтверждена. Возможно это уже было сделано ранее.<br>
                                <a href="comments">Перейти к комментариям</a>'];
                        }
                } else {
                        if ($usersModel->isAuthorized()) {
                                if (!$usersModel->isVerified()) {
                                //require_once('validation.php');
                                $usersModel->sendValidationEmail($user['login']);
                                $alert = ['type' => 'info', 'text' => 'Повторное письмо отправлено'];
                                } else {
                                $alert = ['type' => 'warning', 'text' => 'Ваша почта уже подтверждена<br>
                                        <a href="comments">Перейти к комментариям</a>'];
                                }
                        } else {
                                $alert = ['type' => 'danger', 'text' => 'Доступ запрещен'];
                        }

                }
                
                
                include_once(site_path . DIRSEP . 'views' . DIRSEP . 'validation.php');
        }

}

?>