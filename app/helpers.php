<?php

function formatarNumpat($numpat)
{
    if (strlen($numpat) == 8) {
        $ret = '0' . substr($numpat, 0, 2);
    } else {
        $ret = substr($numpat, 0, 3);
    }
    return $ret . '.' . substr($numpat, -6);
}

function truncateMiddle($string, $maxLength)
{
    // Early exit if no truncation necessary
    if (strlen($string) <= $maxLength) return $string;

    $numRightChars = 2;
    $numLeftChars = $maxLength -2 - $numRightChars; // to accommodate the "..."

    return sprintf("%s..%s", mb_substr($string, 0, $numLeftChars), mb_substr($string, 0 - $numRightChars));
}
