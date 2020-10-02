<?php

declare(strict_types=1);

function annonces(
    ...$args
)
{
    $status_code = 0;
    $message = "Annonces received succesfully.";

    $countArgs = count($args);
    if (0 < $countArgs) {
        $firstArg = $args[0];

        $argumentIsId = is_numeric($firstArg);

        $id = (string)$firstArg;

        if (false === $argumentIsId) {
            throw new Exception('Error while getting the annonce by id : the id given is not a number!');
        }

        $annonces = null;

        $isIdNumeric = is_numeric($id);

        try {
            $isIdValid =
                -1 !== (int)$id
                && true === $isIdNumeric;

            if (true === $isIdValid) {
                $annonce = getAnnonceById($id);
                $response = response($status_code, $message, $annonce);
                echo $response;
                return;
            }
        } catch (Exception $e) {
            throw new Exception('Error while getting the annonce by id !');
        }

        $isAnnoncesEmpty =
            '""' === $annonces
            && null === $annonces;

        if (true === $isAnnoncesEmpty) {
            $status_code = -1;
            $message = 'No annonce exists.';
            $response = response($status_code, $message);
            echo $response;
            return;
        }

        $response = response($status_code, $message, $annonces);

        echo $response;
    }

    if (1 > $countArgs) {
        /*$status_code = -1;
        $message = 'No annonce id given';
        $response = response($status_code, $message);
        echo $response;
        return;*/

        try {
            $annonces = getAnnonces();
            $response = response($status_code, $message, $annonces);
            echo $response;
            return;
        } catch (Exception $e) {
            throw new Exception('Error while getting annonces !');
        }
    }

    $annonces = null;
    $response = response($status_code, $message, $annonces);
    echo $response;

    // return $response;
}