<?php

declare(strict_types=1);

const DEFAULT_CHARSET = 'utf-8';


function actAsJSON()
{
    $media_type = 'application/json';
    actAs($media_type);
}

function actAsHTML()
{
    $media_type = 'text/html';
    actAs($media_type);
}

function actAs(
    string $mime,
    string $charset = DEFAULT_CHARSET,
    string $boundary = null,
    string $length = null
)
{
    $content_type = [];

    $content_type[] = "Content-Type:$mime";

    if ($charset) {
        $content_type[] = "charset=$charset";
    }

    if ($boundary) {
        $content_type[] = "boundary=$boundary";
    }

    $formatted_content_type = implode('; ', $content_type);

    if ($length) {
        $content_length = "Content-Length:$length";
        $formatted_content_type .= $content_length;
    }

    header($formatted_content_type);
}