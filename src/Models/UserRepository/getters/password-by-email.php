<?php

declare(strict_types=1);

function getPasswordByEmail(
    string $email
): ?string
{
    $database = connectDatabase();
    $table = 'users';
    $column = 'password';
    $parameters = [
        ['email', $email]
    ];

    try {
        $fetch = getColumnByParameters(
            $database,
            $table,
            $column,
            $parameters
        );

        $isFetchEmpty = [] === $fetch;

        if (false === $isFetchEmpty) {
            $fetch = $fetch[0]->password;
        }
        else {
            $fetch = null;
        }

        return $fetch;
    } catch (Exception $e) {
        throw new Exception('Error while getting the password by email !');
    }
}