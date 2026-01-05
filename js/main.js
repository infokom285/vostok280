// поиск по трем признакам
// 004 **************************************************************************

function searchProduct() {
    // Получаем значение из поля ввода, приводим к нижнему регистру и удаляем лишние пробелы
    var input = document.getElementById('searchInput').value.toLowerCase().trim();

    // Находим все элементы с классом .text (например, названия товаров)
    var textContainers = document.querySelectorAll('.text');

    // Находим все элементы с классом .text1 (например, дополнительные описания товаров)
    var text1Containers = document.querySelectorAll('.text1');

    // Находим все контейнеры товаров (например, блоки с товарами)
    var containerElements = document.querySelectorAll('.box');

    // Разделяем введенный текст на отдельные слова и удаляем пустые строки
    var words = input.split(' ').filter(Boolean);

    // Массив для хранения индексов контейнеров, которые соответствуют поисковому запросу
    var matchedIndexes = [];

    // Находим контейнер, куда будем добавлять найденные товары
    var dynamicContainer = document.getElementById('dynamicContainer');

    // Находим контейнер для кнопок с номерами найденных товаров
    var numberRow = document.getElementById('numberRow');

    // Очищаем контейнеры перед добавлением новых данных
    dynamicContainer.innerHTML = ''; 
    numberRow.innerHTML = '';

    // Если поле ввода пустое, сбрасываем стили и выходим из функции
    if (words.length === 0) {
        textContainers.forEach(el => el.style.backgroundColor = '');
        text1Containers.forEach(el => el.style.backgroundColor = '');
        return;
    }

    // Перебираем все элементы с классом .text
    textContainers.forEach((textContainer, index) => {
        // Получаем текст из текущего элемента .text и приводим к нижнему регистру
        var text = textContainer.innerText.toLowerCase();

        // Получаем текст из соответствующего элемента .text1 (если он есть)
        var text1 = text1Containers[index]?.innerText.toLowerCase() || "";

        // Объединяем тексты из .text и .text1 для поиска по всем данным
        var combinedText = text + " " + text1;

        // Проверяем, содержит ли объединенный текст все слова из поискового запроса
        var matches = words.every(word => combinedText.includes(word));

        // Если все слова найдены в тексте
        if (matches) {
            // Подсвечиваем фон элементов .text и .text1
            textContainer.style.backgroundColor = 'yellow';
            if (text1Containers[index]) {
                text1Containers[index].style.backgroundColor = 'yellow';
            }

            // Добавляем индекс контейнера в массив найденных
            matchedIndexes.push(index);

            // Создаем кнопку с номером контейнера
            var button = document.createElement("button");
            button.textContent = index + 1; // Нумерация с 1
            button.dataset.index = index; // Сохраняем индекс контейнера в data-атрибуте
            button.style.padding = "5px 10px";
            button.style.margin = "5px";
            button.style.border = "1px solid #ccc";
            button.style.borderRadius = "5px";
            button.style.cursor = "pointer";

            // Добавляем обработчик клика на кнопку
            button.onclick = function() {
                scrollToContainer(this.dataset.index); // Прокрутка к контейнеру
            };

            // Добавляем кнопку в контейнер numberRow
            numberRow.appendChild(button);

			// Клонирование и добавление контейнеров убрано
            // var clonedContainer = containerElements[index].cloneNode(true);
            // clonedContainer.style.backgroundColor = '#f0f0f0';
            // dynamicContainer.appendChild(clonedContainer);
        } else {
            // Если совпадений нет, сбрасываем подсветку
            textContainer.style.backgroundColor = '';
            if (text1Containers[index]) {
                text1Containers[index].style.backgroundColor = '';
            }
        }
    });

    // Если найдены совпадения, автоматически прокручиваем к первому найденному контейнеру
    if (matchedIndexes.length > 0) {
        scrollToContainer(matchedIndexes[0]);
    }
}

// Функция для прокрутки к найденному контейнеру
function scrollToContainer(index) {
    var container = document.querySelectorAll('.box')[index];
    if (container) {
        container.scrollIntoView({ behavior: "smooth", block: "center" });
    }
}

// Добавляем стили для `numberRow`
document.addEventListener("DOMContentLoaded", function () {
    let numberRow = document.getElementById('numberRow');
    numberRow.style.display = "flex";
    numberRow.style.flexWrap = "wrap";
    numberRow.style.justifyContent = "center";
    numberRow.style.padding = "10px";
    numberRow.style.border = "1px solid #ddd";
    numberRow.style.background = "#fafafa";
});

function createNumberButtons(indexes) {
    var numberRow = document.getElementById('searchResults');
    numberRow.innerHTML = ''; // Очищаем предыдущие кнопки

    indexes.forEach(function(index) {
        var button = document.createElement('button');
        button.className = 'number-button';
        button.textContent = index + 1; // Нумерация контейнеров с 1
        button.onclick = function() {scrollToContainer(index);};
        numberRow.appendChild(button);
    });
}

// 005 **************************************************************************
function saveAndNavigate(event, url, containerNumber) {
    event.preventDefault(); // Предотвращаем стандартное поведение ссылки

    // Сохраняем текущее состояние контейнера
    let container = document.getElementById('container').innerHTML;
    localStorage.setItem('containerState', container);

    // Сохраняем номер контейнера в localStorage
    localStorage.setItem('containerNumber', containerNumber);

    // Переход на новую страницу
    window.location.href = url;
}

// Проверка состояния при загрузке страницы
window.onload = function() {
    // Восстанавливаем состояние контейнера
    if (localStorage.getItem('containerState')) {
        document.getElementById('container').innerHTML = localStorage.getItem('containerState');
        localStorage.removeItem('containerState'); // Очищаем состояние после восстановления
    }

    // Восстанавливаем номер контейнера
    if (localStorage.getItem('containerNumber')) {

        localStorage.removeItem('containerNumber'); // Очищаем номер контейнера после восстановления

     }
}
