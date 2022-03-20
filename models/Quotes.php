<?php 

class Quote 
{
    private $conn;
    private $table = "quotes";

    public $id;
    public $quote;
    public $categoryId;
    public $authorId;

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
        $isConditionAdded = false;
        $query = 'SELECT * FROM ' . $this->table . ' WHERE ';
        if ($this->id != null)
        {
            $query .= ' id = :id ';
            $isConditionAdded = true;
        }
        if ($this->authorId != null)
        {
            if ($isConditionAdded)
            {
                $query .= 'AND ';
            }
            $query .= 'authorId = :authorId ';
            $isConditionAdded = true;
        }
        if ($this->categoryId != null)
        {
            if ($isConditionAdded)
            {
                $query .= 'AND ';
            }
            $query .= 'categoryId = :categoryId';
            $isConditionAdded = true;
        }

        $stmt = $this->conn->prepare($query);
        if ($this->id != null)
        {
            $stmt->bindParam(':id', $this->id);
        }
        if ($this->authorId != null)
        {
            $stmt->bindParam(':authorId', $this->authorId);
        }
        if ($this->categoryId != null)
        {
            $stmt->bindParam(':categoryId', $this->categoryId);
        }
            
        $stmt->execute();

        return $stmt;
    }
}
