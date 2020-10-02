<?php

declare(strict_types=1);

function redirectIfNotAuthentified()
{
    if (false === isAuthentified()) {
        header('Location: /');
    }
}

function isAuthentified()
{
    $user = tokenSession();
    return isset($user);
}

function disconnectUserIfTokenInDatabaseIsNull(): void
{
    try {
        $isTokenNull = isTokenInDatabaseNull();
    } catch (Exception $e) {
        throw new Exception('Error while checking if token in database is null !');
    }

    if (true === $isTokenNull) {
        try {
            unstoreTokenSession();
        } catch (Exception $e) {
            throw new Exception('Error while disconnecting the user !');
        }
    }
}

function isTokenInDatabaseNull(): bool
{
    $token = getTokenSession();

    if (null === $token) {
        return true;
    }

    try {
        $userId = getUserIdByTokenSession($token);
    } catch (Exception $e) {
        throw new Exception('Error while checking if token in database is null !');
    }

    $isUserIdEmpty = empty($userId);

    if ($isUserIdEmpty) {
        return true;
    }

    return false;
}