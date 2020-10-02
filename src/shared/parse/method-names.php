<?php

declare(strict_types=1);

function parseMethodName(
    string $name,
    string $delimiter = '-'
)
{
    $name_exploded = explode('-', $name);
    $number_word = count($name_exploded);

    if ($number_word === 1) {
        return array_shift($name_exploded);
    }

    $parsed_name = joinEntriesWithUppercase($name_exploded);

    return $parsed_name;
}