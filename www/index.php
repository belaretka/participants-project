<?php

    use App\controller\ParticipantController;

    require_once __DIR__.'/vendor/autoload.php';

    $controller = new ParticipantController();
    $controller->handleRequest();

