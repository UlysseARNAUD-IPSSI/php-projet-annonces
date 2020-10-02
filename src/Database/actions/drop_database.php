<?php

declare(strict_types=1);

$database_name = DB_NAME;

$query = "DROP DATABASE $database_name;";

$file_content = $query . PHP_EOL;

return $file_content;