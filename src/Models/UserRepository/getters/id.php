<?php

declare(strict_types=1);

function getUserId()
{
    $token = getTokenSession();

    if (null === $token) {
        return null;
    }

    try {
        $userId = getUserIdByTokenSession($token);
        return $userId;
    } catch (Exception $e) {
        throw new Exception('Error while getting the user\'s id !');
    }
}