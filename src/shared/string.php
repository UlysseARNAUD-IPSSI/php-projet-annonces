<?php

declare(strict_types=1);

function joinEntriesWithUppercase(array $entries)
{
    $name = array_shift($entries);
    foreach ($entries as $entry) {
        $name .= addUppercaseToString($entry);
    }
    return $name;
}

function addUppercaseToString(string $string)
{
    $parsed_string = firstCharUppercase($string) . removeFirstChar($string);
    return $parsed_string;
}

function firstCharUppercase(string $word)
{
    return strtoupper($word[0]);
}

function removeFirstChar(string $word)
{
    return substr($word, 1);
}

function firstChar(string $word)
{
    return substr($word, 1);
}