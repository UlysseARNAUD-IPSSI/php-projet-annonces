<?php

declare(strict_types=1);

function issetPageFromPOST(): bool
{
    $issetPostValue = issetPostValue(POST_PAGE);
    return $issetPostValue;
}

function getPageFromPOST(): int
{
    $issetPage = issetPageFromPOST();

    if (false === $issetPage) {
        return DEFAULT_POST_PAGE;
    }

    $page = getValueFromPOST(POST_PAGE);

    $page = (int)$page;

    return $page;
}