<?php

declare(strict_types=1);

function _database(string $name = '')
{

    $nameExploded = explode('/', $name);

    $commandName = array_shift($nameExploded);

    $commandName = parseName($commandName);

    $controllerMethodExists = function_exists($commandName);

    $commandArguments = $nameExploded;

    if (true === $controllerMethodExists) {
        call_user_func($commandName, ...$commandArguments);
        return;
    }

    $commandName = 'api_error';
    $errorCode = ERROR_API_COMMAND_NOT_FOUND;

    $controllerMethodExists = function_exists($commandName);

    if (true === $controllerMethodExists) {
        call_user_func($commandName, $errorCode);
        return;
    }

    return;
}

function create_database() {
    $query = require_once DATABASE_DIR . DIRECTORY_SEPARATOR . 'actions' . DIRECTORY_SEPARATOR . 'create_database.php';

    $database = database();
    $database->exec($query);

    $response = response(0, 'Base de donnees creee !');

    echo $response;
}

function drop_database() {
    $query = require_once DATABASE_DIR . DIRECTORY_SEPARATOR . 'actions' . DIRECTORY_SEPARATOR . 'drop_database.php';

    $database = database();
    $database->exec($query);

    $response = response(0, 'Base de donnees supprimee !');

    echo $response;
}

function drop_tables() {
    $query = require_once DATABASE_DIR . DIRECTORY_SEPARATOR . 'actions' . DIRECTORY_SEPARATOR . 'drop_tables.php';

    $database = database();
    $database->exec($query);

    $response = response(0, 'Tables supprimmees !');

    echo $response;
}

function run_migrations() {
    $query = require_once DATABASE_DIR . DIRECTORY_SEPARATOR . 'actions' . DIRECTORY_SEPARATOR . 'run_migrations.php';

    $database = database();
    $database->exec($query);

    $response = response(0, 'Migrations executees !');

    echo $response;
}

function run_seeders() {
    $query = require_once DATABASE_DIR . DIRECTORY_SEPARATOR . 'actions' . DIRECTORY_SEPARATOR . 'run_seeders.php';

    $database = database();
    $database->exec($query);

    $response = response(0, 'Jeu de donnees executees !');

    echo $response;
}