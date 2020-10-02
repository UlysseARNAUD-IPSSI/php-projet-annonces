<?php

declare(strict_types=1);

function getIdByParameters(
    PDO $database,
    string $table,
    array $parameters
)
{
    $column = 'id';
    try {
        $id = getColumnByParameters(
            $database,
            $table,
            $column,
            $parameters
        );
        return $id;
    } catch (Exception $e) {
        throw new Exception('Error while getting the id.');
    }
}

function getTimestampByParameter(
    PDO $database,
    string $table,
    array $parameters
)
{
    $columns = [
        'created_at', 'updated_at'
    ];
    try {
        $fetch = getColumnsByParameters(
            $database,
            $table,
            $columns,
            $parameters
        );
        return $fetch;
    } catch (Exception $e) {
        throw new Exception('Error while getting the timestamps !');
    }
}

function getTimestampById(
    PDO $database,
    string $table,
    string $value
)
{
    try {
        $timestamp = getTimestampByParameter(
            $database,
            $table,
            [
                ['id', $value]
            ]
        );
        return $timestamp;
    } catch (Exception $e) {
        throw new Exception('Error while getting the timestamps by id !');
    }
}

function getColumnsByParameter(
    PDO $database,
    string $table,
    array $columns,
    string $parameter,
    string $value
)
{
    $parsedColumns = implode(', ', $columns);
    $parameters = [$parameter, $value];
    try {
        $fetch = getColumnByParameters(
            $database,
            $table,
            $parsedColumns,
            $parameters
        );
        return $fetch;
    } catch (Exception $e) {
        throw new Exception('Error while fetching columns !');
    }
}

function getColumnByParameter(
    PDO $database,
    string $table,
    string $column,
    string $parameter,
    string $value
)
{
    $query = "SELECT $column FROM $table WHERE $parameter = :$parameter";

    $database = connectDatabase();
    $query = $database->prepare($query);
    $query_parameters = [":$parameter", $value];
    $query->bindParam(...$query_parameters);
    $query->execute();
    $fetch = $query->fetch(PDO::FETCH_ASSOC);

    return $fetch;
}

function getColumnByParameters(
    PDO $database,
    string $table,
    string $column,
    array $parameters = [],
    array $orderBy = [],
    array $limit = []
): array
{

    $page = getPageFromPOST();

    $isLimitEmpty = [] === $limit;
    if (true === $isLimitEmpty) {
        $limit['from'] = DEFAULT_POST_PAGE + DEFAULT_PAGE_NUMBER_ELEMENTS * $page;
        $limit['to'] = DEFAULT_PAGE_NUMBER_ELEMENTS * ($page + 1);
    }

    $cursor = -1;

    $query = [];
    $query[] = "SELECT $column FROM $table";

    $parameterToParse = '';

    $queryParameters = [];
    $parametersValues = [];

    // Where
    foreach ($parameters as $key => $parameter) {

        $numberElementsArray = count($parameter);

        if (1 > $numberElementsArray) {
            throw new Exception('Parameters invalid.');
        }

        $parameterName = $parameter[0];
        $comparator = $parameter[1];
        // $parameter = null;

        if (2 === $numberElementsArray) {
            $comparator = '=';
            $value = (string)$parameter[1];
            $parameterToParse =
                parseQueryParameter($value, $parametersValues, $cursor);
        }

        if (3 === $numberElementsArray) {
            $comparator = $parameter[1];
            $value = (string)$parameter[2];
            $parameterToParse =
                parseQueryParameter($value, $parametersValues, $cursor);
        }

        if (
            4 === $numberElementsArray
            && '<>' === $parameter[1]
        ) {
            $comparator = 'BETWEEN';

            $value = $parameter[2];
            $from =
                parseQueryParameter($value, $parametersValues, $cursor);

            $value = $parameter[3];
            $to =
                parseQueryParameter($value, $parametersValues, $cursor);

            $parameterToParse = "'$from' AND '$to'";
        }

        $parameterCode = "$parameterName $comparator $parameterToParse";

        $queryParameters[] = $parameterCode;

    }

    $queryAsString = implode(' ', $query);

    $countParameters = count($parameters);
    $parametersAsString = '';
    if (0 < $countParameters) {
        $parametersAsString =
            'WHERE ' . implode(' AND ', $queryParameters);
    }

    // Order by
    $isOrderByEmpty = [] === $orderBy;

    if ($isOrderByEmpty) {
        $orderBy[] = ['id', 'DESC'];
    }

    $parsedOrderBy = [];
    foreach ($orderBy as $orderByElement) {
        $isArray = is_array($orderByElement);
        $isString = is_string($orderByElement);

        if ($isArray) {
            $columnName = $orderByElement[0];
            $order = $orderByElement[1];

            // On peut faire la vérification mais travail supplémentaire
            // inutile [pour le moment].

            $parsedOrderBy[] = "$columnName $order";
        }

        if ($isString) {
            $columnName = $orderByElement[0];

            // On peut faire la vérification mais travail supplémentaire
            // inutile [pour le moment].
        }
    }
    $countOrderBy = count($orderBy);
    $orderByAsString = '';
    if (0 < $countOrderBy) {
        $orderByAsString = 'ORDER BY ' . implode(', ', $parsedOrderBy);
    }

    // Limit
    $limitAsString = 'LIMIT ' . $limit['from'] . ',' . $limit['to'];

    $queryWithParameters = $queryAsString;

    if ([] !== $parameters) {
        $queryWithParameters .= ' ' . $parametersAsString;
    }

    if ([] !== $orderBy) {
        $queryWithParameters .= ' ' . $orderByAsString;
    }

    $queryWithParameters .= ' '. $limitAsString;

    // $queryWithParameters = $queryAsString . ' ' . $parametersAsString . ' ' . $limitAsString;

    $query = $database->prepare($queryWithParameters);
    foreach ($parametersValues as $parameter => $value) {
        $query->bindParam($parameter, $value);
    }
    $query->execute();
    $fetch = $query->fetchAll(PDO::FETCH_OBJ);

    return $fetch;

}

function getColumnsByParameters(
    PDO $database,
    string $table,
    array $columns,
    array $parameters = [],
    array $orderBy = []
)
{
    $columnsAsString = implode(', ', $columns);

    try {
        $fetch = getColumnByParameters(
            $database,
            $table,
            $columnsAsString,
            $parameters,
            $orderBy
        );
        return $fetch;
    } catch (Exception $e) {
        throw new Exception('Error while fetching columns !');
    }
}