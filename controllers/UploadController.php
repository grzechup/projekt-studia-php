<?php

require_once "AppController.php";
require_once __DIR__ . '/../Database.php';

class UploadController extends AppController
{
    const MAX_FILE_SIZE = 1024 * 1024 * 2014;
    //const SUPPORTED_TYPES = ['video/mp4', 'video/mov', ];

    private $message = [];


    private $database;

    public function __construct()
    {
        $this->database = new Database();
        parent::__construct();
    }

    public function upload()
    {


        /*if ($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file']))*/
        if ($this->isPost() && $_FILES['file']['size'] > 0) {

            $targetDir = "D:\\Dokumenty\\STUDIA\\PAI\\projekt\\public\\upload\\";
            $targetFilePath = $targetDir . $_FILES['file']['name'];

            $fileName = ($_POST['name']);
            $fileTmp = $_FILES['file']['tmp_name'];
            $fileDescription = $_POST['description'];
            $fileSize = $_FILES['file']['size'];



            move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath);

                try {

                    $userName =  $_SESSION['id'];

                    echo $userName;


                    $conn = $this->database->connect();

                    $stmt2 =$conn-> prepare('SELECT id from user where email = :email');
                    $stmt2->bindParam(':email', $userName);

                    $stmt2->execute();


                    $row = $stmt2->fetch(PDO::FETCH_ASSOC);

                    $userId = $row['id'];
                    echo $userId;




                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $stmt = $conn->prepare('INSERT INTO file (filename,  filesize, file_format,content, file_description, id_user)
                                              values (:fileName, :filesize, :fileformat, :content, :description, :id_user  )');

                    $stmt->bindParam(':fileName', $fileName );
                    $stmt->bindParam(':filesize', $fileSize);
                    $stmt->bindParam(':fileformat', $fileFormat);
                     $stmt->bindParam(':content', $fileName);
                    $stmt->bindParam(':description', $fileDescription);
                    $stmt->bindParam(':id_user', $userId);

                    $stmt->execute();

                    $file_id = $conn->lastInsertId();

                    echo $file_id;









                    $stmt3 = $conn -> prepare ('INSERT INTO files_user (id_user, id_file) 
                                                values (:id_user,:id_file)');

                    $stmt3->bindParam(':id_user', $userId);
                    $stmt3->bindParam(':id_file', $file_id);

                    $stmt3->execute();


                    $this->message[] = 'File uploaded';
                } catch (PDOException $e) {
                    $message = $e->getCode();
                    error_log($message);
                    $this->message[] = '' . $message;
                }


        }

        $this->render('upload', ['message' => $this->message]);
    }

    private function validate(array $file): bool
    {
        if ($file['size'] > self::MAX_FILE_SIZE) {
            $this->message[] = 'File is too large for destination file system.';
            return false;
        }

        /*        if (!isset($file['type']) || !in_array($file['type'], self::SUPPORTED_TYPES)) {
                    $this->message[] = 'File type is not supported.';
                    return false;
                }*/

        return true;
    }
}