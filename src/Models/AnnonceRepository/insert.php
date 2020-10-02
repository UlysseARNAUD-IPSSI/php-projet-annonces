<?php

declare(strict_types=1);

function insertAnnonce(
    PDO $database,
    array $columns
): void
{
    try {
        insert($database, 'annonces', $columns);
    } catch (Exception $e) {
        throw new Exception('Error while inserting the annonce !');
    }
}
