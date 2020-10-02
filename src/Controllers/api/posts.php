<?php

declare(strict_types=1);

function posts(
    ...$args
)
{
    $status_code = 0;
    $message = "Posts received succesfully.";

    $countArgs = count($args);
    if (0 < $countArgs) {
        $firstArg = $args[0];

        if ('authors' === $firstArg) {
            try {

                $issetSecondArg = isset($args[1]);
                if (true === $issetSecondArg) {
                    $secondArg = $args[1];
                    $postsUsers = getPostsUserByUserId($secondArg);
                    $response = response($status_code, $message, $postsUsers);
                    echo $response;
                    return;
                }

                $postsUsers = getPostsUsers();
                $response = response($status_code, $message, $postsUsers);
                echo $response;
                return;
            } catch (Exception $e) {
                throw new Exception('Error while getting posts authors !');
            }
        }

        if ('comments' === $firstArg) {
            try {

                $issetSecondArg = isset($args[1]);
                if (true === $issetSecondArg) {
                    $secondArg = $args[1];
                    $postComment = getCommentsIdByPostId($secondArg);
                    $response = response($status_code, $message, $postComment);
                    echo $response;
                    return;
                }

                $postsUsers = getPostsComments();
                $response = response($status_code, $message, $postsUsers);
                echo $response;
                return;
            } catch (Exception $e) {
                throw new Exception('Error while getting posts comments !');
            }
        }

        if ('images' === $firstArg) {
            try {

                $issetSecondArg = isset($args[1]);
                if (true === $issetSecondArg) {
                    $secondArg = $args[1];
                    $postImage = getPostImageByPostId($secondArg);
                    $response = response($status_code, $message, $postImage);
                    echo $response;
                    return;
                }

                $postsImages = getPostsImages();
                $response = response($status_code, $message, $postsImages);
                echo $response;
                return;
            } catch (Exception $e) {
                throw new Exception('Error while getting posts images !');
            }
        }

        $argumentIsId = is_numeric($firstArg);

        $id = (string)$firstArg;

        if (false === $argumentIsId) {
            try {
                $id = getPostIdByTagName($id);

                if (false === $id) {
                    $status_code = -1;
                    $message = 'No post exists.';
                    $response = response($status_code, $message);
                    echo $response;
                    return;
                }

            } catch (Exception $e) {
                throw new Exception('Error while getting the post id by tag name !');
            }
        }

        $posts = null;

        $isIdNumeric = is_numeric($id);

        try {
            $isIdValid =
                -1 !== (int)$id
                && true === $isIdNumeric;

            if (true === $isIdValid) {
                $post = getPostById($id);
                $response = response($status_code, $message, $post);
                echo $response;
                return;
            }
        } catch (Exception $e) {
            throw new Exception('Error while getting the post by id !');
        }

        $isPostsEmpty =
            '""' === $posts
            && null === $posts;

        if (true === $isPostsEmpty) {
            $status_code = -1;
            $message = 'No post exists.';
            $response = response($status_code, $message);
            echo $response;
            return;
        }

        $response = response($status_code, $message, $posts);

        echo $response;
    }

    if (1 > $countArgs) {
        /*$status_code = -1;
        $message = 'No post id given';
        $response = response($status_code, $message);
        echo $response;
        return;*/

        try {
            $posts = getPosts();
            $response = response($status_code, $message, $posts);
            echo $response;
            return;
        } catch (Exception $e) {
            throw new Exception('Error while getting posts !');
        }
    }

    $posts = null;
    $response = response($status_code, $message, $posts);
    echo $response;

    // return $response;
}