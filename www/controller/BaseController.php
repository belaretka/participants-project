<?php

namespace App\controller;

class BaseController implements IController
{
    public function __call(string $name, array $arguments)
    {
        $this->showError( 'HTTP/1.1 404 Not Found', 'You try to call a method that doesnt exist');
    }

    public function showError($title, $message): void
    {
        include ('view/error.php');
    }

    public function getUriSegments()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = explode( '/', $uri );
        return $uri;
    }

    public function getQueryStringParams()
    {
        return parse_str($_SERVER['QUERY_STRING'], $query);
    }

    protected function redirect($location): void
    {
        header('Location: ' . $location);
    }

    public function handleRequest(): void
    {
        $resource = $_GET["resource"] ?? 'participants';

        switch ($resource){
            case 'participants':
                $controller = new ParticipantController();
                $controller->handleRequest();
                break;
            default:
                $this->showError("Wrong resource", "Page for resource '$resource' not found"); break;
        }
    }

}