<?php
require_once __DIR__.'/vendor/autoload.php';

use Aws\S3\S3Client;

$config = [
    'endpoint' => 'https://s3.ru1.storage.beget.cloud',
    'version' => 'latest',
    'credentials' => [
        'key' => '<1UDUNNGTLNAU9KSLG6K5>',
        'secret' => '<EfvL8Y3d1JtSbINpBWSOjEk0emHAQq6Z8qAYxohf>'
    ]
];

try {
    $client = new S3Client($config);
    $result = $client->doesBucketExist('<7e627810f344-elevated-matilda>');

    if ($result) {
        echo json_encode(['message' => 'Подключение успешно.', 'status' => 'ok']);
    } else {
        echo json_encode(['message' => 'Указанный bucket не найден.', 'status' => 'error']);
    }
} catch (\Aws\Exception\S3Exception $e) {
    echo json_encode(['message' => 'Ошибка подключения: ' . $e->getMessage(), 'status' => 'error']);
}
?>