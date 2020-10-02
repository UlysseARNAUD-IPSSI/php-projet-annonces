<?php

declare(strict_types=1);

include VIEWS_DIR . '/partials/_header_pages.php';

// error_reporting(0);

$user = $_SESSION['user'];

if (isset($user)) {
    unset($user);
}


header("Location: /?success=signout");

// error_reporting(E_ERROR | E_WARNING | E_PARSE);
