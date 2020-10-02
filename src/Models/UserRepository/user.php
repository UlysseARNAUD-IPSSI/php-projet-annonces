<?php

declare(strict_types=1);

function checkIfUserExists(
    string $email
)
{
    try {
        $user = (int) getUserIdByEmail($email);

        $userExists = -1 !== $user;

        return $userExists;

    } catch (Exception $e) {
        throw new Exception('Error while checking if user exists !');
    }
}

function tokenSession()
{
    $issetToken = isset($_SESSION[SESSION_USER]);
    $token = null;
    if (true === $issetToken) {
        $token = $_SESSION[SESSION_USER];
    }
    return $token;
}

function username()
{

    $token = getSessionValue(SESSION_USER);

    try {
        $id = getUserIdByTokenSession($token);
    } catch (Exception $e) {
        // throw new Exception('Error while getting the username !');
        return;
    }

    $isIdNull = null === $id;
    if ($isIdNull) return;

    try {
        $username = getUserPseudoById($id);
        return $username;
    } catch (Exception $e) {
        // throw new Exception('Error while getting the username !');
        return '';
    }
}