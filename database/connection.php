<?php

include(__DIR__ . '/../utils/helper.php');

class Connection
{   
    private $connection;
    private $dbname;
    private $host;
    private $username;
    private $password;
    
    public function __construct ()
    {
        $this->dbname = 'ilham_db_spp';
        $this->host = 'localhost';
        $this->username = 'root';
        $this->password = '';

        $this->connect(); 
    }

    private function connect()
    {
        try {
            $this->connection = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    public function getConnection()
    {
        return $this->connection;
    }
}
