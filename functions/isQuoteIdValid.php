<?php

function isQuoteIdValid($quote, $id)
{
    $quote->id = $id;
    $result = $quote->read_single();
    if ($result->rowCount() > 0)
    {
        return true;
    }
    return false;
}