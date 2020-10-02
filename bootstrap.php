<?php

declare(strict_types=1);

require_once __DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'index.d.php';

require_once SHARED_DIR . 'index.d.php';

require_once CONTROLLERS_DIR . 'index.d.php';

require_once SRC_DIR . 'routes.php';

safeStartSession();

parseRoutes();

$routes = $_SESSION['routes'];
$parsed_routes = unserialize($routes);

try {
    routes($parsed_routes['path']);
} catch (PDOException $e) {
    var_dump($e);
} catch (Exception $e) {
    var_dump($e);
}