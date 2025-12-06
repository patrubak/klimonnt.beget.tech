<?php
require_once 'db_connect.php';

try {
    global $pdo; // Предположим, что объект PDO объявлен глобально в db_connect.php
    
    // Запрос на получение всех титулов
    $stmt = $pdo->prepare("SELECT id, title_name FROM titles");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result as $row) {
        echo "<option value='" . $row["id"] . "'>" . $row["title_name"] . "</option>";
    }
} catch (PDOException $e) {
    echo "Ошибка подключения: " . $e->getMessage();
}
?>