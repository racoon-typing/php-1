<?php
function format_num($price)
{
    $result = ceil($price);

    if ($price > 1000) {
        $result = number_format($result, 0, '', ' ');
    }

    return $result . " " . "₽";
};


/**
 * Возвращает кол-во целых часов и остаток минут от настоящего времени до даты 
 * @param string $date Дата истечения времени
 * @return array
 */
function get_time_left($date)
{
    date_default_timezone_set('Europe/Moscow');
    $final_date = date_create($date);
    $cur_date = date_create();

    $diff = date_diff($final_date, $cur_date);
    $format_diff = date_interval_format($diff, '%d %H %I');
    $arr = explode(" ", $format_diff);

    $hours = $arr[0] * 24 + $arr[1];
    $minutes = intval($arr[2]);

    $hours = str_pad($hours, 2, "0", STR_PAD_LEFT);
    $minutes = str_pad($minutes, 2, "0", STR_PAD_LEFT);

    $res[] = $hours;
    $res[] = $minutes;

    return $res;
};


function get_query_list_good() {

};

