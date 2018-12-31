<?php

require_once 'User.php';
require_once __DIR__ . '/../Database.php';

class UserMapper extends Exception
{
    private $database;
    private $servername;
    private $username;
    private $password;

    public function __construct()
    {
        $this->database = new Database();

    }

    public function getUser(string $email): User
    {
        try {
            $conn = $this->database->connect();
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            return new User($user['name'], $user['email'], $user['password']);

        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
    }


    public function registerUser(string $email, string $name, string $password)
    {

        try {
            $conn = $this->database->connect();
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare('INSERT INTO users (name, email, password, role) 
                                                        VALUES(:name, :email, :password, :role)');

            $user_role = 'user';

            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->bindParam(':role',$user_role , PDO::PARAM_STR);

            $stmt->execute();

            $user = new User($name, $email, $password);


            return $user;


        } catch (PDOException $e) {
            throw new PDOException($e);

        }

    }


}