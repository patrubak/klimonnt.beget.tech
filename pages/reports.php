<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавление договора</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-container label {
            display: block;
            margin-bottom: 5px;
        }

        .form-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-container button {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #0056b3;
        }

        .success-message {
            text-align: center;
            color: green;
            font-weight: bold;
            margin-top: 20px;
        }

        .error-message {
            text-align: center;
            color: red;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Добавление договора</h2>
        <form action="" method="post">
            <label for="contract_number">Номер договора:</label>
            <input type="text" id="contract_number" name="contract_number" required>
            <label for="start_date">Дата подписания договора:</label>
            <input type="date" id="start_date" name="start_date" required>
            <button type="submit">Сохранить</button>
        </form>
        <?php
        if (isset($_POST['contract_number']) && isset($_POST['start_date'])) {
            // Подключение к базе данных через файл db.php
            require_once 'db.php';

            // Проверка подключения к базе данных
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $contract_number = $_POST['contract_number'];
            $start_date = $_POST['start_date'];

            // Проверка, существует ли уже такой договор
            $check_sql = "SELECT * FROM contracts WHERE contract_number = '$contract_number'";
            $result = $conn->query($check_sql);

            if ($result->num_rows > 0) {
                echo '<div class="error-message">Такой договор уже существует</div>';
            } else {
                // SQL-запрос для вставки данных
                $sql = "INSERT INTO contracts (contract_number, start_date) VALUES ('$contract_number', '$start_date')";

                if ($conn->query($sql) === TRUE) {
                    echo '<div class="success-message">В базу добавлено</div>';
                } else {
                    echo "Ошибка: " . $sql . "<br>" . $conn->error;
                }
            }

            // Закрытие подключения
            $conn->close();
        }
        ?>
    </div>
</body>
</html>