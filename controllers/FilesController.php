<?php
/**
 * Created by PhpStorm.
 * User: Grzegorz
 * Date: 05.01.2019
 * Time: 16:41
 */

class FilesController extends AppController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index() : void
    {
        $user = new UserMapper();
        $this->render('index.php', ['user' => $user->getUser($_SESSION['id'])]);
    }


    public function files(): void
    {
        $user = new UserMapper();
        header('Content-type: application/json');
        http_response_code(200);

        echo$user->getFiles() ? json_encode($user->getFiles()) : ' ';
    }

    public function fileDelete():void{

        if(!isset($_SESSION['id'])){
            http_response_code(404);
            return;
        }

        $user= new UserMapper();
        $user->deleteFile((int)$_POST['id']);


        http_response_code(200);
    }





    public function getFileList(){



    }





}