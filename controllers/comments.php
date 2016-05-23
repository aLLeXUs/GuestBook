<?php

class Controller_Comments Extends Controller_Base {

        function index() {
            
            
            include_once(site_path . DIRSEP . 'models' . DIRSEP . 'users.php');
            $usersModel = new Model_Users();
            $usersModel->tryAuth($_SESSION['login'], $_SESSION['password']);
            $user = $this->user;
            $isAuthorized = $usersModel->isAuthorized();
            $isVerified = $usersModel->isVerified();
            
            if ($isAuthorized) {

                include_once(site_path . DIRSEP . 'models' . DIRSEP . 'comments.php');
                $commentsModel = new Model_Comments();
                
                if (isset($_POST['subject']) && isset($_POST['text'])) {
                    if ($commentsModel->add($user['id'], $_POST['subject'], $_POST['text'])) {
                        $needAlert = true;
                        $alert = ['type' => 'success', 'text' => 'Comment posted'];
                    } else {
                        $needAlert = true;
                        $alert = ['type' => 'danger', 'text' => 'Comment not posted<br>Error: ' . lastError()];
                    }
                }
                
                $comments = $commentsModel->getAll();
                $showComments = true;
                
                
            } else {
                $needAlert = true;
                $alert = ['type' => 'danger', 'text' => 'You have not permission to view this page'];
            }
            
            
            include_once(site_path . DIRSEP . 'views' . DIRSEP . 'comments.php');
        }


}

?>