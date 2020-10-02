<?php

declare(strict_types=1);

$database_name = DB_NAME;

$query = [
    // 'CREATE DATABASE ' . $database_name . ' CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;'
    "CREATE DATABASE IF NOT EXISTS `$database_name`;"
];

$file_content = implode(PHP_EOL, $query);

return $file_content;