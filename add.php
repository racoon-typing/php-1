<?php
require_once('./helpers.php');
require_once('./functions.php');
require_once('./init.php');
require_once('./data.php');


// Получает список категорий
$categories = get_categories($con);


$page_content = include_template(
    'main-add.php',
    [
        'categories' => $categories,
    ]
);
$layout_content = include_template('layout-add.php', [
    'content' => $page_content,
    'categories' => $categories,
    'title' => $lot['title'],
    'is_auth' => $is_auth,
    'user_name' => $user_name
]);


print($layout_content);
