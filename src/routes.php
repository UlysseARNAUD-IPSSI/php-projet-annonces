<?php
declare(strict_types=1);

function path()
{
    $routes = $_SESSION['routes'] ?? [];
    $parsed_routes = unserialize($routes);
    return $parsed_routes['path'];
}

function parseRoutes()
{

    $request_uri = $_SERVER['REQUEST_URI'];

    $url_explode = explode('?', $request_uri);

    $params = '';

    if (count($url_explode) > 1) {
        $params = $url_explode[1];
    }

    $url = $url_explode[0];

    if ($url_explode[0] == '/') {
        $url = DEFAULT_PAGE;
    }

    $path = '';

    $tokens = explode('/', $url);

    foreach ($tokens as $key => $token) {
        if ($token != "") {
            $routes[] = $token;
            if ($key > 1) {
                $path .= '/';
            } else {
                $path .= '';
            }
            $path .= $token;
        }
    }

    $method = $_SERVER['REQUEST_METHOD'];

    $parsed_routes = [
        "path" => $path,
        "method" => $method,
        "url" => $url
    ];

    $_SESSION['routes'] = serialize($parsed_routes);

}

function route(
    string $path,
    string $pattern,
    Callable $callbacks,
    bool $is_static = FALSE
): bool
{

    // $pattern = "/$pattern\??(.+)?/";
    $flags = 'i';
    $pattern = parseToRegex($pattern);
    $pattern = "/$pattern/$flags";
    $matches = false;
    preg_match($pattern, $path, $matches);

    if ($is_static) {
        $matches = $pattern === $path;
    }

    if ($matches) {
        $callbacks();
    }

    return (bool)$matches;
}

function routes(string $path)
{

    // Index (Première page) (Static)
    route($path, 'index(?!(.+))$', function () use ($path) {
        $controller_name = 'Pages';

        $path_exploded = explode('/', $path);

        $page_name = 'home';
        $page_arguments = $path_exploded;

        // dd(['controller name' => $controller_name, 'page name' => $page_name, 'args' => $page_arguments]);

        callControllerMethod($controller_name, $page_name, $page_arguments);
    });

    route($path, '^admin(?:/(.+))?$', function () use ($path) {

        redirectIfNotAuthentified();

        $controller_name = 'Admin';

        $path_exploded = explode('/', $path);

        if (1 === count($path_exploded)) {
            $page_name = DEFAULT_PAGE_ADMIN;
        } else {
            $page_name = $path_exploded[1];
        }

        $page_arguments = $path_exploded;

        callControllerMethod($controller_name, $page_name, $page_arguments);

    });

    // Api
    route($path, '^api(?:/(.+))?', function () use ($path) {
        $path_exploded = explode('/', $path);
        $controller_name = array_shift($path_exploded);
        $command_name = implode('/', $path_exploded);

        callControllerMethod($controller_name, 'commands', $command_name);
    });

    // Logout
    route($path, '^logout/?.?', function () use ($path) {
        redirectIfNotAuthentified();

        $controller_name = 'Logout';

        $path_exploded = explode('/', $path);

        $page_name = 'logout';
        $page_arguments = $path_exploded;

        callControllerMethod($controller_name, $page_name, $page_arguments);
    });

    // Mon profil
    route($path, '^mon-profil/?.?', function () use ($path) {
        redirectIfNotAuthentified();

        $controller_name = 'Pages';

        $path_exploded = explode('/', $path);

        $page_name = 'mon_profil';
        $page_arguments = $path_exploded;


        callControllerMethod($controller_name, $page_name, $page_arguments);
    });

    // Annonces
    route($path, '^annonces(?:/(.+))?$', function () use ($path) {

        $controller_name = 'Annonces';

        $path_exploded = explode('/', $path);

        $page_arguments = $path_exploded;

        if (1 === count($path_exploded)) {
            $page_name = 'home_annonces';
        }

        if (2 === count($path_exploded)) {
            $page_name = 'read_annonces';
            array_shift($page_arguments);
        }

        callControllerMethod($controller_name, $page_name, $page_arguments);
    });

    // Login
    route($path, '^login/?.?', function () use ($path) {
        $controller_name = 'Login';

        $path_exploded = explode('/', $path);

        $page_name = 'login';
        $page_arguments = $path_exploded;

        callControllerMethod($controller_name, $page_name, $page_arguments);
    });

    // Register
    route($path, '^register/?.?', function () use ($path) {
        $controller_name = 'Register';

        $path_exploded = explode('/', $path);

        $page_name = 'register';
        $page_arguments = $path_exploded;

        callControllerMethod($controller_name, $page_name, $page_arguments);
    });

}