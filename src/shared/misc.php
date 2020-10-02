<?php

declare(strict_types=1);

function parsePath($path)
{
    if ($path[0] == '/' || $path[0] == '\\') {
        return ROOT_DIR . substr($path, 1);
    } else {
        return ROOT_DIR . $path;
    }
}

function parseURL($url)
{
    if ($url[0] == '/' || $url[0] == '\\') {
        return WEB_URL . substr($url, 1);
    }

    return WEB_URL . $url;
}

function parseCanonicalFilename($canonical)
{
    return str_replace('-', '_', $canonical);
}

function parseCanonicalFile($canonique, $ext = 'php')
{
    return parsePath(parseCanonicalFilename($canonique) . ".$ext");
}

function filenameToCanonical($filename)
{
    return str_replace('_', '-', $filename);
}