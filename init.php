<?php
// Конфигурационный файл соединения
$connect_config = [
    'host' => 'localhost',
    'name' => 'root',
    'password' => 'root',
    'db_name' => 'yeticave',
];

$con = mysqli_connect($connect_config['host'], $connect_config['name'], $connect_config['password'], $connect_config['db_name']);
mysqli_set_charset($con, 'utf8');
