<?php

require('include/functions.php');

if ($_GET['mode'] == 'city') {
    // выбрана страна, возвращаем регионы
    if (!empty($_GET['country'])) {
        $response = $gb->getRegions($_GET['country']);
    // выбран регион, возвращаем города
    } elseif (!empty($_GET['region'])) {
        $response = $gb->getCities($_GET['region']);
    }
}

echo json_encode($response);

?>