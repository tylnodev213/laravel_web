<?php

function getRequest($request)
{
    $condition = [];
    foreach ($request as $field => $value)
    {
        $condition[] = $field.'='.$value;
    }
    return implode('&', $condition);

}
