<?php

declare(strict_types=1);

function password(
    string $password
): string
{
    return password_hash($password, PASSWORD_DEFAULT);
}

function checkIfPasswordValid(
    string $email,
    string $password
): bool
{
    try {
        $userPassword = getPasswordByEmail($email);

        if (null === $userPassword) {
            return false;
        }

        $verifyPassword = password_verify($password, $userPassword);
        $userExists = false !== $verifyPassword;

        return $userExists;

    } catch (Exception $e) {
        throw new Exception('Error while checking if user exists !');
    }
}