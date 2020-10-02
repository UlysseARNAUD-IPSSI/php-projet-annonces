<?php

declare(strict_types=1);

function api_error(
    $code
)
{
    $statusCode = $code;

    $message = ERRORS[$statusCode];
    $issetMessage = isset($message);

    if (false === $issetMessage) {
        $message = '';
    }

    $response = response($statusCode, $message);

    echo $response;

    // return $response;
}