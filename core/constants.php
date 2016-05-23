<?php

define ('DIRSEP', DIRECTORY_SEPARATOR);

$site_path = realpath(dirname(__FILE__) . DIRSEP . '..' . DIRSEP) . DIRSEP;

define ('site_path', $site_path);