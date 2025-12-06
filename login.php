<?php
session_start();

// Подключаемся к базе данных
require_once 'db.php';

// Получаем данные из формы
$username = $_POST['username'];
$password = $_POST['password'];

// Подготовленный запрос для предотвращения SQL-инъекции
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username); // s означает строку
$stmt->execute();

// Получаем результат
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    
    // Сравниваем открытый текст пароля
    if ($password === $user['password']) {
        // Создаем сессию
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        
        // Переадресация на главную страницу
        header("Location: main.php");
        exit();
    } else {
        echo "Неверный пароль!";
    }
} else {
    echo "Пользователь не найден!";
}

// Закрываем соединение
$conn->close();
?>