<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include '../../config/Database.php';
include '../../models/Categories.php';

$db = new Database();
$db = $db->connectDB();

$category = new Category($db);

$category->id = $_GET['id'];

$category->read_single();

if ($category->id == null)
{
    echo json_encode(array('message' => 'categoryId Not Found'));
    die();
}

echo json_encode(array(
    'id' => $category->id,
    'category' => $category->category
));