<?php
class Author                        
{
    private $author_name;
    private $id;
    private $conn;
    private $table = "authors";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = 'SELECT * FROM ' . $this->table;

        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        return $stmt;
    }
}