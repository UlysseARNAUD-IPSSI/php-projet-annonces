<?php

declare(strict_types=1);

function saveAnnonce(
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

    insertAnnonce($database, $columns);
}