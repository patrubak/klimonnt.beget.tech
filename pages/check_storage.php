<?php
// Включаем автозагрузчик Composer для AWS SDK
require __DIR__ . '/vendor/autoload.php';

use Aws\S3\S3Client;

// Конфигурация подключения к Beget Cloud Storage
$config = [
    'endpoint'   => 'https://s3.ru1.storage.beget.cloud', // Адрес точки входа
    'region'     => 'us-east-1',                         // Регион (может зависеть от вашего выбора)
    'version'    => 'latest',                           // Версия API
    'credentials'=> [
        'key'    => '1UDUNNGTLNAU9KSLG6K5',             // Ваш Access Key ID
        'secret' => 'EfvL8Y3d1JtSbINpBWSOjEk0emHAQq6Z8qAYxohf', // Ваш Secret Access Key
    ],
    'bucket'    => '7e627810f344-elevated-matilda',     // Название бака (container/bucket)
];

// Создаем клиента для работы с хранилищем
$s3 = new S3Client([
    'endpoint'       => $config['endpoint'],              // Адрес точки входа
    'region'         => $config['region'],               // Регион размещения
    'version'        => $config['version'],              // Версия API
    'credentials'    => $config['credentials'],          // Данные для аутентификации
]);

// Выполняем запрос на получение списка объектов в бакете
try {
    $result = $s3->listObjectsV2(['Bucket' => $config['bucket']]); // Получаем список объектов

    if (!empty($result['Contents'])) {
        echo "<pre>\n";                                  // Начало блока preformatted текста
        foreach ($result['Contents'] as $object) {
            echo "Объект: {$object['Key']} | Размер: {$object['Size']} байт\n";
        }
        echo "</pre>\n";                                 // Завершение блока preformatted текста
    } else {
        echo "Нет объектов в данном бакете.";
    }
} catch (\Aws\Exception\SdkException $e) {
    die("Ошибка подключения к хранилищу: " . $e->getMessage()); // Сообщение об ошибке
}