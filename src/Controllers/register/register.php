<?php

declare(strict_types=1);

function register()
{

    $issetPost = issetPost();

    if ($issetPost) {
        try {
            postRegister();
        } catch (Exception $e) {
            print_r($e->getTrace());
            throw new Exception('Error while load postRegister !');
        }
    }

    $view_name = 'register';
    $view = viewInPages($view_name);
    return $view;
}