<?php

class Category
{
    private $conn;
    private $table = "categories";

    public $category;
    public $id;

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

    public function read_single()
    {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);

        $stmt->execute();

        $results = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($stmt->rowCount() > 0)
        {
            $this->category = $results['category'];
        }
        else
        {
            $this->id = null;
            $this->category = null;
        }
    }
}