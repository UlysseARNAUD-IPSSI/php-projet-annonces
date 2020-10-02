<?php

declare(strict_types=1);

function commands(string $name)
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