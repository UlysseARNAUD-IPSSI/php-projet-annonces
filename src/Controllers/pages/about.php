<?php

declare(strict_types=1);

function about()
{
    $view_name = 'about';
    $view = viewInPages($view_name);
    return $view;
}