<?php

namespace App\controller;

interface IController
{
    public function showError($title, $message): void;
    public function getUriSegments();
    public function getQueryStringParams();
    public function handleRequest(): void;
}