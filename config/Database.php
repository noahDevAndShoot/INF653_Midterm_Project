<?php
class Database 
{
    private $conn;
    private $host = "acw2033ndw0at1t7.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
    private $username = "mse9eib2z4ug3gbd";
    private $db_name = "zwp3tcipxqsaop9u";
    private $password = getenv('JAWSDB_PASSWD');

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