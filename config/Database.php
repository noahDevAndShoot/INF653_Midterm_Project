<?php
class Database 
{
    private $url;
    private $dbparts = parse_url($url);

    public function __construct()
    {
        $this->conn = null;
    }

    public function connectDB()
    {
        $this->url = getenv('JAWSDB_URL');
        $dbparts = parse_url($this->url);
        $hostname = $dbparts['host'];
        $username = $dbparts['user'];
        $password = $dbparts['pass'];
        $database = ltrim($dbparts['path'],'/');

        try
        {
            $this->conn = new PDO("mysql:host=$this->hostname;dbname=$this->database", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $error)
        {
            echo "Connection failed: " . $error->getMessage();
        }
        return $this->conn;
    }
}