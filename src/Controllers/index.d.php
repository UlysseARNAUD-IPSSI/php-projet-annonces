<?php

declare(strict_types=1);

require_once MODELS_DIR . 'index.d.php';

try {
    disconnectUserIfTokenInDatabaseIsNull();
} catch (Exception $e) {
    throw new Exception('Error while disconnecting the user if token in database is null !');
}