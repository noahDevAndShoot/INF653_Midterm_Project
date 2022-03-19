<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include '../../config/Database.php';
include '../../models/Categories.php';

$db = new Database();
$db = $db->connectDB();

$category = new Category($db);


$data = json_decode(file_get_contents("php://input"));

if(!$data->category)
{
    echo json_encode(array('message' => 'Missing Required Parameters'));
    die();
}

$category->category = $data->category;

if($category->create())
{
    echo json_encode(array(
        'message' => 'Category Created'
    ));
}
else
{
    echo json_encode(array(
        'message' => "Error Category NOT created"
    ));
}
