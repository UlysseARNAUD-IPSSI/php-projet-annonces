<?php

declare(strict_types=1);

/**
 *  Execute les migrations de chaque table en fonction de l'ordre donnée si-dessous.
 */

$tables = [
    'images',
    'categories',
    'post',
    'posts_categories',
    'users'
];

$database_name = DB_NAME;

$query = [
    'SET FOREIGN_KEY_CHECKS=0;',
    "USE $database_name;"
];

$position_table = 0;
$number_of_tables = count($tables);
$number_before_end = $number_of_tables - 1;

while ($position_table < $number_before_end) {
    $position_table++;
    $table = $tables[$position_table];
    $query[] = "DROP TABLE IF EXISTS $table;";
}

$query[] = 'SET FOREIGN_KEY_CHECKS=1;';

$file_content = implode(PHP_EOL, $query);

return $file_content;
