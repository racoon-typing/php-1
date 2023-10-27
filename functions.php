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


/**
 * Возвращает массив из объекта результатов запроса
 * @param object $result_query mysqli Результат запроса к базе данных
 * @return array
 */
function get_arrow($result_query)
{
    $row = mysqli_num_rows($result_query);

    if ($row === 1) {
        $arrow = mysqli_fetch_assoc($result_query);
    } else if ($row > 1) {
        $arrow = mysqli_fetch_all($result_query, MYSQLI_ASSOC);
    }

    return $arrow;
};


// Получает SQL запрос на получение списка товаров
function get_query_list_good()
{
    return "SELECT lots.id, lots.title, lots.start_price, lots.img, lots.date_finish, categories.name_category FROM lots 
    JOIN categories ON lots.category_id = categories.id 
    WHERE lots.date_finish < NOW()
    ORDER BY date_creation DESC LIMIT 6";
};


// Получает SQL запрос на получение лота по $id
function get_query_lot($id_lot)
{
    return "SELECT * FROM lots 
    JOIN categories ON lots.category_id = categories.id 
    WHERE lots.id =" .  $id_lot;
}


// Получает список товаров
function get_goods($con)
{
    if (!$con) {
        $error = mysqli_connect_error();
        return $error;
    } else {
        $sql_get_goods = get_query_list_good();
        $result_goods = mysqli_query($con, $sql_get_goods);

        if ($result_goods) {
            $goods = mysqli_fetch_all($result_goods, MYSQLI_ASSOC);
            return $goods;
        } else {
            $error = mysqli_error($con);
            return $error;
        }
    }
};

// Получает список категорий
function get_categories($con)
{
    if (!$con) {
        $error = mysqli_connect_error();
        return $error;
    } else {
        // Запрос для получения списка категорий
        $sql_get_categories = "SELECT character_code, name_category FROM categories";
        $result_categories = mysqli_query($con, $sql_get_categories);

        if ($result_categories) {
            $categories = mysqli_fetch_all($result_categories, MYSQLI_ASSOC);
            return $categories;
        } else {
            $error = mysqli_error($con);
            return $error;
        }
    }
};
