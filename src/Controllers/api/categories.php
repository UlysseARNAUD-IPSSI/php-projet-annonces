<?php

declare(strict_types=1);

function categories($mixed = null)
{
    $status_code = 0;
    $message = "Categories received succesfully.";

    if (null === $mixed) {
        /*$status_code = -1;
        $message = 'No comment id given';
        $response = response($status_code, $message);
        echo $response;
        return;*/

        try {
            $categories = getCategories();
            $response = response($status_code, $message, $categories);
            echo $response;
            return;
        } catch (Exception $e) {
            throw new Exception('Error while getting categories !');
        }
    }

    $argumentIsId = is_numeric($mixed);

    $id = (string)$mixed;

    try {
        $category = getCategoryById($id);
    } catch (Exception $e) {
        throw new Exception('Error while getting the category by id !');
    }

    if ('""' == $category) {
        $status_code = -1;
        $message = 'No categories exists.';
        $response = response($status_code, $message);
        echo $response;
        return;
    }

    $response = response($status_code, $message, $category);

    echo $response;

    // return $response;
}