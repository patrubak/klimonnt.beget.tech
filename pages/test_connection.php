<?php
require_once __DIR__.'/vendor/autoload.php';

use Aws\S3\S3Client;

// Загрузка конфигурации
$config = require_once __DIR__.'/config.php';

try {
    $client = new S3Client($config);
    $result = $client->doesBucketExist('<7e627810f344-elevated-matilda>');

    if ($result) {
        echo json_encode(['message' => 'Подключение успешно.', 'status' => 'ok']);
    } else {
        echo json_encode(['message' => 'Указанный bucket не найден.', 'status' => 'error']);
    }
} catch (\Aws\Exception\S3Exception $e) {
    error_log('Ошибка подключения: ' . $e->getMessage());
    echo json_encode(['message' => 'Ошибка подключения: ' . $e->getMessage(), 'status' => 'error']);
}
?>