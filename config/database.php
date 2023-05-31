<?php
class Database
{
    private $host = "localhost";
    private $database = "phpapidb";
    private $username = "root";
    private $password = "2212";
    public $conn;
    public function Connection()
    {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "LỖI KẾT NỐI: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
