<?php

declare(strict_types=1);

function annonces(...$args)
{
    if (3 === count($args)) {
        $type = $args[2];
        if ('create' === $type) {
            return createAnnonce();
        }
    }

    if (4 === count($args)) {
        $isPost = 'POST' === $args[3];
        if (true === $isPost) {
            $type = $args[2];
            if ('create' === $type) {
                return postCreateAnnonce();
            }
        }

        $id = $args[2];
        $type = $args[3];

        switch ($type) {
            case 'read':
                return readAnnonce($id);
                break;
            case 'edit':
                return editAnnonce($id);
                break;
            case 'delete':
                return _deleteAnnonce($id);
                break;
            default:
                break;
        }

    }

    if (5 === count($args)) {
        $isPost = 'POST' === $args[4];

        if (false === $isPost) {
            header('Location:/');
        }

        $id = $args[2];
        $type = $args[3];

        switch ($type) {
            case 'edit':
                return postEditAnnonce($id);
                break;
            default:
                break;
        }

    }

    return viewInAdmin('annonces');
}

function createAnnonce()
{
    return viewInAdmin('create-annonces');
}

function readAnnonce(string $id)
{
    $annonce = getAnnonceById($id);
    return viewInAdmin('read-annonces');
}

function editAnnonce(string $id)
{
    $annonce = getAnnonceById($id);
    return viewInAdmin('edit-annonces', [
        'annonce' => $annonce
    ]);
}

function postCreateAnnonce()
{
    extract($_POST);

    // dd([$title, $description, $price, $ends_at]);

    if (true === empty($title)) $title = '';
    if (true === empty($description)) $description = '';
    if (true === empty($price)) $description = '';
    if (true === empty($ends_at)) $ends_at = '';

    $errors = [];

    $isTitleValid = 2 < strlen($title) && 65 > strlen($title);
    if (false === $isTitleValid) {
        $errors['title'] = trim("
        Le format du titre n'a pas été respecté :
        <ul>
        <li>Longueur entre 3 et 64 caractères inclus</li>
        </ul>
        ");
    }

    $isDescriptionValid = 7 < strlen($description) && 1028 > strlen($description);
    if (false === $isDescriptionValid) {
        $errors['description'] = trim("
        Le format de la description n'a pas été respecté :
        <ul>
        <li>Longueur entre 8 et 1028 caractères inclus</li>
        </ul>
        ");
    }

    $isPriceValid =
        is_numeric($price)
        && (int)$price > 0 && (int)$price < 1000;

    if (false === $isPriceValid) {
        $errors['price'] = trim("
        Le format du prix n'a pas été respecté :
        <ul>
        <li>Valeur numérique attendue</li>
        <li>Prix entre 0 et 1000 euros exclus</li>
        </ul>
        ");
    }

    // TODO : Ends at validator
    $isEndsAtValid =
        preg_match('/^(?:\d{4}-\d{2}-\d{2}T\d{2}:\d{2})$/', $ends_at);

    if (false === $isEndsAtValid) {
        $errors['ends_at'] = trim("
        Le format du titre n'a pas été respecté :
        <ul>
        <li>Format de date YYYY-MM-DDTHH:MM</li>
        </ul>
        ");
    }

    $now = new DateTime('now');
    $ends_at = new DateTime($ends_at);
    $isEndsAtValidInDate = $ends_at > $now;

    if (false === $isEndsAtValidInDate) {
        $now = $now->format('d/m/Y H:m');
        $errors['ends_at'] = trim("
        Mettez une date supérieur à $now.
        ");
    }

    if ([] !== $errors) {
        return viewInAdmin('create-annonces', array_merge([
            'errors' => $errors
        ], $_POST));
    }

    saveAnnonce($title, $description, $price, $ends_at->format('Y-m-d H:m:s'));

    header('Location:/admin/annonces');
}

function postEditAnnonce($id)
{
    extract($_POST);

    // dd([$title, $description, $price, $ends_at]);

    if (true === empty($title)) $title = '';
    if (true === empty($description)) $description = '';
    if (true === empty($price)) $description = '';
    if (true === empty($ends_at)) $ends_at = '';

    $errors = [];

    $isTitleValid = 2 < strlen($title) && 65 > strlen($title);
    if (false === $isTitleValid) {
        $errors['title'] = trim("
        Le format du titre n'a pas été respecté :
        <ul>
        <li>Longueur entre 3 et 64 caractères inclus</li>
        </ul>
        ");
    }

    $isDescriptionValid = 7 < strlen($description) && 1028 > strlen($description);
    if (false === $isDescriptionValid) {
        $errors['description'] = trim("
        Le format de la description n'a pas été respecté :
        <ul>
        <li>Longueur entre 8 et 1028 caractères inclus</li>
        </ul>
        ");
    }

    $isPriceValid =
        is_numeric($price)
        && (int)$price > 0 && (int)$price < 1000;

    if (false === $isPriceValid) {
        $errors['price'] = trim("
        Le format du prix n'a pas été respecté :
        <ul>
        <li>Valeur numérique attendue</li>
        <li>Prix entre 0 et 1000 euros exclus</li>
        </ul>
        ");
    }

    // TODO : Ends at validator
    $isEndsAtValid =
        preg_match('/^(?:\d{4}-\d{2}-\d{2}T\d{2}:\d{2})$/', $ends_at);

    if (false === $isEndsAtValid) {
        $errors['ends_at'] = trim("
        Le format du titre n'a pas été respecté :
        <ul>
        <li>Format de date YYYY-MM-DDTHH:MM</li>
        </ul>
        ");
    }

    $now = new DateTime('now');
    $ends_at = new DateTime($ends_at);
    $dateLimit = new DateTime('January 19, 2038'); // A cause du probleme de l'an 2038
    $isEndsAtValidInDate = $ends_at > $now && $ends_at < $dateLimit;

    if (false === $isEndsAtValidInDate) {
        $now = $now->format('d/m/Y H:m');
        $dateLimit = $dateLimit->format('d/m/Y H:m');
        $errors['ends_at'] = trim("
        Mettez une date supérieur à $now et inferieur à $dateLimit.
        ");
    }

    if ([] !== $errors) {
        return viewInAdmin('create-annonces', array_merge([
            'errors' => $errors
        ], $_POST));
    }
    updateAnnonce(connectDatabase(), $id, [
        'title' => $title,
        'description' => $description,
        'price' => $price,
        'ends_at' => $ends_at->format('Y-m-d H:m:s'),
    ]);

    header('Location:/admin/annonces');
}

function _deleteAnnonce($id) {
    deleteAnnonce($id);
    header('Location: /admin/annonces');
}