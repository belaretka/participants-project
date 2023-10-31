<?php

use App\config\Config;
use App\controller\BaseController;

require_once __DIR__ . '/vendor/autoload.php';

Config::load();
$controller = new BaseController();
$controller->handleRequest();

