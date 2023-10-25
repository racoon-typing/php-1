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


function get_query_list_good()
{
    return "SELECT lots.title, lots.start_price, lots.img, lots.date_finish, categories.name_category FROM lots 
    JOIN categories ON lots.category_id = categories.id 
    WHERE lots.date_finish < NOW()
    ORDER BY date_creation DESC LIMIT 6";
};

// Запрос для получения списка товаров через mysqli_prepare
// $sql_get_goods = "SELECT * FROM lots"
//     . " JOIN categories ON lots.category_id = categories.id"
//     . " ORDER BY date_creation DESC LIMIT ?";
// $stmt_goods = mysqli_prepare($con, $sql_get_goods);
// $limit_goods = 6;
// mysqli_stmt_bind_param($stmt_goods, 'i', $limit_goods);
// mysqli_stmt_execute($stmt_goods);
// $result_goods = mysqli_stmt_get_result($stmt_goods);
// $goods = mysqli_fetch_all($result_goods, MYSQLI_ASSOC); 
