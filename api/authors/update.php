<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../models/Authors.php';
include_once '../../config/Database.php';
include '../../functions/isValid.php';

$db = new Database();
$db = $db->connectDB();

$author = new Author($db);

$data = json_decode(file_get_contents("php://input"));

if(!$data->author or !$data->id)
{
    echo json_encode(array('message' => 'Missing Required Parameters'));
    die();
}

if (!isValid($author, $data->id))
{
    echo json_encode(array('message' => 'authorId Not Found'));
    die();
}

$author->author = $data->author;

if ($author->update())
{
    echo json_encode(array(
        'id' => $author->id,
        'author' => $author->author
    ));
}
else
{
    echo json_encode(array('message' => 'Error'));
}
