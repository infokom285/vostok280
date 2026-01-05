<?php
echo "<h2>Информация о клиенте</h2>";

// URL, с которого клиент пришел
echo "URL, с которого клиент пришел: " . ($_SERVER['HTTP_REFERER'] ?? 'Неизвестно') . "<br>";

// IP-адрес клиента
echo "IP-адрес клиента: " . $_SERVER['REMOTE_ADDR'] . "<br>";

// Имя хоста клиента
echo "Имя хоста клиента: " . gethostbyaddr($_SERVER['REMOTE_ADDR']) . "<br>";

// Имя сервера
echo "Имя сервера: " . $_SERVER['SERVER_NAME'] . "<br>";

// Информация о браузере клиента
echo "Информация о браузере клиента: " . $_SERVER['HTTP_USER_AGENT'] . "<br>";

// Метод запроса
echo "Метод запроса: " . $_SERVER['REQUEST_METHOD'] . "<br>";

// URI запроса
echo "URI запроса: " . $_SERVER['REQUEST_URI'] . "<br>";

// Информация о порте сервера
echo "Порт сервера: " . $_SERVER['SERVER_PORT'] . "<br>";

// Дата и время запроса
echo "Дата и время запроса: " . date('Y-m-d H:i:s') . "<br>";

// Cookie клиента
echo "<h3>Cookie клиента</h3>";
if (!empty($_COOKIE)) {
    foreach ($_COOKIE as $key => $value) {
        echo "Ключ: $key; Значение: $value<br>";
    }
} else {
    echo "Нет cookies.<br>";
}

// Запросы GET
echo "<h3>GET параметры</h3>";
if (!empty($_GET)) {
    foreach ($_GET as $key => $value) {
        echo "Ключ: $key; Значение: $value<br>";
    }
} else {
    echo "Нет GET параметров.<br>";
}

// Запросы POST
echo "<h3>POST параметры</h3>";
if (!empty($_POST)) {
    foreach ($_POST as $key => $value) {
        echo "Ключ: $key; Значение: $value<br>";
    }
} else {
    echo "Нет POST параметров.<br>";
}
?>
