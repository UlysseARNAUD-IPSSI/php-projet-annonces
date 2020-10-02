<?php

declare(strict_types=1);

function issetGet()
{
    $isset = isset($_GET);
    return $isset;
}

function unsetGET()
{
    unset($_GET);
}

function addValueToGET($key, $value)
{
    $_GET[$key] = $value;
}

function unsetValueToGET($key)
{
    unset($_GET[$key]);
}

function getValueFromGET($key)
{
    $value = $_GET[$key];
    $value = html_entity_decode($value);
    return $value;
}