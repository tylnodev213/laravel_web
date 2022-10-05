<?php
if (!function_exists('checkSuperAdmin')) {
    function checkSuperAdmin()
    {
        return (seesion()->get('position')===1);
    }
}
