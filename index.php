<?php

require('include/functions.php');

if ($gb->isAuthorized()) {
    if ($_GET['mode'] == 'logout') {
        $gb->logout();
        header('Location: index.php');
    } else {
        header('Location: comments.php');
    }  
} else {       
    if (isset($_POST['login']) && isset($_POST['password'])) {
        //header('Refresh: 3; url=' . $_SERVER['SCRIPT_NAME']);
        // на странице авторизации
        if ($gb->tryAuth($_POST['login'], $_POST['password'])) {
            $gb->login($_POST['login'], $_POST['password']);
            header('Location: comments.php');
        } else {
            $needAlert = true;
            $needForm = true;
            $alert = ['type' => 'danger', 'text' => 'Authorization failed'];
        }
    } else {  
        $needForm = true;
    }
    require_once("template/auth.php");
}