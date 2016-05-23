<?php

abstract class Model_Base {
    protected $db;
    protected $user;

    function __construct() {
        global $db;
        global $user;
        $this->db = $db;
        $this->user = &$user;
    }
}

?>