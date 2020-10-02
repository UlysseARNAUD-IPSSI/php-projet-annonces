<?php

declare(strict_types=1);

function viewPathInPost(
    string $viewName
)
{
    $prefix = 'post';
    $viewPath = viewPath($prefix, $viewName);
    return $viewPath;
}

function viewContentInPost(
    string $viewName
)
{
    $viewPath = viewPathInPost($viewName);

    $fileExists = file_exists($viewPath);

    $viewContent = null;

    if ($fileExists) {
        $viewContent = require_once $viewPath;
    }

    return $viewContent;
}

function viewInPost(
    string $viewName
)
{
    $viewContent = viewContentInPost($viewName);
    return $viewContent;
}