<?php


header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include '../../config/Database.php';
include '../../models/Quotes.php';
include '../../functions/isQuoteIdValid.php';

$db = new Database();
$db = $db->connectDB();

$quote = new Quote($db);

$data = json_decode(file_get_contents("php://input"));

if(!$data->id)
{
    echo json_encode(array(
        "message" => "Missing Required Parameters"
    ));
    die();
}

if (!isQuoteIdValid($quote, $data->id))
{
    echo json_encode(array(
        "message" => "No Quotes Found"
    ));
    die();
}

$quote->id = $data->id;

if ($quote->delete())
{
    echo json_encode(array(
        "id" => $quote->id
    ));
}
else
{
    echo json_encode(array(
        "message" => "Error"
    ));
}