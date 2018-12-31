<?php

require_once "AppController.php";

require_once __DIR__ . '/../model/User.php';
require_once __DIR__ . '/../model/UserMapper.php';


class DefaultController extends AppController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $text = 'Hello there 👋';

        $this->render('index', ['text' => $text]);
    }

    public function setSession(User $user)
    {

        $_SESSION["id"] = $user->getEmail();
        $_SESSION["role"] = $user->getRole();

        $url = "http://$_SERVER[HTTP_HOST]/";
        header("Location: {$url}?page=index");
        exit();

    }

    public function register()
    {
        $mapper = new UserMapper();
        $user = null;

        if ($this->isPost()) {

            try {

                $user = $mapper->registerUser($_POST['name'], $_POST['email'], $_POST['password']);

                if (!$user) {
                    $this->render('register', ['message' => ['Something went wrong.']]);
                } else {
                    $this->setSession($user);
                }
//TODO tutaj jak zrobic zeby zlapac wyjatek rzucony przez PDO i zlapac np. to ze jest
// duplikat rekordow i wtedy wysunac stosowny komunikat a nie sciane tekstu
            } catch (PDOException $e) {
                $message = $e->getCode();
                error_log($message);
                $this->render('register', ['message' => ["$message"]]);
            }
        } else {
            $this->render('register');
        }
    }

    public function login()
    {
        $mapper = new UserMapper();

        $user = null;

        if ($this->isPost()) {

            try {
                $user = $mapper->getUser($_POST['email']);

                if (!$user) {
                    return $this->render('login', ['message' => ['Email not recognized']]);
                }

                if ($user->getPassword() !== $_POST['password']) {
                    return $this->render('login', ['message' => ['Wrong password']]);
                } else {
                    $this->setSession($user);
                }
            } catch (PDOException $e) {
                error_log($e->getMessage());
            }
        }

        $this->render('login');
    }

    public function logout()
    {
        session_unset();
        session_destroy();

        $this->render('login', ['message' => ['You have been successfully logged out!']]);
    }
}