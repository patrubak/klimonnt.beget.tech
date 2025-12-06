<?php
session_start();
require_once 'db_connect.php';

try {
    $pdo->beginTransaction();

    $contract_number = filter_input(INPUT_POST, 'contract_number', FILTER_SANITIZE_STRING);
    $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING);

    // Проверяем наличие дубликатов
    $stmt_check = $pdo->prepare("SELECT count(*) FROM contracts WHERE contract_number=:number");
    $stmt_check->execute(['number' => $contract_number]);
    $count = $stmt_check->fetchColumn();

    if ($count > 0) {
        throw new Exception("Такой договор уже существует!");
    }

    // Вставка нового договора
    $stmt_add = $pdo->prepare("INSERT INTO contracts(contract_number, date) VALUES(:number, :date)");
    $stmt_add->execute(['number' => $contract_number, 'date' => $date]);

    $pdo->commit();
    header("Location: data_entry.php"); // перенаправляем обратно на страницу ввода
    exit();
} catch(Exception $e) {
    $pdo->rollBack();
    $_SESSION['error_message'] = $e->getMessage();
    header("Location: data_entry.php");
    exit();
}