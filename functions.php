<?php
function format_num($price)
{
    $result = ceil($price);

    if ($price > 1000) {
        $result = number_format($result, 0, '', ' ');
    }

    return $result . " " . "₽";
};