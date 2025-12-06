<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<title>Ввод данных</title>
<style>
body {
    background-image: url('../media/vlm_01/fon_beton.png');
    background-size: cover;
    margin: 0;
    padding: 0;
}

header {
    width: 100%;
    position: relative;
}

.current-time {
    position: absolute;
    top: 10px;
    left: 35px;
    color: white;
    font-size: 16px;
    z-index: 1000;
}

.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.4);
}

.modal-content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

.success-message {
    color: green;
    font-weight: bold;
    text-align: center;
}

.button-link img {
    max-width: 5%;
}

.button-link {
    position: relative;
    top: -200px;
}

.return-home-btn {
    position: absolute;
    bottom: 1cm;
    right: 0;
}
</style>
</head>
<body>
<!-- Шапка сайта -->
<header>
    <a href="../main.php">
        <img src="../media/vlm_01/shapka_16.png" alt="Шапка сайта" style="width: 100%;">
    </a>
    <!-- Текущее время -->
    <div class="current-time" id="currentTime"></div>
</header>

<!-- Основной контент -->
<main>
    <!-- Кнопки для открытия всплывающих окон -->
    <a href="#" id="openContractModalBtn" class="button-link">
        <img src="../media/vlm_01/knp_cntrct_n.png" alt="Добавить договор">
    </a>
    <a href="#" id="openTitleModalBtn" class="button-link">
        <img src="../media/vlm_01/knp_ttl_n.png" alt="Добавить титул">
    </a>
    <a href="#" id="openSectionModalBtn" class="button-link">
        <img src="../media/vlm_01/knp_rzdl_n.png" alt="Добавить раздел">
    </a>
    <a href="#" id="openRdListModalBtn" class="button-link">
        <img src="../media/vlm_01/knp_lst_n.png" alt="Добавить лист РД">
    </a>
    
    <!-- Новая кнопка для теста подключения -->
    <a href="test_connection.php" id="testConnectionBtn" class="button-link">
        <img src="../media/ver.3/knp_test1.png" alt="Тестирование подключения">
    </a>

    <!-- Модальное окно для добавления договора -->
    <div id="contractModal" class="modal">
        <div class="modal-content">
            <span class="close">×</span>
            <h2>Добавить договор</h2>
            <form action="add_contract.php" method="post">
                <label for="contract_number">Номер договора:</label><br>
                <input type="text" id="contract_number" name="contract_number" required><br>
                <label for="date">Дата заключения:</label><br>
                <input type="date" id="date" name="date" required><br>
                <button type="submit">Добавить договор</button>
            </form>
        </div>
    </div>

    <!-- Модальное окно для добавления титула -->
    <div id="titleModal" class="modal">
        <div class="modal-content">
            <span class="close">×</span>
            <h2>Добавить титул</h2>
            <form action="add_title.php" method="post">
                <label for="contract_id">Выберите договор:</label><br>
                <select name="contract_id" required>
                    <option value="">-- Выберите договор --</option>
                    <?php include 'list_contracts.php'; ?>
                </select><br>
                <label for="title_name">Название титула:</label><br>
                <input type="text" id="title_name" name="title_name" required><br>
                <label for="title_description">Краткое описание титула:</label><br>
                <textarea id="title_description" name="title_description" rows="4" cols="50" required></textarea><br>
                <label for="title_detailed_desc">Подробное описание титула:</label><br>
                <textarea id="title_detailed_desc" name="title_detailed_desc" rows="4" cols="50"></textarea><br>
                <button type="submit">Добавить титул</button>
            </form>
        </div>
    </div>

    <!-- Модальное окно для добавления раздела -->
    <div id="sectionModal" class="modal">
        <div class="modal-content">
            <span class="close">×</span>
            <h2>Добавить раздел</h2>
            <form action="add_section.php" method="post">
                <label for="title_id">Титул:</label><br>
                <select name="title_id" required>
                    <option value="">-- Выберите титул --</option>
                    <?php include 'list_titles.php'; ?>
                </select><br>
                <label for="section_name">Название раздела:</label><br>
                <input type="text" id="section_name" name="section_name" required><br>
                <label for="section_code">Шифр раздела:</label><br>
                <input type="text" id="section_code" name="section_code" required><br>
                <label for="section_description">Описание раздела:</label><br>
                <textarea id="section_description" name="section_description" rows="4" cols="50"></textarea><br>
                <button type="submit">Добавить раздел</button>
            </form>
        </div>
