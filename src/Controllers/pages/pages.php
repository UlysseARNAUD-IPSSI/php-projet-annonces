<?php

declare(strict_types=1);

function pages(
    string $name = DEFAULT_PAGE,
    string $method = DEFAULT_METHOD,
    ...$arguments
)
{

    // $name_explode = explode('/', $name);

    $page_exists = function_exists($name);

    if ($page_exists) {

        if (METHOD_POST === $method) {
            $name = getPostMethodNameIfExists($name);
        }

        call_user_func($name);
    }

    return;

}