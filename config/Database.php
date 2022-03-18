<?php
class Database 
{
    private $conn;
    private $host = "localhost";
    private $username = "root";
    private $db_name = "quotesdb";
    private $password = "";

    public function connectDB()
    {
        $this->conn = null;

        try
        {
            $this->conn = new PDO("mysql:host=" . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $error)
        {
            echo "Connection failed: " . $error->getMessage();
        }
        return $this->conn;
    }
}