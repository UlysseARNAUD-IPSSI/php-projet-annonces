<?php

declare(strict_types=1);

function issetPost()
{
    $is_set = isset($_POST);
    $is_empty = $_POST === [] && count($_POST) === 0;
    $is_not_empty = false === $is_empty;
    $is_really_set = $is_set && $is_not_empty;
    return $is_really_set;
}

function unsetPOST()
{
    unset($_POST);
}

function addValueToPOST($key, $value)
{
    $_POST[$key] = $value;
}

function unsetValueToPOST($key)
{
    unset($_POST[$key]);
}

function getValueFromPOST($key)
{
    $isserPostValue = issetPostValue($key);

    if (false === $isserPostValue) {
        return null;
    }


    $value = $_POST[$key];
    $value = html_entity_decode($value);
    return $value;
}

function issetPostValue(string $name): bool
{
    $issetPost = issetPost();

    if (false === $issetPost) {
        return false;
    }

    $issetPostValue = isset($_POST[$name]);

    if (false === $issetPostValue) {
        return false;
    }

    return true;
}