<?php

declare(strict_types=1);

function viewPathInWorkspace(
    string $viewName
)
{
    $prefix = 'workspace';
    $viewPath = viewPath($prefix, $viewName);
    return $viewPath;
}

function viewContentInWorkspace(
    string $viewName
)
{
    $prefix = 'workspace';
    $viewPath = viewPath($prefix, $viewName);

    $fileExists = file_exists($viewPath);

    $viewContent = null;

    if ($fileExists) {
        $viewContent = require_once $viewPath;
    }

    return $viewContent;
}

function viewInWorkspace(
    string $viewName
)
{
    $prefix = 'workspace';
    $viewContent = viewContent($prefix, $viewName);
    return $viewContent;
}