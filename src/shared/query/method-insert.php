<?php

declare(strict_types=1);

function insert(
    PDO $database,
    string $table,
    array $columns
)
{

    // $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $columnsNames = array_keys($columns);
    $columnsValues = array_values($columns);

    foreach ($columnsNames as $index => $columnName) {
        // $columnName = $database ->quote($columnName);
        $columnsNames[$index] = $columnName;
    }

    $columnsNamesAsString = implode(',', $columnsNames);
    $columnsNamesAsString = '(' . $columnsNamesAsString . ')';

    foreach ($columnsValues as $index => $columnValue) {
        $isColumnValueString = is_string($columnValue);

        if (true === $isColumnValueString) {
            $columnValue = $database->quote($columnValue);
        }

        $columnsValues[$index] = $columnValue;
    }

    $columnsValuesAsString = implode(',', $columnsValues);
    $columnsValuesAsString = '(' . $columnsValuesAsString . ')';

    // $table = $database->quote($table);

    $queryString = "INSERT INTO $table ";
    $queryString .= $columnsNamesAsString;
    $queryString .= ' VALUES ';
    $queryString .= $columnsValuesAsString;
    $queryString .= ';';

    $query = $database->prepare($queryString);

    $query->execute();

    // dd($query);

    return;
}