</div>

<!-- Модальное окно для добавления листа РД -->
<div id="rdListModal" class="modal">
    <div class="modal-content">
        <span class="close">×</span>
        <h2>Добавить лист РД</h2>
        <form action="add_rd.php" method="post" enctype="multipart/form-data">
            <label for="title_id">Титул:</label><br>
            <select name="title_id" required>
                <option value="">-- Выберите титул --</option>
                <?php include 'list_titles.php'; ?>
            </select><br>
            <label for="section_code">Шифр раздела:</label><br>
            <select name="section_code" required>
                <option value="">-- Выберите шифр раздела --</option>
                <?php include 'list_section_code.php'; ?>
            </select><br>
            <label for="sheet_number">№ листа:</label><br>
            <input type="text" id="sheet_number" name="sheet_number" required><br>
            <label for="sheet_name">Название листа из штампа:</label><br>
            <input type="text" id="sheet_name" name="sheet_name" required><br>
            <label for="change_sheet">Изм. листа:</label><br>
            <input type="text" id="change_sheet" name="change_sheet"><br>
            <label for="invoice_and_date">№ Накладной и дата:</label><br>
            <input type="text" id="invoice_and_date" name="invoice_and_date"><br>
            <label for="status">Статус:</label><br>
            <select name="status" required>
                <option value="актуально">Актуально</option>
                <option value="не актуально">Не актуально</option>
                <option value="аннулировано">Аннулировано</option>
            </select><br>
            <label for="cloud_link">Файл для загрузки:</label><br>
            <input type="file" id="cloud_link" name="cloud_link"><br>
            <label for="folder_select">Выберите папку:</label><br>
            <select name="folder_select" id="folder_select" required>
                <option value="">-- Выберите папку --</option>
                <?php include 'list_folders.php'; ?>
            </select><br>
            <button type="submit">Добавить лист РД</button>
        </form>
    </div>
</div>
</main>

<!-- Кнопка для возврата на главную страницу -->
<a href="../main.php" class="button-link return-home-btn">
    <img src="../media/vlm_01/naglav_n.png" alt="Вернуться на главную">
</a>

<!-- Скрипт для обновления времени -->
<script>
function updateCurrentTime() {
    const now = new Date();
    let hours = now.getHours().toString().padStart(2, '0');
    let minutes = now.getMinutes().toString().padStart(2, '0');
    let seconds = now.getSeconds().toString().padStart(2, '0');
    document.getElementById('currentTime').innerHTML = `${hours}:${minutes}:${seconds}`;
}

setInterval(updateCurrentTime, 1000); // Обновляем каждые секунды
updateCurrentTime(); // Первоначальная инициализация
</script>

<!-- Скрипты для обработки кнопок -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const modalButtons = [
        { buttonId: 'openContractModalBtn', modalId: 'contractModal' },
        { buttonId: 'openTitleModalBtn', modalId: 'titleModal' },
        { buttonId: 'openSectionModalBtn', modalId: 'sectionModal' },
        { buttonId: 'openRdListModalBtn', modalId: 'rdListModal' },
        { buttonId: 'testConnectionBtn', modalId: '' } // Специальная кнопка для тестирования подключения
    ];

    modalButtons.forEach(buttonInfo => {
        const btn = document.getElementById(buttonInfo.buttonId);
        if (btn) {
            if (buttonInfo.modalId !== '') {
                const modal = document.getElementById(buttonInfo.modalId);
                if (modal) {
                    btn.onclick = function(event) {
                        event.preventDefault();
                        showModal(modal);
                    };

                    modal.querySelector('.close').onclick = function() {
                        hideModal(modal);
                    };
                } else {
                    console.error(`Модальное окно "${buttonInfo.modalId}" не найдено.`);
                }
            } else {
                // Обработчик специальной кнопки
                btn.onclick = function(event) {
                    event.preventDefault();
                    window.location.href = 'test_connection.php';
                };
            }
        } else {
            console.error(`Кнопка "${buttonInfo.buttonId}" не найдена.`);
        }
    });
});

// Функции для показа и скрытия модальных окон
const showModal = modal => {
    modal.style.display = 'block';
};

const hideModal = modal => {
    modal.style.display = 'none';
};
</script>
</body>
</html>