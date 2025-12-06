<?php
require 'db_connect.php'; // Подключение к базе данных
require 'cloud_storage.php'; // Подключение к облаку

// Настройки подключения к облаку Beget
$endpoint = 'https://s3.ru1.storage.beget.cloud';
$accessKey = '1UDUNNGTLNAU9KSLG6K5';
$secretKey = 'EfvL8Y3d1JtSbINpBWSOjEk0emHAQq6Z8qAYxohf';
$bucket = '7e627810f344-elevated-matilda';

// Создаем объект для работы с облаком
$cloudStorage = new CloudStorage($endpoint, $accessKey, $secretKey, $bucket);

// Обработка формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем данные из формы
    $title_id = filter_var($_POST['title_id'], FILTER_SANITIZE_NUMBER_INT);
    $section_code = filter_var($_POST['section_code'], FILTER_SANITIZE_STRING);
    $sheet_number = filter_var($_POST['sheet_number'], FILTER_SANITIZE_STRING);
    $sheet_name = filter_var($_POST['sheet_name'], FILTER_SANITIZE_STRING);
    $change_sheet = filter_var($_POST['change_sheet'], FILTER_SANITIZE_STRING);
    $invoice_and_date = filter_var($_POST['invoice_and_date'], FILTER_SANITIZE_STRING);
    $status = filter_var($_POST['status'], FILTER_SANITIZE_STRING);
    $selected_folder = filter_var($_POST['selected_folder'], FILTER_SANITIZE_STRING); // Выбранная папка

    // Загрузка файла в облако
    if (isset($_FILES['cloud_link']) && $_FILES['cloud_link']['error'] === UPLOAD_ERR_OK) {
        $filePath = $_FILES['cloud_link']['tmp_name'];
        $fileName = basename($_FILES['cloud_link']['name']);

        try {
            $cloudLink = $cloudStorage->uploadFile($selected_folder, $filePath, $fileName);
            echo "Файл успешно загружен: " . $cloudLink;

            // Вставка данных в базу данных
            $sql = "INSERT INTO rd_lists (title_id, section_code, sheet_number, sheet_name, change_sheet, invoice_and_date, status, cloud_link) 
                    VALUES (:title_id, :section_code, :sheet_number, :sheet_name, :change_sheet, :invoice_and_date, :status, :cloud_link)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'title_id' => $title_id,
                'section_code' => $section_code,
                'sheet_number' => $sheet_number,
                'sheet_name' => $sheet_name,
                'change_sheet' => $change_sheet,
                'invoice_and_date' => $invoice_and_date,
                'status' => $status,
                'cloud_link' => $cloudLink
            ]);

            echo "Данные успешно добавлены в базу данных.";
        } catch (Exception $e) {
            echo "Ошибка: " . $e->getMessage();
        }
    } else {
        echo "Ошибка при загрузке файла.";
    }
} else {
    echo "Метод не поддерживается.";
}