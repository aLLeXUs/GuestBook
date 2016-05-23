<?php

require_once('core/constants.php');
require_once('core/functions.php');
require_once('core/controller_base.php');
require_once('core/model_base.php');
require_once('core/db.php');

$db = db::GetInstance();
$db -> openConnection();

$error = '';

# Загружаем router
require_once('core/router.php');
$router = new Router();
$router->setPath (site_path . 'controllers');
$router->delegate();