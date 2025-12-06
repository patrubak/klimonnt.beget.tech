<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-image: url('media/fon1.png');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body>
    <img src="media/shapka2.png" alt="Шапка" style="width: 100%;">
    <script src="script.js"></script>
    <div class="login-container">
        <h2>Авторизация</h2>
        <form id="login-form" action="login.php" method="post">
            <label for="username">Логин:</label><br>
            <input type="text" id="username" name="username"><br>
            <label for="password">Пароль:</label><br>
            <input type="password" id="password" name="password"><br>
            <button type="submit">Войти</button>
        </form>
    </div>
</body>
</html>