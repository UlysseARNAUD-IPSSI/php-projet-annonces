<?php

declare(strict_types=1);

function viewPathInPages(
    string $view_name
)
{
    $prefix = 'pages';
    $view_path = viewPath($prefix, $view_name);
    return $view_path;
}

function viewContentInPages(
    string $view_name
)
{
    $prefix = 'pages';
    $view_path = viewPath($prefix, $view_name);

    $file_exists = file_exists($view_path);

    $view_content = null;

    if ($file_exists) {
        $view_content = require_once $view_path;
    }

    return $view_content;
}

function viewInPages(
    string $view_name,
    array $variables = []
)
{
    return viewContent('pages', $view_name, $variables);
}

function viewInAnnonces(
    string $view_name,
    array $variables = []
)
{
    return viewContent('annonces', $view_name, $variables);
}

function viewInAdmin(
    string $view_name,
    array $variables = []
)
{
    return viewContent('admin', $view_name, $variables);
}