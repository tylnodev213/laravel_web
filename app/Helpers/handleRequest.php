<?php

function getRequest($request)
{
    $condition = [];
    foreach ($request as $field => $value)
    {
        $condition[] = $field.'='.$value;
    }

    if(empty($condition)){
        return '';
    }
    return '&'.implode('&', $condition);

}
