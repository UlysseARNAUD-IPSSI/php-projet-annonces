<?php

declare(strict_types=1);

function parseQueryParameter(
    $parameterValue,
    array &$values,
    int &$cursor
): string
{
    ++$cursor;
    $parameter = parameterName($cursor);

    $value = (string)$parameterValue;

    $values[$parameter] = $value;

    return $parameter;
}

function parameterName(
    int $cursor
)
{
    $parameterName = ':parameter' . $cursor;
    return $parameterName;
}