<?php
// Параметры подключения к базе данных MySQL
$servername = "localhost";
$username = "root";
$password = "vadi46ER46ER";
$dbname = "base01";

header('Content-Type: text/html; charset=utf-8');

// Имя текстового файла, который вы хотите импортировать
$txtfile = "table01.txt";

// Параметр для выбора режима работы: очистка или добавление
$clearTable = true; // true для очистки таблицы перед вставкой, false для добавления записей

// Создание подключения к базе данных
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Соединение установлено<br>";
}

// Установим кодировку соединения
$conn->set_charset("utf8mb4");

// Очистка таблицы, если установлен параметр $clearTable
if ($clearTable) {
    $sqlClear = "TRUNCATE TABLE table01";
    if ($conn->query($sqlClear) !== TRUE) {
        echo "Error clearing table: " . $conn->error;
    } else {
        echo "Таблица очищена<br>";
    }
}

// Открытие текстового файла
if (($handle = fopen($txtfile, "r")) !== FALSE) {
    // Чтение строк из текстового файла и запись в базу данных
    $row = 0;
    
    while (($line = fgets($handle)) !== FALSE && $row < 392) {
        // Удаляем BOM из первой строки, если он присутствует
        if ($row == 0 && substr($line, 0, 3) === "\xEF\xBB\xBF") {
            $line = substr($line, 3);
        }
        
        // Разбиение строки на части
        $part1 = $conn->real_escape_string(mb_substr($line, 0, 10, 'UTF-8'));   // Первые 10 символов
        $part2 = $conn->real_escape_string(mb_substr($line, 10, 10, 'UTF-8'));  // Следующие 10 символов
        $part3 = $conn->real_escape_string(mb_substr($line, 20, 10, 'UTF-8'));  // Следующие 10 символов
        $part4 = $conn->real_escape_string(mb_substr($line, 40, 30, 'UTF-8'));  // Следующие 30 символов
        $part5 = $conn->real_escape_string(mb_substr($line, 60, 180, 'UTF-8')); // Следующие 180 символов
        $part6 = $conn->real_escape_string(mb_substr($line, 30, 10, 'UTF-8'));  // Следующие 10 символов

        // Вывод значений для диагностики
        echo "Данные вставлены успешно $part1<br>";
        echo "Данные вставлены успешно $part2<br>";
        echo "Данные вставлены успешно $part3<br>";
        echo "Данные вставлены успешно $part4<br>";
        echo "Данные вставлены успешно $part5<br>";
        echo "Данные вставлены успешно $part6<br>";

        // Подготовка SQL запроса для вставки данных
        $sql = "INSERT INTO table01 (c03, c04, c06, c08, img, price) VALUES ('$part1', '$part5', '$part2', '$part3', '$part4', '$part6')";

        // Выполнение SQL-запроса
        if ($conn->query($sql) !== TRUE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        } else {
            echo "Данные вставлены успешно<br>";
        }

        $row++;
    }
    // Закрытие текстового файла
    fclose($handle);
} else {
    echo "Не удалось открыть текстовый файл.";
}

// Закрытие соединения с базой данных
$conn->close();
?>
