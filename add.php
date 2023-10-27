<?php
require_once('./helpers.php');
require_once('./functions.php');
require_once('./init.php');
require_once('./data.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input_values = $_POST;
    $title = $input_values['lot-name'];
    $category_id = $input_values['category'];
    $lot_description = $input_values['message'];
    $start_price = $input_values['lot-rate'];
    $step = $input_values['lot-step'];
    $date_finish = $input_values['lot-date'];


    $sql = "INSERT INTO lots (`id`, date_creation`, `title`, `lot_description`, `img`, `start_price`, `date_finish`, `step`, `user_id`, `winner_id`, `category_id`)
    VALUES (?, NOW(), ?, ?, ?, ?, ?, ?, ?, ?, ?)";
};

// Получает список категорий
$categories = get_categories($con);


$page_content = include_template(
    'main-add.php',
    [
        'categories' => $categories,
    ]
);
$layout_content = include_template(
    'layout-add.php',
    [
        'content' => $page_content,
        'categories' => $categories,
        'title' => $lot['title'],
        'is_auth' => $is_auth,
        'user_name' => $user_name
    ]
);


print($layout_content);


