<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];
if ($method === 'OPTIONS') {
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
}

if ($method == "GET")
{
    if (isset($_GET['id']) or isset($_GET['authorId']) or isset($_GET['categoryId']))
    {
        include './read_single.php';
    }
    else
    {
        include './read.php';
    }  
}
else if ($method == "POST")
{
    include './create.php';
}
else if ($method == "PUT")
{
    include './update.php';
}
else if ($method == "DELETE")
{
    include './delete.php';
}