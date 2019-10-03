<?php

require_once APPLICATION_PATH . '/../core/Autoloader.php';
require_once APPLICATION_PATH . '/../core/Route.php';

spl_autoload_extensions('.php');
spl_autoload_register('\core\Autoloader::load');

\core\Route::execute();
