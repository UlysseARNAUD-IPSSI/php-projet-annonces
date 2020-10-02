<?php

declare(strict_types=1);

function getAnnonces(
    array $parameters = []
)
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
        $orderBy = [
            ['id', 'DESC']
        ];
        $annonces = getColumnsByParameters($database, 'annonces', $columns, $parameters, $orderBy);

        //$annonces = encodeResponse($annonces);

        return $annonces;

    } catch (Exception $e) {
        throw new Exception('Error while getting annonces !');
    }
}