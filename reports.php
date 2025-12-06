<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Главная страница</title>
    <style>
        body {
            background-image: url('../media/fon1.png');
            background-size: cover; /* масштабирует картинку по размеру окна */
            background-repeat: repeat; /* предотвращает повторение фона */
            margin: 0;
            padding: 0;
        }

        #header-img { /* Шапка сайта */
            width: 100%;
        }

        a.button-link {
            display: block;
            position: absolute;
            right: 0;
            bottom: 2cm; /* отступ 2 см снизу */
        }

        img {
            max-width: 100%; /* ограничиваем ширину изображения */
            height: auto;   /* сохраняем соотношения сторон */
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
    <?php
        // Здесь можно добавить PHP-код
        echo "Здесь будут отчеты когда-нибудь";
    ?>
</body>
</html>