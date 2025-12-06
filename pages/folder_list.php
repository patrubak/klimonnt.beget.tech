<?php
require_once __DIR__.'/vendor/autoload.php';
require_once 'config.php';

use Aws\S3\S3Client;

$s3Client = new S3Client($config);

try {
    // Запрашиваем объекты первого уровня
    $result = $s3Client->listObjectsV2([
        'Bucket' => $config['bucket'],
        'Delimiter' => '/'
    ]);

    foreach ($result['CommonPrefixes'] as $prefix) {
        echo '<option value="' . $prefix['Prefix'] . '">' . rtrim($prefix['Prefix'], '/') . '</option>';
    }
} catch (\Aws\Exception\SdkException $e) {
    die("Ошибка при получении списка папок: " . $e->getMessage());
}