<?php
session_start(); // Начинаем сессию
require_once 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Проверяем наличие обязательных полей
    if (!empty($_POST['contract_id']) && !empty($_POST['title_name']) && !empty($_POST['title_description'])) {
        try {
            global $pdo; // Используем подключение из db_connect.php
            
            // Получаем значение подробно описания (если не передано, ставим NULL)
            $title_detailed_desc = empty($_POST['title_detailed_desc']) ? null : $_POST['title_detailed_desc'];
            
            // Подготовленный SQL-запрос для вставки нового титула
            $sql = "INSERT INTO titles (contract_id, title_name, title_description, title_detailed_desc)
                    VALUES (:contract_id, :title_name, :title_description, :title_detailed_desc)";
            
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':contract_id', $_POST['contract_id']);
            $stmt->bindParam(':title_name', $_POST['title_name']);
            $stmt->bindParam(':title_description', $_POST['title_description']);
            $stmt->bindValue(':title_detailed_desc', $title_detailed_desc, PDO::PARAM_STR); // Устанавливаем тип параметра
            $stmt->execute();

            // Сообщение об успешном создании титула
            echo '<p class="success-message">Титул успешно добавлен!</p>';
        } catch (PDOException $e) {
            die('Ошибка при добавлении титула: ' . $e->getMessage());
        }
    } else {
        echo '<p class="error-message">Заполнены не все обязательные поля.</p>';
    }
}
?>