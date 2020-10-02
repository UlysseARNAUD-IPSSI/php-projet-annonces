<?php

declare(strict_types=1);

function parseCanonicalPostName (string $postName)
{
    $canonicalName = strtolower($postName);
    $canonicalName = removeAccents($canonicalName);
    $canonicalName = preg_replace('/ /', '-', $canonicalName);
    return $canonicalName;
}