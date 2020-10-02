<?php

declare(strict_types=1);

function getUserPseudo()
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

    try {
        $userPseudo = getUserPseudoById($userId);
        return $userPseudo;
    } catch (Exception $e) {
        throw new Exception('Error while getting the user\'s pseudo by id !');
    }
}