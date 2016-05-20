<?php

require_once('db.class.php');
$dbConnection = db::GetInstance();
$dbConnection -> openConnection();

$error = ''; 

function setError($text) {
    global $error;
    $error = $text;
}

function lastError() {
    global $error;
    return $error;
}

function isError() {
    global $error;
    return strlen($error) > 0;
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

session_start();

require_once('include/gb.class.php');
$gb = new GB;
$gb->tryAuth($_SESSION['login'], $_SESSION['password']);