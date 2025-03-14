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
