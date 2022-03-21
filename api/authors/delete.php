<?php


header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include '../../config/Database.php';
include '../../models/Authors.php';
include '../../functions/isValid.php';

$db = new Database();
$db = $db->connectDB();

$author = new Author($db);

$data = json_decode(file_get_contents("php://input"));

if(!$data->id)
{
    echo json_encode(array('message' => 'Missing Required Parameters'));
    die();
}

if(!isValid($author, $data->id))
{
    echo json_encode(array('message' => 'authorId Not Found'));
    die();
}

if ($author->delete())
{
    echo json_encode(array('id' => $author->id));
}
else
{
    echo json_encode(array('message' => 'Error: ' . $this->conn->error));
}
exit();