<?php
session_start(); // запуск сессии, если нужно
require_once('db_connect.php'); // подключение к базе данных

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        global $pdo; // используем существующее подключение

        // получаем POST-данные
        $titleId = intval($_POST['title_id']); // ID Титула
        $sectionName = strip_tags(trim($_POST['section_name'])); // Название раздела
        $sectionCode = strip_tags(trim($_POST['section_code'])); // Шифр раздела
        $sectionDescription = strip_tags(trim($_POST['section_description'])); // Описание раздела

        // SQL-запрос для вставки данных
        $stmt = $pdo->prepare("INSERT INTO sections (title_id, section_name, section_code, section_description)
                              VALUES (:title_id, :section_name, :section_code, :section_description)");

        // биндинг переменных
        $stmt->bindValue(':title_id', $titleId, PDO::PARAM_INT);
        $stmt->bindValue(':section_name', $sectionName, PDO::PARAM_STR);
        $stmt->bindValue(':section_code', $sectionCode, PDO::PARAM_STR);
        $stmt->bindValue(':section_description', $sectionDescription, PDO::PARAM_STR);

        // выполнение запроса
        if ($stmt->execute()) {
            echo "<p>Раздел успешно добавлен.</p>";
        } else {
            throw new Exception("Ошибка при добавлении раздела.");
        }
    } catch (PDOException | Exception $e) {
        echo "<p>Ошибка: {$e->getMessage()}</p>";
    }

    // переадресация на главную страницу
    header("Refresh:2;url=./main.php");
    exit();
}