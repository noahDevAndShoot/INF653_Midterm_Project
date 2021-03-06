<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include '../../config/Database.php';
include '../../models/Quotes.php';
include '../../models/Authors.php';
include '../../models/Categories.php';

$db = new Database();
$db = $db->connectDB();

$quote = new Quote($db);

if (isset($_GET['id']))
{
    $quote->id = $_GET['id'];
}
else
{
    $quote->id = null;
}

if (isset($_GET['authorId']))
{
    $quote->authorId = $_GET['authorId'];
}
else
{
    $quote->authorId = null;
}
if (isset($_GET['categoryId']))
{
    $quote->categoryId = $_GET['categoryId'];
}
else
{
    $quote->categoryId = null;
}


$results = $quote->read_single();
$json_array = array();

if ($results->rowCount() > 0)
{
    while ($row = $results->fetch(PDO::FETCH_ASSOC))
    {
        $author = new Author($db);
        $author->id = $row['authorId'];
        if (!$author->read_single())
        {
            echo json_encode(array('message' => "Error: " . $db->error));
            die();
        }
        $category = new Category($db);
        $category->id = $row['categoryId'];

        if (!$category->read_single())
        {
            echo json_encode(array('message' => "Error: " . $db->error));
            die();
        }

        if (isset($_GET['id'])) //there will only be one result, return as a single object
        {
            echo json_encode(array(            
                "id" => $row['id'],
                "quote" => $row['quote'],
                "author" => $author->author,
                "category" => $category->category));
            die();
        }

        array_push($json_array, array(
            "id" => $row['id'],
            "quote" => $row['quote'],
            "author" => $author->author,
            "category" => $category->category
        ));
    }
    echo json_encode($json_array);
}
else
{
    echo json_encode(array(
        'message' => 'No Quotes Found'
    ));
}

exit();