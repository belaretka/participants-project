<?php

    use App\controller\BaseController;

    require_once __DIR__.'/vendor/autoload.php';

    $controller = new BaseController();
    $controller->handleRequest();

