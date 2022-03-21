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
        $this->authorId = htmlspecialchars(strip_tags($this->authorId));
        $this->categoryId = htmlspecialchars(strip_tags($this->categoryId));
        $this->id = htmlspecialchars(strip_tags($this->id));

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

    public function create()
    {
        $query = 'INSERT INTO ' . $this->table . ' (quote, categoryId, authorId)
        VALUES (:quote, :categoryId, :authorId)';

        $stmt = $this->conn->prepare($query);

        $this->quote = htmlspecialchars(strip_tags($this->quote));
        $this->authorId = htmlspecialchars(strip_tags($this->authorId));
        $this->categoryId = htmlspecialchars(strip_tags($this->categoryId));

        $stmt->bindParam(':quote', $this->quote);
        $stmt->bindParam(':categoryId', $this->categoryId);
        $stmt->bindParam(':authorId', $this->authorId);

        if ($stmt->execute())
        {
            return true;
        }
        return false;
    }

    public function update()
    {
        $query = 'UPDATE ' . $this->table . ' SET quote = :quote, categoryId = :categoryId, authorId = :authorId
        WHERE id = :id';

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->quote = htmlspecialchars(strip_tags($this->quote));
        $this->authorId = htmlspecialchars(strip_tags($this->authorId));
        $this->categoryId = htmlspecialchars(strip_tags($this->categoryId));

        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':quote', $this->quote);
        $stmt->bindParam(':categoryId', $this->categoryId);
        $stmt->bindParam(':authorId', $this->authorId);

        if ($stmt->execute())
        {
            return true;
        }
        return false;
    }

    public function delete()
    {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute())
        {
            return true;
        }
        return false;
    }
}
