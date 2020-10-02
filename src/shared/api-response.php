<?php

declare(strict_types=1);

function response(
    int $statusCode,
    string $message,
    string $fetch = null
)
{

    $response = [];

    $responseToParse = [
        API_STATUS => $statusCode,
        API_STATUS_TEXT => $message
    ];

    if (null !== $fetch) {
        $responseToParse[API_FETCH] = $fetch;
    }


    foreach ($responseToParse as $key => $value) {
        addValueToResponse($response, $key, $value);
    }

    $responseEncoded = encodeResponse($response);

    return $responseEncoded;
}

function addValueToResponse(
    array &$response,
    string $key,
    $value
)
{
    $response[$key] = $value;
}

function encodeResponse($response)
{
    $response = json_encode($response);
    return $response;
}

function decodeResponse(string $response)
{
    return json_decode($response);
}