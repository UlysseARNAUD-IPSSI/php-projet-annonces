<?php

declare(strict_types=1);

$tables = [
//    'images',
//    'categories',
//    'comments',
//    'posts',
    'annonces',
    'users',
//    'comments_users',
//    'posts_categories',
//    'posts_users',
//    'posts_images',
//    'posts_comments',
//    'users_images',
];

$database_name = DB_NAME;

$query = [];

foreach ($tables as &$table) {
    $query []= "USE $database_name;";
    $query []= 'SET FOREIGN_KEY_CHECKS=0;';
    $query []= file_get_contents(DATABASE_DIR . "seeds/$table.sql");
    $query []= 'SET FOREIGN_KEY_CHECKS=1;';
}

$file_content = implode(PHP_EOL, $query);

return $file_content;
