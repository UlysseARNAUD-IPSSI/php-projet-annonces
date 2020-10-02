<?php

declare(strict_types=1);

define('ERROR_API_COMMAND_NOT_FOUND', 100000);

$errors = [
    'no-connection-with-database' => 'There is no connection with the database.',
    ERROR_API_COMMAND_NOT_FOUND => 'Command invalid'
];

define('ERRORS', $errors);