<?php

declare(strict_types=1);

function updateColumnsByParameters(
    PDO $database,
    string $table,
    array $columns,
    array $parameters
)
{
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = [];
    $query[] = "UPDATE $table";

    $cursor = -1;
    $parametersValues = [];
    foreach ($columns as $name => $value) {
        $isValueNull = null === $value;

        if (false === $isValueNull) {
            $value = $database->quote($value);
        }

        if (true === $isValueNull) {
            $value = 'NULL';
        }

        $colummnsBeforeString[] =
            $name . '=' . $value;

    }

    $columnsAsString =
        'SET '
        . implode(', ', $colummnsBeforeString);

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

    $countParameters = count($parameters);
    $parametersAsString = '';
    if (0 < $countParameters) {
        $parametersAsString =
            'WHERE ' . implode(' AND ', $queryParameters);
    }

    $query[] = $columnsAsString;
    $query[] = $parametersAsString;

    $queryAsString = implode(' ', $query);

    $query = $database->prepare($queryAsString);
    foreach ($parametersValues as $parameter => $value) {
        $query->bindParam($parameter, $value);
    }

    $query->execute();

    return;
}
