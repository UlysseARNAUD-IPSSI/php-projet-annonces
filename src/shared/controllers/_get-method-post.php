<?php

declare(strict_types=1);

function getPostMethodNameIfExists(string $methodName)
{
    $oldMethodName = $methodName;
    $methodName = joinEntriesWithUppercase([
        'post', $methodName
    ]);

    $nameExists = function_exists($methodName);

    if (false === $nameExists) {
        $methodName = $oldMethodName;
    }

    return $methodName;
}