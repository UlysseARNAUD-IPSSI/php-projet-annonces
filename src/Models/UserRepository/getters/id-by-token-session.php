<?php

declare(strict_types=1);

function getUserIdByTokenSession(
    string $token
): ?string
{
    $database = connectDatabase();
    $table = 'users';
    $column = 'id';
    $parameters = [
        ['token_session', $token]
    ];

    try {
        $fetch = getColumnByParameters(
            $database,
            $table,
            $column,
            $parameters
        );

        $countInFetch = count($fetch);

        if (0 === $countInFetch) {
            return null;
        }

        $fetch = $fetch[0]->id;

        return $fetch;
    } catch (Exception $e) {
        throw new Exception('Error while getting the user\'s id by email !');
    }

}