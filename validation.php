<?php

require_once('include/functions.php');


// если в запросе есть код подтверждения
if (strlen($_GET['code']) > 0) {
    global $user;
    $query = "UPDATE `users` SET `validation_code` = '' WHERE `validation_code` = :code";
    $result = $gb->dbConnection->query($query, array('code' => $_GET['code']));
    if ($result->rowCount() > 0) {
        $alert = ['type' => 'success', 'text' => 'Почта успешно подтверждена<br>
            <a href="comments.php">Перейти к комментариям</a>'];
    } else {
        $alert = ['type' => 'warning', 'text' => 'Почта не подтверждена. Возможно это уже было сделано ранее.<br>
            <a href="comments.php">Перейти к комментариям</a>'];
    }
} else {
    if ($gb->isAuthorized()) {
        if (!$gb->isVerified()) {
            //require_once('validation.php');
            $gb->users->sendValidationEmail($user['login']);
            $alert = ['type' => 'info', 'text' => 'Повторное письмо отправлено'];
        } else {
            $alert = ['type' => 'warning', 'text' => 'Ваша почта уже подтверждена<br>
                <a href="comments.php">Перейти к комментариям</a>'];
        }
    } else {
        $alert = ['type' => 'danger', 'text' => 'Доступ запрещен'];
    }

}

require_once("template/validation.php");

