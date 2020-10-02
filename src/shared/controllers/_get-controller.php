<?php

declare(strict_types=1);

function getControllerName(string $name)
{
    $controller_name = $name . 'Controller';
    return $controller_name;
}

function getControllerFile(string $name)
{
    $controller_name = getControllerName($name);
    $controller_file = "$controller_name.php";
    return $controller_file;
}

function getControllerPath(string $name)
{
    $controller_file = getControllerFile($name);
    $controller_path = CONTROLLERS_DIR . $controller_file;
    return $controller_path;
}