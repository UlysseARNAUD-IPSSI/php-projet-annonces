<?php

declare(strict_types=1);

function getUserIdByEmail(
    string $email
): string
{
    $database = connectDatabase();
    $table = 'users';
    $column = 'id';
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
            $fetch = $fetch[0]->id;
        }
        else {
            $fetch = -1;
        }

        $fetch = (string)$fetch;

        return $fetch;
    } catch (Exception $e) {
        throw new Exception('Error while getting the user\'s id by email !');
    }

}