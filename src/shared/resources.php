<?php

declare(strict_types=1);

function getResourcesURL(string $relative_path)
{
    $first_char_url = firstChar($relative_path);
    $is_first_char_slash = $first_char_url === '/';

    if (false === $is_first_char_slash) {
        $relative_path = "/$relative_path";
    }

    $url = RESOURCES_NAME . $relative_path;
    $parsed_url = parseURL($url);

    return $parsed_url;
}