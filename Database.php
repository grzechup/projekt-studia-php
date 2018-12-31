<?php

require_once 'Parameters.php';

class Database
{
    private $servername;
    private $username;
    private $password;
    private $database;


    public function __construct()
    {
        $this->servername = SERVERNAME;
        $this->username = USERNAME;
        $this->password = PASSWORD;
        $this->database = $this->username;
    }

    public function connect() :PDO
    {
        try {
            syslog(1, "Getting PDO driver");
            return new PDO("mysql:host=$this->servername;dbname=$this->database", $this->username, $this->password);

        }
        catch(PDOException $e)
        {
            error_log($e->getMessage());
        }

        return null;
    }
}

