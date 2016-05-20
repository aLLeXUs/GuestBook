<?php

require('include/functions.php');


    
    
// -----------------------------------------------------------------------


if ($gb->isAuthorized()) {

    if (isset($_POST['subject']) && isset($_POST['text'])) {
        if ($gb->comments->add($gb->user['id'], $_POST['subject'], $_POST['text'])) {
            $needAlert = true;
            $alert = ['type' => 'success', 'text' => 'Comment posted'];
        } else {
            $needAlert = true;
            $alert = ['type' => 'danger', 'text' => 'Comment not posted<br>Error: ' . lastError()];
        }
    }
    
    $showComments = true;
    $comments = $gb->comments->getAll(); 

    
} else {
    $needAlert = true;
    $alert = ['type' => 'danger', 'text' => 'You have not permission to view this page'];
}

require_once("template/comments.php");

