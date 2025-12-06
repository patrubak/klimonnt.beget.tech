<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Поиск данных</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        body {
            background-image: url('../media/fon1.png');
            background-size: cover;
            background-repeat: repeat;
            margin: 0;
            padding: 0;
        }

        #header-img {
            width: 100%;
            position: absolute;
            top: 0;
            left: 0;
        }

        a.button-link {
            display: block;
            position: absolute;
            right: 0;
            bottom: 2cm;
        }

        img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <a href="../main.php">
        <img src="../media/shapka2.png" alt="Шапка" id="header-img">
    </a>
    <a href="../main.php" class="button-link">
        <img src="../media/NaGlav2.png" alt="Вернуться на главную">
    </a>
    <h1>Поиск данных</h1>
    <form action="search_results.php" method="post">
        <label for="criteria">Критерий поиска:</label>
        <select name="criteria">
            <!-- Опции для выбора критерия -->
        </select>
        <input type="text" name="query" placeholder="Введите запрос">
        <button type="submit">Искать</button>
    </form>
</body>
</html>