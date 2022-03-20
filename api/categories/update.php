<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../models/Categories.php';
include_once '../../config/Database.php';
include '../../functions/isValid.php';

$db = new Database();
$db = $db->connectDB();

$category = new Category($db);

$data = json_decode(file_get_contents("php://input"));

if(!$data->id or !$data->category)
{
    echo json_encode(array('message' => 'Missing Required Parameters'));
    die();
}

if (!isValid($category, $data->id))
{
    echo json_encode(array('message' => 'categoryID Not Found'));
    die();
}

$category->id = $data->id;
$category->category = $data->category;

if ($category->update())
{
    echo json_encode(array(
        'id' => $category->id,
        'category' => $category->category
    ));
}
else
{
    echo json_encode(array('message' => 'Error'));
}
