<?php
$dsn = 'mysql:host=localhost;dbname=klimonnt_structu;charset=utf8mb4';
$user = 'klimonnt_structu';
$passwd = '7TOMx%9&FdCv';

try {
    $pdo = new PDO($dsn, $user, $passwd);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Подключение к базе данных невозможно: " . $e->getMessage());
}