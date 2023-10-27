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
    $title = $_POST['lot-name'];
    $lot_description = $_POST['message'];
    $target_file = '123';
    $start_price = $_POST['lot-rate'];
    $date_finish = $_POST['lot-date'];
    $step = $_POST['lot-step'];
    $category_id = $_POST['category'];

    $sql = "INSERT INTO lots (date_creation, title, lot_description, start_price, date_finish, step, category_id) 
    VALUES (NOW(), ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'ssisii', $title, $lot_description, $start_price, $date_finish, $step, $category_id);

        if (mysqli_stmt_execute($stmt)) {
            echo "Запись успешно добавлена в базу данных.";
        } else {
            echo "Ошибка при выполнении запроса: " . mysqli_error($con);
            echo "Номер ошибки: " . mysqli_errno($con);
        }

        // Закройте подготовленный запрос
        mysqli_stmt_close($stmt);
    } else {
        echo "Ошибка при создании подготовленного запроса: " . mysqli_error($con);
    }
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
