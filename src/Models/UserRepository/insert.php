<?php

declare(strict_types=1);

function insertUser(
    PDO $database,
    array $columns
): void
{
    insert($database, 'users', $columns);
}
