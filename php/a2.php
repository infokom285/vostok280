<?php
// Указать путь к файлу
$filePath = 'aaa.txt';

// Проверяем, существует ли файл
if (!file_exists($filePath)) {
    die("Файл $filePath не найден.");
}

// Читаем содержимое файла
$fileContent = file_get_contents($filePath);

if ($fileContent === false) {
    die("Не удалось прочитать файл $filePath.");
}

echo "Содержимое файла до изменения:\n$fileContent\n";

// Изменяем содержимое
$modifiedContent = $fileContent . "\nИзменено: " . date('Y-m-d H:i:s');

// Записываем новое содержимое обратно в файл
$result = file_put_contents($filePath, $modifiedContent);

if ($result === false) {
    die("Не удалось записать данные в файл $filePath.");
}

echo "Файл успешно обновлен.\n";
?>
