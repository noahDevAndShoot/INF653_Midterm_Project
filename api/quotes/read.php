<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include '../../config/Database.php';
include '../../models/Quotes.php';

$db = new Database();
$db = $db->connectDB();

$quote = new Quote($db);

$results = $quote->read();

if ($results->rowCount() > 0)
{
    while ($row = $results->fetch(PDO::FETCH_ASSOC))
    {
        echo json_encode(array(
            "id" => $row['id'],
            "quote" => $row['quote'],
            "authorId" => $row['authorId'],
            "categoryId" => $row['categoryId']
        ));
    }
}
else
{
    echo json_encode(array(
        "message" => "No Quotes Found"
    ));
}