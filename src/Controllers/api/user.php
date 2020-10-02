<?php

declare(strict_types=1);

function user(
    ...$args
)
{
    $status_code = 0;
    $message = "Fetching finished successfully";

    $countArgs = count($args);
    $isFirstArgsSets = 0 < $countArgs;

    if (true === $isFirstArgsSets) {
        $firstArg = $args[0];

        $isFirstArgString = is_string($firstArg);
        $isFirstArgNumeric = is_numeric($firstArg);

        $isArgumentInvalid =
            false === $isFirstArgNumeric
            && false === $isFirstArgString;

        $argument = (string)$firstArg;

        if (true === $isFirstArgNumeric) {

            $issetSecondArg = isset($args[1]);
            if (false === $issetSecondArg) {
                $status_code = -1;
                $message = 'Argument invalid';
                $response = response($status_code, $message);
                echo $response;
                return;
            }

            $secondArg = $args[1];

            if ('post' === $secondArg) {
                try {
                    $posts = getPostsUserByUserId($argument);
                    $posts = encodeResponse($posts);
                    $response = response($status_code, $message, $posts);
                    echo $response;
                    return;
                } catch (Exception $e) {
                    throw new Exception('Error while getting user`s post !');
                }
            }

            if ('name' === $secondArg) {
                try {
                    $name = getUserPseudoById($argument);
                    $response = response($status_code, $message, $name);
                    echo $response;
                    return;
                } catch (Exception $e) {
                    throw new Exception('Error while getting user`s name !');
                }
            }

            if ('comments' === $secondArg) {
                try {
                    $posts = getCommentsIdByUserId($argument);
                    $posts = encodeResponse($posts);
                    $response = response($status_code, $message, $posts);
                    echo $response;
                    return;
                } catch (Exception $e) {
                    throw new Exception('Error while getting user\'s comments');
                }
            }
        }

        if (true === $isArgumentInvalid) {
            $status_code = -1;
            $message = 'Argument invalid';
            $response = response($status_code, $message);
            echo $response;
            return;
        }

        if ('post' === $argument) {
            try {
                $posts = getUserPosts();
                $posts = encodeResponse($posts);
                $response = response($status_code, $message, $posts);
                echo $response;
                return;
            } catch (Exception $e) {
                throw new Exception('Error while getting user`s post !');
            }
        }

        if ('name' === $argument) {
            try {
                $name = getUserPseudo();
                $response = response($status_code, $message, $name);
                echo $response;
                return;
            } catch (Exception $e) {
                throw new Exception('Error while getting user`s name !');
            }
        }

        if ('comments' === $argument) {
            try {
                $posts = getUserComments();
                $posts = encodeResponse($posts);
                $response = response($status_code, $message, $posts);
                echo $response;
                return;
            } catch (Exception $e) {
                throw new Exception('Error while getting user\'s comments');
            }
        }
    }

    if (false === $isFirstArgsSets) {
        try {
            $user = getUser();
            $response = response($status_code, $message, $user);
            echo $response;
            return;
        } catch (Exception $e) {
        }
    }

    $status_code = -1;
    $message = 'Argument invalid';
    $response = response($status_code, $message);
    echo $response;
    return;

}