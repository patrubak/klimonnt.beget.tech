<?php
require_once('./db_connect.php'); // подключение к базе данных

global $pdo; // используем существующее подключение

$stmt = $pdo->prepare("SELECT id, general_name FROM general_section ORDER BY general_name ASC");
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<option value='" . $row['id'] . "'>" . $row['general_name'] . "</option>";
}