<?php
class CloudStorage {
    private $endpoint;
    private $accessKey;
    private $secretKey;
    private $bucket;

    public function __construct($endpoint, $accessKey, $secretKey, $bucket) {
        $this->endpoint = $endpoint;
        $this->accessKey = $accessKey;
        $this->secretKey = $secretKey;
        $this->bucket = $bucket;
    }

    public function getFolders() {
        // Здесь будет код для получения списка папок из Beget
        // Пример использования cURL для работы с API Beget
        $url = $this->endpoint . '/list';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $this->accessKey,
        ]);
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }

    public function uploadFile($folder, $filePath, $fileName) {
        // Здесь будет код для загрузки файла в Beget
        // Пример использования cURL для работы с API Beget
        $url = $this->endpoint . '/upload';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, [
            'folder' => $folder,
            'file' => new CURLFile($filePath),
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $this->accessKey,
        ]);
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }
}