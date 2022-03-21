<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include '../../config/Database.php';
include '../../models/Authors.php';

$db = new Database();
$db = $db->connectDB();

$author = new Author($db);

$query_results = $author->read();

$num_rows = $query_results->rowCount();

if (!($num_rows > 0))
{
    echo json_encode(array('message' => 'No authors found.'));
    die();
}
else
{
    while ($row = $query_results->fetch(PDO::FETCH_ASSOC))
    {
        $row_array = array(
            'id' => $row['id'],
            'author' => $row['author']
        );
        echo json_encode($row_array);
    }
}


exit();