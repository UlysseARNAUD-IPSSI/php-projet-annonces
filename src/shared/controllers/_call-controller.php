<?php

declare(strict_types=1);

function callControllerMethod(
    string $name,
    string $method,
    ...$methodArgs
)
{

    $isAvailable = checkIfControllerIsAvailable($name);

    if ($isAvailable) {
        $controllerAvailableIndex = $isAvailable - 1;
        $controllerAvailable = CONTROLLERS_AVAILABLE[$controllerAvailableIndex];

        $controllerPath = getControllerPath($controllerAvailable);

        // dd($controllerPath);

        require_once $controllerPath;

        // dd(['controller path' => $controllerPath]);

        $beforeExists = function_exists('before');

        if ($beforeExists) {
            before();
        }

        $afterExists = function_exists('after');

        if ($afterExists) {
            after();
        }

        $parsedMethod = parseMethodName($method);

        $controllerMethodExists = function_exists($parsedMethod);

        $methodArgsIsArray = false;
        $numberMethodArgs = count($methodArgs);
        if (2 > $numberMethodArgs) {
            $methodArgsIsArray = is_array(...$methodArgs);
        }

        if ($methodArgsIsArray) {
            $methodArgs = $methodArgs[0];
        }

        $isSetPost = issetPost();

        if ($isSetPost) {
            $methodArgs[] = METHOD_POST;
        }

        if ($controllerMethodExists) {
            call_user_func($parsedMethod, ...$methodArgs);
        }

    }

}

function checkIfControllerIsAvailable(
    string $name
)
{
    $parsedName = parseToRegex($name);
    $flags = 'i';
    $pattern = "/$parsedName/$flags";

    foreach (CONTROLLERS_AVAILABLE as $index => $controller) {

        if (preg_match($pattern, $controller)) {
            return $index + 1;
        }

    }

    return false;
}
