<?php

declare(strict_types=1);

function storeUserInSession(string $token): void
{
    addValueToSession(SESSION_USER, $token);
}

function generateTokenSession(): string
{
    try {
        $token = generateToken(TOKEN_LENGTH);
        return $token;
    } catch (Exception $e) {
        throw new Exception('Error while generating session token !');
    }
}

function connectUser(string $id): void
{
    try {
        $token = generateTokenSession();

        updateTokenSessionById($id, $token);

        storeUserInSession($token);
    } catch (Exception $e) {
        throw new Exception('Error while connecting user !');
    }

}

function disconnectUser()
{
    $token = getSessionValue(SESSION_USER);

    $database = connectDatabase();
    $parameters = [
        ['token_session', $token]
    ];

    try {
        $userId = getColumnByParameters($database, 'users', 'id', $parameters);

        $countInUserId = count($userId);
        if (1 < $countInUserId) {
            $userId = $userId[0]->id;
            updateTokenSessionById($userId, null);
        }
    } catch (Exception $e) {
        throw new Exception('Error while disconnecting the user !');
    }

    unstoreTokenSession();
}

function unstoreTokenSession()
{
    $token = tokenSession();
    $issetSessionUser = isset($token);
    if (true === $issetSessionUser) {
        unset($_SESSION[SESSION_USER]);
    }
}