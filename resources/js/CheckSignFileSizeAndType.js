function checkFileSizeAndType() {
    var FS = document.getElementById("sign-image-file");
    var file = FS.files[0]; // Получаем только первый файл
    var errorMessage = document.getElementById('error-message');

    // Условие, если выбран файл
    if (file) {
        // Проверка типа файла
        const allowedTypes = [/*'image/jpeg',*/ 'image/png', 'image/gif'];
        if (!allowedTypes.includes(file.type)) {
            errorMessage.textContent = 'Пожалуйста, выберите файл с допустимым типом: .jpg, .jpeg, .png, .gif';
            errorMessage.style.display = 'block';
            FS.setCustomValidity("Неправильный тип файла");
            FS.value = ''; // Сбрасываем выбор файла
            return;
        } else {
            errorMessage.style.display = 'none'; // Скрываем сообщение об ошибке
        }

        // Проверка размера файла
        if (file.size > 2 * 1024 * 1024) { // Проверяем размер файла (2 MB)
            FS.setCustomValidity("Размер файла не должен превышать 2 MB");
            return;
        }
    }

    // Если нарушений ограничений нет
    FS.setCustomValidity("");
}


