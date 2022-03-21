<?php
class Database 
{
    private $url = getenv('JAWSDB_URL');
    private $dbparts = parse_url($url);

    private $hostname = $dbparts['host'];
    private $username = $dbparts['user'];
    private $password = $dbparts['pass'];
    private $database = ltrim($dbparts['path'],'/');

    public function connectDB()
    {
        $this->conn = null;

        try
        {
            $this->conn = new PDO("mysql:host=" . $this->hostname . ';dbname=' . $this->database, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $error)
        {
            echo "Connection failed: " . $error->getMessage();
        }
        return $this->conn;
    }
}