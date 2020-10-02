<?php

declare(strict_types=1);

function saveUser(
    string $email,
    string $pseudo,
    string $phone,
    string $password,
    $userId = null
): void
{
    $database = connectDatabase();
    $hashedPassword = password($password);

    $columns = [
        'email' => $email,
        'pseudo' => $pseudo,
        'phone' => $phone,
        'password' => $hashedPassword,
        // 'user_id' => $userId
    ];

    insertUser($database, $columns);
}