<?php
function sortByField($sortField)
{
    if(request()->has('sortDirection')) {
        $sortDirection = request()->get('sortDirection');
        $sortDirection = $sortDirection == 'desc' ? 'asc' : 'desc';
    }else {
        $sortDirection = 'desc';
    }


    $sort = "?sort=".$sortField."&sortDirection=".$sortDirection."&";

    echo $sort;
}


?>
