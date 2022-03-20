<?php

$method = $_SERVER['REQUEST_METHOD'];

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