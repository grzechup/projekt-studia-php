<?php

require_once 'User.php';
require_once 'File.php';
require_once __DIR__ . '/../Database.php';

class UserMapper extends Exception
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();

    }

    public function getUser(string $email): User
    {
        try {
            $conn = $this->database->connect();
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM user WHERE email = :email");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            return new User($user['name'], $user['email'], $user['password']);

        } catch (PDOException $e) {
            throw new PDOException($e);
        }
    }

    public function registerUser(string $name, string $email, string $password)
    {

        try {
            $conn = $this->database->connect();
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare('INSERT INTO user (name, email, password, role) 
                                                        VALUES(:name, :email, :password, :role)');

            $user_role = 'user';

            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->bindParam(':role', $user_role, PDO::PARAM_STR);

            $stmt->execute();

            $user = new User($name, $email, $password);

            return $user;


        } catch (PDOException $e) {
            throw new PDOException($e);

        }
    }

    public function getFiles(String $email)
    {

        try {
            $conn = $this->database->connect();
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM files WHERE email!= :email;");
            $stmt->bindParam(':email', $_SESSION['id'], PDO::PARAM_STR);

            $stmt->execute();


            $file = new File();

            $file = $stmt->fetch(PDO::FETCH_ASSOC);

            return $file;

        } catch (PDOException $e) {
            throw new PDOException($e);
        }

    }

    public function deleteFile(int $id)
    {

        try {
            $stmt = $this->database->connect()->prepare('DELETE FROM files WHERE id=:id;');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

        } catch (PDOException $e) {
            die();
        }
    }


}