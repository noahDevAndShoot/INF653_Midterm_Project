<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../models/Authors.php';
include_once '../../config/Database.php';

$db = new Database();
$db = $db->connectDB();

$author = new Author($db);

$data = json_decode(file_get_contents("php://input"));

if(!$data->author)
{
    echo json_encode(array('message' => 'author NOT SET'));
    die();
}

$author->author = htmlspecialchars(strip_tags($data->author));

if($author->create())
{
    echo json_encode(array(
        'message' => 'Author Created'
    ));
}
else
{
    echo json_encode(array(
        'message' => "Error Author NOT created"
    ));
}
