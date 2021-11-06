<?php

use Illuminate\Support\Carbon;

/**
 * Formata o número de patrimônio no formato 000.000000
 * 
 * @param Int $numpat - número de patrimonio a ser formatado
 * @return String
 * @author Masaki K Neto, em 11/21
 */
if (!function_exists('formatarNumpat')) {
    function formatarNumpat($numpat)
    {
        if (strlen($numpat) == 8) {
            $prefix = '0' . substr($numpat, 0, 2);
            $postfix = substr($numpat, 2, strlen($numpat) - 1);
        } else {
            $prefix = substr($numpat, 0, 3);
            $postfix = substr($numpat, 3, strlen($numpat) - 1);
        }
        return $prefix . '.' . $postfix;
    }
}

/**
 * Retorna o começo e o fim de $string, com tamanho máximo de $maxLength
 *
 * @param String $string - String a ser trucanda
 * @param Int $maxLength - Tamanho máximo da string de saída
 * @param Int $numRightChars - número de caracteres à direita dos ".."
 * @return String String truncada
 * @author Masaki K Neto, em 11/21
 */
if (!function_exists('truncateMiddle')) {
    function truncateMiddle($string, $maxLength, $numRightChars = 2)
    {
        // Early exit if no truncation necessary
        if (strlen($string) <= $maxLength) {
            return $string;
        }

        $numLeftChars = $maxLength - 2 - $numRightChars; // to accommodate the ".."

        return sprintf("%s..%s", mb_substr($string, 0, $numLeftChars), mb_substr($string, 0 - $numRightChars));
    }
}

/**
 * Retorna string contendo, "hoje", "ontem", ou "há xx dias", em relação à $data
 *
 * @param Carbon $data - data a ser avaliada
 * @return String
 * @author Masaki K Neto, em 11/21
 */
if (!function_exists('dias')) {
    function dias($data)
    {
        $now = Carbon::now();
        $difference = $data->diff($now)->days;
        switch ($difference) {
            case 0:
                return 'hoje';
                break;
            case 1:
                return 'ontem';
                break;
            default:
                return 'há ' . $difference . ' dias';
        }
    }
}
