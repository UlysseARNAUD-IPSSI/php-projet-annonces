<?php

$routes = $_SESSION['routes'];
$parsed_routes = unserialize($routes);

$path = 'resources/js' . $parsed_routes['path'] . '.js';
$parsed_path = parsePath($path);
$path_is_file = is_file($parsed_path);
if ($path_is_file) {
    echo sprintf(
        "<script type=\"application/javascript\" src=\"%s\"></script>",
        parseURL($path)
    );
}