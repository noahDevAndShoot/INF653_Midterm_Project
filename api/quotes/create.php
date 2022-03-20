<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include '../../config/Database.php';
include '../../models/Quotes.php';
include '../../models/Authors.php';
include '../../models/Categories.php';
include '../../functions/isValid.php';

$db = new Database();
$db = $db->connectDB();

$quote = new Quote($db);

$data = json_decode(file_get_contents('php://input'));

if (!$data->categoryId or !$data->quote or !$data->authorId)
{
    echo json_encode(array('message' => 'Missing Required Parameters'));
    die();
}

$test_author = new Author($db);

$test_category = new Category($db);

if (!isValid($test_author, $data->authorId) or !isValid($test_category,  $data->categoryId))
{
    echo json_encode(array(
        'message' => 'Invalid authorId or categoryId'
    ));
    die();
}

$quote->quote = $data->quote;
$quote->authorId = $data->authorId;
$quote->categoryId = $data->categoryId;

if ($quote->create())
{
    echo json_encode(array(
        'id' => $db->lastInsertId(),
        'quote' => $quote->quote,
        'categoryId' => $quote->categoryId,
        'authorId' => $quote->authorId
    ));
}
else
{
    echo json_encode(array('message' => 'Error'));
}