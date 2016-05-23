<?php

abstract class Controller_Base {
    protected $db;
    protected $user;

    function __construct() {
        global $db;
        global $user;
        $this->db = $db;
        $this->user = &$user; 
        
        session_start(); 
                  
        include_once(site_path . DIRSEP . 'models' . DIRSEP . 'users.php');
        $usersModel = new Model_Users();
        $usersModel->tryAuth($_SESSION['login'], $_SESSION['password']);
    }
    
    abstract function index();
}

?>