<?php
// Путь к текстовому файлу
$file_path = 'txt/name.txt';

// Проверяем, существует ли файл
if (!file_exists($file_path)) {
    die("Файл не найден!");
}

// Устанавливаем заголовки для скачивания файла
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($file_path));

// Отправляем содержимое файла в ответе
readfile($file_path);
exit;
?>
