<?php

declare(strict_types=1);

function generateToken($length): string
{
    try {
        $tokenBinary = random_bytes(TOKEN_LENGTH);
        $token = bin2hex($tokenBinary);
        return $token;
    } catch (Exception $e) {
        throw new Exception('Error while generating token !');
    }
}

function getTokenSession(): ?string
{
    $isTokenSets = issetSessionValue(SESSION_USER);
    $token = null;

    if (true === $isTokenSets) {
        $token = getSessionValue(SESSION_USER);
    }

    return $token;
}

function getTokenApi(): ?string
{
    $isTokenSets = issetSessionValue(SESSION_API);
    $token = null;

    if (true === $isTokenSets) {
        $token = getSessionValue(SESSION_API);
    }

    return $token;
}