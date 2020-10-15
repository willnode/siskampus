<?php

function module_url($url)
{
    return STATIC_URL. '/modules/' . $url;
}

function static_url($url)
{
    return STATIC_URL. '/' . $url;
}
