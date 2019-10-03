<?php

ini_set('display_errors', 1);

defined('APPLICATION_PATH') ||
        define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

echo APPLICATION_PATH;
