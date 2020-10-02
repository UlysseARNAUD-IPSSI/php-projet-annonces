<?php

declare(strict_types=1);

function images(
    $mixed = null
)
{
    $status_code = 0;
    $message = "Images received succesfully.";

    if (null === $mixed) {
        $status_code = -1;
        $message = 'No image id given';
        $response = response($status_code, $message);
        echo $response;
        return;
    }

    $argument_is_id = is_numeric($mixed);

    $id = (string)$mixed;

    if (false === $argument_is_id) {
        try {
            $id = getImageIdByCanonicalName($id);
            $id = decodeResponse($id);

            if (false === $id) {
                $status_code = -1;
                $message = 'No image exists.';
                $response = response($status_code, $message);
                echo $response;
                return;
            }

            $id = $id->id;
        } catch (Exception $e) {
            throw new Exception('Error while getting the image\'s id by canonical name !');
        }
    }

    try {
        $image = getImageValueById($id);
    } catch (Exception $e) {
        throw new Exception('Error while getting the image by id !');
    }

    if ('""' == $image) {
        $status_code = -1;
        $message = 'No image exists.';
        $response = response($status_code, $message);
        echo $response;
        return;
    }

    $response = response($status_code, $message, $image);

    echo $response;

    // return $response;
}