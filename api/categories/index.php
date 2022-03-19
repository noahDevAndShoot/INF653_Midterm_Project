<?php

$method = $_SERVER['REQUEST_METHOD'];

if ($method == "GET")
{
    if (isset($_GET['id']))
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