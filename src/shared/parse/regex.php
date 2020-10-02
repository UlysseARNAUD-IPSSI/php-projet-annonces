<?php

declare(strict_types=1);

function parseToRegex(string $string)
{
    $parsed_string = str_replace('/', '\\/', $string);
    return $parsed_string;
}