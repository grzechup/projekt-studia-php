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


    public function getUserIdFromSessionEmail() : String{

        $conn = $this->database->connect();
        $stmt2 =$conn-> prepare('SELECT id from user where email = :email');

        $stmt2->bindParam(':email', $_SESSION['id']);
        $stmt2->execute();


        $row = $stmt2->fetch(PDO::FETCH_ASSOC);

        $userId = $row['id'];

        return $userId;

    }

    public function getFiles()
    {

        try {
            $conn = $this->database->connect();
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM file WHERE id_user = :id_user;");

            $userId = $this->getUserIdFromSessionEmail();
            $stmt->bindParam(':id_user', $userId, PDO::PARAM_STR);
            $stmt->execute();

            while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                ?>
                <td>Nazwa: <?php echo $row['filename']; ?></td>
                <td>Waga: <?php echo $row['filesize']; ?></td>
                </br>
                </tr>

                <?php
            }


        } catch (PDOException $e) {
            throw new PDOException($e);
        }
    }

    public function deleteFile(int $id)
    {
        try {
            $stmt = $this->database->connect()->prepare('DELETE FROM file WHERE id_file=:id;');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

        } catch (PDOException $e) {
            die();
        }
    }
}