<?php

require_once APPLICATION_PATH . '/../core/Autoloader.php';
require_once APPLICATION_PATH . '/../core/Model.php';
require_once APPLICATION_PATH . '/../core/View.php';
require_once APPLICATION_PATH . '/../core/Controller.php';
require_once APPLICATION_PATH . '/../core/Route.php';

spl_autoload_extensions('.php');
spl_autoload_register('\core\Autoloader::load');

session_start();

\core\Route::execute();
