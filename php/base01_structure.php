<?php
$servername = "localhost"; // Или "localhost"
$username = "root"; // Имя пользователя
$password = "vadi46ER46ER"; // Пароль пользователя
$dbname = "base01"; // Имя базы данных

// Создаем подключение
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверяем подключение
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Получаем структуру базы данных
$query = "SHOW TABLES FROM $dbname";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo "Структура базы данных $dbname:<br>";
    while ($row = $result->fetch_assoc()) {
        $tableName = $row['Tables_in_base01'];
        echo "- Таблица: $tableName<br>";

        // Получаем структуру таблицы
        $queryTable = "DESCRIBE $tableName";
        $resultTable = $conn->query($queryTable);
        if ($resultTable->num_rows > 0) {
            echo "  Структура таблицы $tableName:<br>";
            while ($rowTable = $resultTable->fetch_assoc()) {
                echo "  - {$rowTable['Field']} ({$rowTable['Type']})<br>";
            }
        } else {
            echo "  Нет данных о структуре таблицы $tableName.<br>";
        }
    }
} else {
    echo "База данных $dbname не содержит таблиц.<br>";
}

// Закрываем соединение
$conn->close();
?>
