## Проверяем версию php

php --version

## Устанавливаем локально Composer

https://getcomposer.org/download/

php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php
php -r "unlink('composer-setup.php');"

## Клонируем все на хостинг

git clone https://github.com/bobpulaski/iul-jet.git .
Ставим точку для копирования в текущую папку

## .htaccess

Создаем в корне проекта на хостинге файл .htaccess

RewriteEngine on
RewriteRule ^$ public/ [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ((?s).\*) public/$1 [L]

## .env и генерация ключа

Командой на хостинге переименовывем файл окружения .env.example
cp .env.example .env
php artisan key:generate

## Меняем переменные окружения

APP_NAME="Конструктор ИУЛ для экспертизы онлайн"
APP_ENV=production
APP_DEBUG=false
APP_TIMEZONE=Europe/Moscow
APP_URL=http://localhost

APP_LOCALE=ru

LOG_CHANNEL=daily

## Подключаем базу

#### Не забыть убрать комментарии у параметров подключения!

Пароль пишем в кавычках ""

php artisan migrate