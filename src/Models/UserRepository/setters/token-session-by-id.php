<?php

declare(strict_types=1);

function updateTokenSessionById(
    string $id,
    ?string $token
)
{
    $database = connectDatabase();
    $table = 'users';
    $columns = [
        'token_session' => $token
    ];
    $parameters = [
        ['id', $id]
    ];

    try {
        updateColumnsByParameters(
            $database,
            $table,
            $columns,
            $parameters
        );
        return;
    } catch (Exception $e) {
        throw new Exception('Error while updating the user\'s token by id !');
    }
}