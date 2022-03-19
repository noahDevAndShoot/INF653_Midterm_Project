<?php
class Author                        
{
    public $author;
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
            return true;
        }
        else
        {
            $this->id = null;
            $this->author = null;
            return false;
        }
    }

    public function create()
    {
        $query = 'INSERT INTO ' . $this->table . ' (author)
        VALUES(:author)';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':author', $this->author);

        if ($stmt->execute())
        {
            return true;
        }
        return false;
    }

    public function update()
    {
        $query = 'UPDATE ' . $this->table . ' SET author = :author WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute())
        {
            return true;
        }
        return false;
    }

    public function delete()
    {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id=:id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute())
        {
            return true;
        }
        return false;
    }
}