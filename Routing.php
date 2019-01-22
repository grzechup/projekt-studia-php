<?php

require_once('controllers/DefaultController.php');
require_once('controllers/UploadController.php');
require_once('controllers/FilesController.php');

class Routing
{
    public $routes = [];

    public function __construct()
    {
        $this->routes = [
            'index' => [
                'controller' => 'DefaultController',
                'action' => 'index'
            ],
            'login' => [
                'controller' => 'DefaultController',
                'action' => 'login'
            ],
            'register' => [
                'controller' => 'DefaultController',
                'action' => 'register'
            ],
            'logout' => [
                'controller' => 'DefaultController',
                'action' => 'logout'
            ],
            'upload' => [
                'controller' => 'UploadController',
                'action' => 'upload'
            ],
            'player' => [
                'controller' => 'PlayerController',
                'action' => 'player'
            ],
            'files' => [
                'controller' => 'FilesController',
                'action' => 'files'
            ],
            'delete_file' => [
                'controller' => 'FilesController',
                'action' => 'fileDelete'
            ],
        ];
    }

    public function run()
    {
        $page = isset($_GET['page'])
            && isset($this->routes[$_GET['page']]) ? $_GET['page'] : 'login';

        if ($this->routes[$page]) {
            $class = $this->routes[$page]['controller'];
            $action = $this->routes[$page]['action'];

            $object = new $class;
            $object->$action();
        }
    }
}