<?php

declare(strict_types=1);

function deleteAnnonce(
    string $id
): void
{
    $database = connectDatabase();

    $parameters = [
        ['id', $id]
    ];

    deleteByParameters($database, 'annonces', $parameters);
}