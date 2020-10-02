<?php

declare(strict_types=1);

function encodeBase64(string $value)
{
    $encoded_value = base64_encode($value);
    return $encoded_value;
}