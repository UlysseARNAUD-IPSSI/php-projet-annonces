<?php

declare(strict_types=1);

function addValueToSession(string $key, string $value)
{
    $_SESSION[$key] = $value;
}

function startSession()
{
    session_start();
}

function safeStartSession()
{
    abortIfSessionIsStart();
    startSession();
}

function sessionIsStart()
{
    $session_status = session_status();
    $session_is_start = PHP_SESSION_ACTIVE === $session_status;
    return $session_is_start;
}

function abortSession()
{
    session_abort();
}

function abortIfSessionIsStart()
{
    $session_is_start = sessionIsStart();

    if ($session_is_start) {
        abortSession();
    }
}

function getSessionValue(string $name): ?string
{
    $issetSession = issetSession();

    if (false === $issetSession) {
        return null;
    }

    $value = $_SESSION[$name];
    return $value;
}

function issetSessionValue(string $name): bool
{
    $isset = isset($_SESSION[$name]);
    return $isset;
}

function issetSession(): bool
{
    $isset = isset($_SESSION);
    return $isset;
}