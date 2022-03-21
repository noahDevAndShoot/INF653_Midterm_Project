<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include '../../config/Database.php';
include '../../models/Authors.php';

$db = new Database();
$db = $db->connectDB();

$author = new Author($db);

$author->id = $_GET['id'];

$author->read_single();

$json_array;

if ($author->id != null)
{
    $json_array = json_encode(array(
        "id" => $author->id, 
        "author" => $author->author
    ));
}
else
{
    $json_array = json_encode(array(
        "message" => "authorId Not Found"
    ));
}


echo $json_array;