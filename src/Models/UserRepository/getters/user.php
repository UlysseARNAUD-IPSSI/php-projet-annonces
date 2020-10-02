<?php

declare(strict_types=1);

function getUser()
{
    $token = getTokenSession();

    if (null === $token) {
        return null;
    }

    try {
        $userId = getUserIdByTokenSession($token);
    } catch (Exception $e) {
        throw new Exception('Error while getting the user\'s id !');
    }

    $user = getSafeUserById($userId);

    return $user;
}