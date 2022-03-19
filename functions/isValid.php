<?php

function isValid($model, $id)
{
    $model->id = $id;
    $result = $model->read_single();
    return $result;
}