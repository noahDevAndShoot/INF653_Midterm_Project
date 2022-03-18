<?php
class Author                        
{
    public $author_name;
    public $id;
    private $conn;
    private $table = "authors";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = 'SELECT id, author FROM ' . $this->table;

        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        return $stmt;
    }

    public function read_single()
    {
        $query = 'SELECT id, author FROM ' . $this->table 
        . ' WHERE id = :id';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($stmt->rowCount() > 0)
        {
            $this->id = $result['id'];
            $this->author = $result['author'];
        }
        else
        {
            $this->id = null;
            $this->author = null;
        }
    }
}