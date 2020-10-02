<?php

declare(strict_types=1);

function updateAnnonce(
    PDO $database,
    string $id,
    array $columns
): void
{
    $database = connectDatabase();
    $parameters = [
        ['id', $id]
    ];
    try {
        updateColumnsByParameters($database, 'annonces', $columns, $parameters);
        return;
    } catch (Exception $e) {
        throw new Exception('Error while updating the annonce\'s by id !');
    }
}
