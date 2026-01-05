<?php
// Имя файла
$filename = "txt/arr.txt";

// Создаем пустой массив
$array0 = [];

// Проверяем, существует ли файл
if (file_exists($filename)) {
    // Читаем файл построчно
    $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    // Обрабатываем каждую строку
    foreach ($lines as $line) {
        // Разделяем строку по запятой и добавляем в массив
        $array0[] = explode('|', trim($line));
    }

    // Вывод JSON для использования в JavaScript
    echo json_encode($array0, JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode([]); // Возвращаем пустой массив, если файл не найден
}
?>
