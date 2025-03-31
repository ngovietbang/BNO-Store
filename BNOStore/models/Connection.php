<?php
class Connection
{
    private $host = "localhost";
    private $dbname = "bnostore";
    private $username = "root";
    private $password = "";
    public $conn;
    //
    public function getConnection()
    {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            echo "Error: " . $ex->getMessage();
        }
        return $this->conn;
    }

}