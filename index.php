<?php
require_once('./helpers.php');
require_once('./functions.php');
require_once('./init.php');
require_once('./data.php');


// Получает список категорий
$categories = get_categories($con);

// Получает список товаров
$goods = get_goods($con);


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
        'categories' => $categories,
        'title' => $title,
        'is_auth' => $is_auth,
        'user_name' => $user_name
    ]
);

print($layout_content);
