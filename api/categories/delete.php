<?php


header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include '../../config/Database.php';
include '../../models/Categories.php';
include '../../functions/isValid.php';

$db = new Database();
$db = $db->connectDB();

$category = new Category($db);

$data = json_decode(file_get_contents('php://input'));

if(!$data->id)
{
    echo json_encode(array('message' => "Missing Required Parameters"));
    die();
}

if (!isValid($category, $data->id))
{
    echo json_encode(array('message' => "No Categories Found"));
    die();
}

$category->id = $data->id;
if ($category->delete())
{
    echo json_encode(array('id' => $category->id));
}
else
{
    echo json_encode(array('message' => 'Error'));
}