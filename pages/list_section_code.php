<?php
require_once 'db_connect.php'; // Подключение к базе данных

global $pdo;
$stmt = $pdo->prepare("SELECT section_code FROM sections");
$stmt->execute();

while ($row = $stmt->fetch()) {
    echo "<option value='{$row['section_code']}'>{$row['section_code']}</option>";
}
?>