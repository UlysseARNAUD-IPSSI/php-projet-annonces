<?php

declare(strict_types=1);

function comments(
    ...$args
)
{
    $status_code = 0;
    $message = "Comments received succesfully.";

    $countArgs = count($args);
    if (0 < $countArgs) {
        $firstArg = $args[0];

        if ('user' === $firstArg) {
            try {

                $issetSecondArg = isset($args[1]);
                if (true === $issetSecondArg) {
                    $secondArg = $args[1];
                    $commentsId = getCommentsIdByUserId($secondArg);
                    $response = response($status_code, $message, $commentsId);
                    echo $response;
                    return;
                }

                $postsComments = getPostsComments();
                $response = response($status_code, $message, $postsComments);
                echo $response;
                return;
            } catch (Exception $e) {
                throw new Exception('Error while getting posts authors !');
            }
        }
    }


    if (1 > $countArgs) {
        /*$status_code = -1;
        $message = 'No comment id given';
        $response = response($status_code, $message);
        echo $response;
        return;*/

        try {
            $comments = getComments();
            $response = response($status_code, $message, $comments);
            echo $response;
            return;
        } catch (Exception $e) {
            throw new Exception('Error while getting comments !');
        }
    }

    $argumentIsId = is_numeric($firstArg);

    $id = (string)$firstArg;

    try {
        $comment = getCommentById($id);
    } catch (Exception $e) {
        throw new Exception('Error while getting the comment by id !');
    }

    if ('""' == $comment) {
        $status_code = -1;
        $message = 'No comments exists.';
        $response = response($status_code, $message);
        echo $response;
        return;
    }

    $response = response($status_code, $message, $comment);

    echo $response;

    // return $response;
}