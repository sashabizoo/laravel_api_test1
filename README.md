Преполагается что мы используем окружение laravel_env1 (https://github.com/sashabizoo/laravel_env1) для разворачивания проекта

1. Клонируем Laravel проект. Делаем команду (на выбор)

git clone git@github.com:sashabizoo/laravel_api_test1.git src 
или 
git clone https://github.com/sashabizoo/laravel_api_test1.git src

2. заходим в папку src (папка с Laravel)
   
3. если файл .env в корне папки отсутствует, создаем его из файла копируя из .env.examples
  
4. и копируем настройки из окружения laravel_env1 (файл .env в корне окружения), проверяем настройки

DB_CONNECTION=mysql 
DB_HOST=mysql 
DB_USERNAME=root 
DB_PASSWORD=password 
DB_DATABASE=laravel_test 
DB_PORT=3306
L5_SWAGGER_CONST_HOST=http://localhost:8889

5. Делаем сборку, миграции сидеры, чистим кэш. Делаем команды:

docker compose run composer update

docker compose run artisan key:generate

docker compose run artisan migrate:fresh --seed

chmod -R guo+w storage

docker compose run artisan cache:clear

docker compose run artisan optimize:clear

6. Генерируем Swagger документация для API

docker compose run artisan l5-swagger:generate 

7. Запускаем приложение

Swagger документация тут: http://localhost:8889/api/documentation

Тесты здесь: docker compose run artisan test tests/Feature/OrderTest.php

API здесь: 
POST: http://localhost:8889/api/orders
GET: http://localhost:8889/api/orders/{id}

Структура проекта:
