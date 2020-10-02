<?php

$routes = $_SESSION['routes'];
$parsed_routes = unserialize($routes);

$path = 'resources/css' . $parsed_routes['path'] . '.css';
$parsed_path = parsePath($path);
$path_is_file = is_file($parsed_path);
if ($path_is_file) {
    echo sprintf(
        "<link rel=\"stylesheet\" href=\"%s\">",
        parseURL($path)
    );
}