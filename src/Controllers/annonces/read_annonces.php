<?php

declare(strict_types=1);

function read_annonces(string $id)
{
    return viewInAnnonces('read', [
        'annonce' => getAnnonceById($id)
    ]);
}