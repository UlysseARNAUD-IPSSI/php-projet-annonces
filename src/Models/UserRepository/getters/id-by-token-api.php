<?php

declare(strict_types=1);

function getUserIdByTokenApi(
    string $token
): string
{
    $database = connectDatabase();
    $table = 'users';
    $column = 'id';
    $parameters = [
        ['token_api', $token]
    ];

    try {
        $fetch = getColumnByParameters(
            $database,
            $table,
            $column,
            $parameters
        );

        $fetch = $fetch[0]->id;

        return $fetch;
    } catch (Exception $e) {
        throw new Exception('Error while getting the user\'s id by email !');
    }

}