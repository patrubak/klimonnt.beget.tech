<?php
// db.php

// Параметры подключения к базе данных
$servername = "localhost";
$username = "klimonnt_admin";
$password = "7TOMx%9&FdCv";
$dbname = "klimonnt_admin";

// Создание подключения
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>