<?php
require_once('./helpers.php');
require_once('./functions.php');
require_once('./init.php');
require_once('./data.php');

// if (!$con) {
//     die("Ошибка подключения: " . mysqli_connect_error());
// }

// Проверка на отправку формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $required = ['lot-name', 'category', 'lot-img', 'lot-rate', 'lot-step', 'lot-date'];
    $errors = [];

    $rules = [
        'lot-rate' => function ($value) {
            return;
        },
        'lot-step' => function ($value) {
            return;
        },
        'lot-date' => function ($value) {
            return;
        }
    ];

    $lot = filter_input_array(INPUT_POST, ['lot-rate' => FILTER_DEFAULT, 'lot-step' => FILTER_DEFAULT, 'lot-date' => FILTER_DEFAULT], true);

    foreach ($lot as $key => $value) {
        print($lot);
    };

    $lot = $_POST;
    $filename = uniqid() . '.gif';
    $lot['path'] = $filename;
    move_uploaded_file($_FILES['lot-img']['tmp_name'], 'uploads/' . $filename);


    // $title = $lot['lot-name'];
    // $lot_description = $lot['message'];
    // $target_file = '123';
    // $start_price = $lot['lot-rate'];
    // $date_finish = $lot['lot-date'];
    // $step = $lot['lot-step'];
    // $category_id = $lot['category'];

    $sql = "INSERT INTO lots (date_creation, title, lot_description, start_price, date_finish, step, category_id) 
    VALUES (NOW(), ?, ?, ?, ?, ?, ?)";

    $stmt = db_get_prepare_stmt($con, $sql, $lot);
    $res = mysqli_stmt_execute($stmt);

    if ($res) {
        echo "Запись успешно добавлена в базу данных.";
    } else {
        echo "Ошибка при выполнении запроса: " . mysqli_error($con);
        echo "Номер ошибки: " . mysqli_errno($con);
    }

    // Закройте подготовленный запрос
    mysqli_stmt_close($stmt);
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
