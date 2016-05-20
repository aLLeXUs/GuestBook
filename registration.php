<?php

require('include/functions.php');



if (isset($_POST['login'])) {
    if ($_POST['password'] == $_POST['password-confirm']) {
        
        // регистрируем
        if ($gb->users->add($_POST['login'], $_POST['password'], $_POST['email'], $_POST['name'], $_POST['city'])) {
            setAuth($_POST['login'], $_POST['password']);
            $isRegisterSuccess = true;
        } else {
            $isRegisterSuccess = false;
        }
    } else {
        setError('Passwords do not match');
        $isRegisterSuccess = false;
    }
}


// формирование страницы -------------------------------------------

if ($gb->isAuthorized()) {
    
    $needAlert = true;
    $alert = ['type' => 'warning', 'text' => 'You are already registered<br>
        <a href="comments.php">Go to comments</a>'];
    
} else {   
    if (isset($_POST['login'])) {
        if ($isRegisterSuccess) {
            $needAlert = true;
            $alert = ['type' => 'success', 'text' => 'Registration completed successfully<br>
                <a href="comments.php">Go to comments</a>'];
        } else {
            $needAlert = true;
            $needForm = true;
            $alert = ['type' => 'danger', 'text' => 'Registration failed<br>' . lastError()];
        }
    } else { 
        $needForm = true;
    }
}

require_once("template/registration.php");