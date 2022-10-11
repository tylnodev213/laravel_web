<?php

function getNoticeAction()
{
    echo session()->get('message_successful');
    session()->pull('message_successful');
}


