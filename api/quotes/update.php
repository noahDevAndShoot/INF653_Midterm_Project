<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../models/Quotes.php';
include '../../models/Authors.php';
include '../../models/Categories.php';
include_once '../../config/Database.php';
include '../../functions/isValid.php';
include '../../functions/isQuoteIdValid.php';

$db = new Database();
$db = $db->connectDB();

$data = json_decode(file_get_contents("php://input"));

if (!$data->categoryId or !$data->quote or !$data->authorId or !$data->id)
{
    echo json_encode(array('message' => 'Missing Required Parameters'));
    die();
}

$test_author = new Author($db);

$test_category = new Category($db);

$quote = new Quote($db);

//so that isValid() executes properly
$quote->authorId = null;
$quote->categoryId = null;

if (!isQuoteIdValid($quote, $data->id))
{
    echo json_encode(array(
        'message' => 'No Quotes Found'
    ));
    die();
}
if (!isValid($test_author, $data->authorId))
{
    echo json_encode(array(
        'message' => 'authorId Not Found'
    ));
    die();
}

if (!isValid($test_category,  $data->categoryId))
{
    echo json_encode(array(
        'message' => 'categoryId Not Found'
    ));
    die();
}

$quote->id = $data->id;
$quote->quote = $data->quote;
$quote->authorId = $data->authorId;
$quote->categoryId = $data->categoryId;

if ($quote->update())
{
    echo json_encode(array(
        'id' => $quote->id,
        'quote' => $quote->quote,
        'categoryId' => $quote->categoryId,
        'authorId' => $quote->authorId
    ));
}
else
{
    echo json_encode(array('message' => 'Error'));
}
