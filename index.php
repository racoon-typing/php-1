<?php
require_once('./helpers.php');
require_once('./functions.php');
require_once('./data.php');


// Конфигурационный файл соединения
$connect_config = [
    'host' => 'localhost',
    'name' => 'root', 
    'password' => 'root', 
    'db_name' => 'yeticave',
];

$con = mysqli_connect($connect_config['host'], $connect_config['name'], $connect_config['password'], $connect_config['db_name']);

// Запрос для получения списка товаров
$sql_get_goods = "SELECT * FROM lots"
    . " JOIN categories ON lots.category_id = categories.id"
    . " ORDER BY date_creation DESC LIMIT 6";
$result_goods  = mysqli_query($con, $sql_get_goods);
$goods = mysqli_fetch_all($result_goods, MYSQLI_ASSOC);

// Запрос для получения списка категорий
$sql_get_categories = "SELECT * FROM categories";
$result_categories = mysqli_query($con, $sql_get_categories);
$categories = mysqli_fetch_all($result_categories, MYSQLI_ASSOC);


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
