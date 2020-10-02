<?php

function postRegister()
{

    extract($_POST);

    // dd([$email, $pseudo, $email, $phone, $password, $confirmation_password]);

    if (true === empty($email)) $email = '';
    if (true === empty($pseudo)) $pseudo = '';
    if (true === empty($phone)) $phone = '';
    if (true === empty($password)) $password = '';
    if (true === empty($confirmation_password)) $confirmation_password = '';

    $errors = [];

    $isEmailValid = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (false === $isEmailValid) {
        $errors['email'] = trim("
        Le format de l'adresse mail n'a pas été respecté.
        ");
    }

    $isPseudoValid = 3 < strlen($pseudo) && 65 > strlen($pseudo);
    if (false === $isPseudoValid) {
        $errors['pseudo'] = trim("
        Le format du pseudo n'a pas été respecté :
        <ul>
        <li>Longueur entre 4 et 64 caractères inclus</li>
        </ul>
        ");
    }

    // $isPhoneValid = preg_match("/^[0-9]{10,}$/", $phone);
    $isPhoneValid = 10 === strlen($phone);

    if (false === $isPhoneValid) {
        $errors['phone'] = trim("
        Le format du téléphone n'a pas été respecté :
        <ul>
        <li>Format du type 0123456789</li>
        </ul>
        ");
    }

    // TODO: ne fonctionne pas :/
    // $isPasswordValid = preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]$/', $password);
    $isPasswordValid = 3 < strlen($password) && 257 > strlen($password);

    if (false === $isPasswordValid) {
        $errors['password'] = trim("
        Le format du mot de passe n'a pas été respecté :
        <ul>
        <li>Il doit contenir une lettre majuscule, un chiffre et un caractère spécial (@#$%^&+=).</li>
        <li>Entre 4 et 256 caractères attendues (inclus).</li>
        </ul>
        ");
    }

    $arePasswordSame = true === $isPasswordValid && $password == $confirmation_password;

    if (false === $arePasswordSame) {
        $errors['confirmation_password'] = trim("
        Les mots de passe ne sont pas identiques.
        ");
    }

    if (true === checkIfUserExists($email)) {
        $errors['email'] = trim("
        Cette adresse mail est déjà utilisée !
        ");
    }

    if ([] !== $errors) {
        return viewInPages('register', array_merge([
            'errors' => $errors
        ], $_POST));
    }
    saveUser($email, $pseudo, $phone, $password);

    header('Location:/login');

}