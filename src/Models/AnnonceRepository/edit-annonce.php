<?php

declare(strict_types=1);

function editAnnonce(
    string $id,
    string $title,
    string $description,
    string $price,
    string $ends_at
): void
{
    $database = connectDatabase();

    $columns = [
        'title' => $title,
        'description' => $description,
        'price' => $price,
        'ends_at' => $ends_at,
    ];

    updateAnnonce($database, $columns);
}