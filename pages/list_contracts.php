<?php
require_once 'db_connect.php'; // подключаемся к базе данных

$sql = "SELECT id, contract_number FROM contracts ORDER BY contract_number ASC";
$stmt = $pdo->query($sql);
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<option value='{$row['id']}'>{$row['contract_number']}</option>\n";
}
?>