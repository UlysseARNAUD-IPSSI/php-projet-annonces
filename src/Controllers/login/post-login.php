<?php

declare(strict_types=1);

function postLogin()
{
    extract($_POST);

    if (true === empty($email)) $email = '';
    if (true === empty($password)) $password = '';

    $errors = [];

    if (false === checkIfPasswordValid($email, $password)) {
        $errors['password'] = trim("
        Mot de passe invalide.
        ");
    }

    if ([] !== $errors) {
        return viewInPages('login', array_merge([
            'errors' => $errors
        ], $_POST));
    }

    $userId = getUserIdByEmail($email);

    connectUser($userId);

    header('Location:/mon-profil');

}