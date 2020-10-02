<?php

declare(strict_types=1);

function getUserPseudoById(
    string $id
): string
{
    $database = connectDatabase();
    $table = 'users';
    $column = 'pseudo';
    $parameters = [
        ['id', $id]
    ];

    try {
        $fetch = getColumnByParameters(
            $database,
            $table,
            $column,
            $parameters
        );

        $fetch = $fetch[0]->pseudo;

        return $fetch;
    } catch (Exception $e) {
        throw new Exception('Error while getting the user\'s pseudo by id !');
    }
}