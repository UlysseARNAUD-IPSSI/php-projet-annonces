<?php

declare(strict_types=1);

function getAnnonceById(string $id)
{
    $database = connectDatabase();

    try {
        $columns = [
            'id',
            'title',
            'description',
            'price',
            'ends_at',
            'created_at',
            'updated_at'
        ];

        $parameters = [
            ['id', $id]
        ];

        $annonce = getColumnsByParameters($database, 'annonces', $columns, $parameters);

        if (!$annonce) {
            $annonce = '';
        }

        // $annonce = encodeResponse($annonce);

        return $annonce[0];

    } catch (Exception $e) {
        throw new Exception('Error while getting the annonce by id !');
    }
}
