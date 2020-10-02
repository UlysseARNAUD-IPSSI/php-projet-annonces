<?php

declare(strict_types=1);

function logout(): void
{
    $isAuthentified = isAuthentified();
    if ($isAuthentified) {

        try {
            disconnectUser();
        } catch (Exception $e) {
            throw new Exception('Error while disconnecting the user !');
        }

        $url = '/';
        $header = 'Location: ' . $url;
        header($header);

    }

    $url = '/login';
    $header = 'Location: ' . $url;
    header($header);
}