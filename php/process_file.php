<?php
echo "<p>n1: 1 </p>";
// Глобальные переменные
global $n1, $n2, $n3, $n4, $n5;

$n1 = '';
$n2 = '';
$n3 = '';
$n4 = '';
$n5 = '';
echo "<p>n1: 2 </p>";
// Функция для обработки содержимого файла
function processFileContent($content) {
    global $n1, $n2, $n3, $n4, $n5;

    $n1 = substr($content, 0, 10);
    $n2 = substr($content, 10, 10);
    $n3 = substr($content, 20, 10);
    $n4 = substr($content, 30, 10);
    $n5 = substr($content, 40, 10);

    echo "<p>n1: $n1</p>";
    echo "<p>n2: $n2</p>";
    echo "<p>n3: $n3</p>";
    echo "<p>n4: $n4</p>";
    echo "<p>n5: $n5</p>";
}

// Загрузка и обработка файла ttt.txt
$filePath = 'ttt.txt';

if (file_exists($filePath)) {
    $content = file_get_contents($filePath);
    processFileContent($content);
} else {
    echo "Файл ttt.txt не найден.";
}
?>
