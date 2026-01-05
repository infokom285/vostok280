
// Заполнение массивов
k=0
for (var i = 0; i < array0.length; i += 3) {
	k=k+1
    array0[i] = array0[i] + '{' + k + '}'
    array.push(array0[i]);     // Элементы 1, 4, 7, 10, ...
    array2.push(array0[i + 1]); // Элементы 2, 5, 8, 11, ...
    array1.push(array0[i + 2]); // Элементы 3, 6, 9, 12, ...
}

//var n;

// Освобождение памяти, удаление array0
array0 = null; // Или можно использовать delete array0, но это не рекомендуется

