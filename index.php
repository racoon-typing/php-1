<?php
require_once('./helpers.php');
require_once('./functions.php');
require_once('./init.php');
require_once('./data.php');


if (!$con) {
    $error = mysqli_connect_error();
} else {
    // Запрос для получения списка категорий
    $sql_get_categories = "SELECT character_code, name_category FROM categories";
    $result_categories = mysqli_query($con, $sql_get_categories);

    if ($result_categories) {
        $categories = mysqli_fetch_all($result_categories, MYSQLI_ASSOC);
    } else {
        $error = mysqli_error($con);
    }
}

// Запрос для получения списка товаров
$sql_get_goods = get_query_list_good();
$result_goods  = mysqli_query($con, $sql_get_goods);
if ($result_goods) {
    $goods = mysqli_fetch_all($result_goods, MYSQLI_ASSOC);
} else {
    $error = mysqli_error($con);
}

$page_body = include_template(
    'main.php',
    [
        'categories' => $categories,
        'goods' => $goods
    ]
);
$layout_content = include_template(
    'layout.php',
    [
        'main' => $page_body,
        'title' => $title,
        'is_auth' => $is_auth,
        'user_name' => $user_name,
        'categories' => $categories,
    ]
);

print($layout_content);
