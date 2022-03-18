<?php

$method = $_SERVER['REQUEST_METHOD'];

if ($method == "GET")
{
    include './read.php';
}