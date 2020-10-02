<?php

declare(strict_types=1);

function viewPath(
    string $prefix,
    string $view_name
)
{
    return VIEWS_DIR . "$prefix" . DIRECTORY_SEPARATOR . "$view_name.php";
}

function viewContent(
    string $prefix,
    string $view_name,
    array $variables = []
)
{
    extract($variables);
    return require_once(viewPath($prefix, $view_name));
}

function view(
    string $prefix,
    string $view_name,
    array $variables = []
)
{
    return viewContent($prefix, $view_name, $variables);
}
