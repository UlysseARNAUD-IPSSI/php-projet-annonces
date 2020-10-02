<?php

declare(strict_types=1);

function login()
{
    $issetPost = issetPost();
    if($issetPost) {
        try {
            postLogin();
        } catch (Exception $e) {
            throw new Exception('Error while loading the login page !');
        }
    }

    return viewInPages('login');
}