<?php

declare(strict_types=1);


function database(
    string $host = DB_HOST,
    string $name = DB_NAME,
    string $user = DB_USER,
    string $password = DB_PASSWORD,
    string $charset = PDO_CHARSET_UTF8,
    int $port = DB_PORT
) : ?PDO
{
    try {
        $database = new PDO("mysql:host=$host;dbname=$name;charset=$charset;port=$port", $user, $password) or null;
        return $database;
    } catch (Exception $e) {
        $database = new PDO("mysql:host=$host;charset=$charset;port=$port", $user, $password) or null;
        return $database;
    }
}

function request(
    ?PDO $database,
    string $query
): PDOStatement
{
    if (null === $database) {
        throw new Exception(ERRORS['no-connection-with-database']);
    }

    return $database->query($query);
}

function runMigrations(
    PDO $database
): void
{
    try {
        genericRunDatabase($database, 'migrations' . DIRECTORY_SEPARATOR);
    } catch (PDOException $PDOException) {
    } catch (Exception $PDOException) {
    }
}

function runSeeds(
    PDO $database
): void
{
    try {
        genericRunDatabase($database, 'seeds' . DIRECTORY_SEPARATOR);
    } catch (PDOException $PDOException) {
    } catch (Exception $PDOException) {
    }
}

function migrations(
    PDO $database
): array
{
    return genericGetDatabase($database, 'migrations' . DIRECTORY_SEPARATOR);
}

function seeds(
    PDO $database
): array
{
    return genericGetDatabase($database, 'seeds' . DIRECTORY_SEPARATOR);
}

function genericRunDatabase(
    PDO $database,
    string $path
): void
{

    $path = DATABASE_DIR . $path;

    if (null === $database) {
        throw new Exception(ERRORS['no-connection-with-database']);
    }

    $entries = getEntries($path);

    if (count($entries) > 0) {
        foreach ($entries as &$entry) {
            $file_content = file_get_contents($entry);
            $database->exec(sprintf("USE %s;%s", DB_NAME, $file_content));
        }
    }

}

function genericGetDatabase(
    PDO $database,
    string $path
): array
{
    $entries = [];
    $handle = opendir($path);

    if ($handle) {

        $entry = readdir($handle);
        while (false !== $entry) {
            $parent_repositories_exists = in_array($entry, ['.', '..']);

            if (false === $parent_repositories_exists) {
                array_push($entries, $entry);
            }
        }

        closedir($handle);

    }

    return $entries;
}

function getViewDatabase(
    PDO $database,
    string $of,
    int $fetch_type = PDO::FETCH_ASSOC
): string
{

    $request = null;
    $query = null;
    $return = null;
    $rows = [];

    $user = $_SESSION['user'];

    switch ($of) {

        case 'user-id':
            if (isset($user)) {
                $request = 'SELECT id FROM users WHERE email = ? LIMIT 0,1';
                $query = $database->prepare($request);
                $query->execute([$user]);
                $rows = $query->fetchAll(PDO::FETCH_ASSOC);
            }
            $return = $rows;
            break;

        default:
            $return = viewRequestJSON($database, $of, $fetch_type);

    }

    return json_encode($return);

}

function getInsertionsDatabase(
    PDO $database,
    string $of,
    int $fetch_type = PDO::FETCH_ASSOC,
    array $params = []
): array
{

    $request = null;
    $query = null;
    $rows = [];

    switch ($of) {

        default:
            return insertionRequestJSON($database, $of, $fetch_type, $params);

    }

}

function viewRequestJSON(
    PDO $database,
    string $file,
    int $fetch_type = PDO::FETCH_BOTH,
    array $params = []
): array
{
    return requestJSON($database, 'views', $file, $fetch_type, $params);
}

function insertionRequestJSON(
    PDO $database,
    string $file,
    int $fetch_type = PDO::FETCH_BOTH,
    array $params = []
): array
{
    return requestJSON($database, 'insertions', $file, $fetch_type, $params);
}

function actionRequestJSON(
    PDO $database,
    string $file,
    int $fetch_type = PDO::FETCH_BOTH,
    array $params = []
): array
{
    return requestJSON($database, 'actions', $file, $fetch_type, $params);
}

function requestJSON(
    PDO $database,
    string $type,
    string $file,
    int $fetch_type,
    array $params = []
): array
{
    foreach ($params as $key => $value) {
        addValueToGET($key, $value);
    }

    $file_name = parseCanonicalFilename($file);

    $path = DATABASE_DIR . "$type" . DIRECTORY_SEPARATOR . $file_name . ".php";

    $file_exists = isset($path);

    if ($file_exists) {
        $request = require_once $path;
    }

    $query = $database->query($request) or die(print_r($database->errorInfo(), true));

    if (false !== $query) {
        return utf8ize($query->fetchAll($fetch_type));
    }

    return [];

}

function getEntries($path)
{
    $entries = [];
    storeFilesAsEntriesByPath($path, $entries);
    return $entries;
}

function getFiles(&$entries, &$entry, $path, $file_format = 'sql')
{
    $parent_repositories_exists = in_array($entry, ['.', '..']);

    if (!$parent_repositories_exists) {
        $entry_explode = explode('.', $entry);
        if (end($entry_explode) == $file_format) {
            $entries[] = $path . $entry;
        }
    }
}

/**
 * Use it for json_encode some corrupt UTF-8 chars
 * useful for = malformed utf-8 characters possibly incorrectly encoded by json_encode
 *
 * @param $mixed
 * @return array|string|null
 * @author Irshad Khan (https://stackoverflow.com/a/52641198)
 */
function utf8ize($mixed)
{
    $mixed_is_array = is_array($mixed);
    $mixed_is_string = is_array($mixed);

    if ($mixed_is_array) {
        foreach ($mixed as $key => $value) {
            $mixed[$key] = utf8ize($value);
        }

        return $mixed;
    }

    if ($mixed_is_string) {
        $string_encoded = mb_convert_encoding($mixed, "UTF-8", "UTF-8");
        return $string_encoded;
    }

    return null;
}

function connectDatabase(): ?PDO
{
    return database();
}

function storeFilesAsEntriesByPath(
    string $path,
    array &$entries
)
{
    $handle = opendir($path);
    if ($handle) {
        getFilesFromDirectory($handle, $path, $entries);
        closedir($handle);
    }
}

function getFilesFromDirectory(
    $directory,
    string $path,
    array &$entries
)
{
    $entry = readdir($directory);
    while (false !== $entry) {
        getFiles($entries, $entry, $path);
    }
}

function getDatabase(): PDO
{

    $isset_session = isset($_SESSION);
    if ($isset_session) {
        $isset_database = isset($_SESSION[SESSION_DATABASE]);
        if ($isset_database) {
            $database = $_SESSION[SESSION_DATABASE];
            return $database;
        }

        $exceptionMessage =
            'The database isn\'t connected. You should check if you typed the right informations such as the login'
            . '(and password), or the host.';


        throw new Exception($exceptionMessage);

    }

    // TODO : Trouver une maniere de traiter cette erreur
    // $exceptionMessage = 'You may have no session started.';
    // throw new Exception($exceptionMessage);

}

function issetDatabase()
{
    try {
        $database = getDatabase();
        return isset($database);
    } catch (Exception $e) {
        return false;
    }
}