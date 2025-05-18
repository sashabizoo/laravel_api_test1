# Laravel API Test Project

# Установка

### Преполагается что мы используем окружение laravel_env1 (https://github.com/sashabizoo/laravel_env1) для разворачивания проекта

## Клонируем Laravel проект в папку src. Делаем команду (на выбор)

git clone git@github.com:sashabizoo/laravel_api_test1.git src 

### или

git clone https://github.com/sashabizoo/laravel_api_test1.git src

### заходим в папку src (папка с Laravel)

cd src
   
### если файл .env в корне папки отсутствует, создаем его из файла копируя из .env.examples
  
### и копируем настройки из окружения laravel_env1 (файл .env в корне окружения), проверяем настройки

DB_CONNECTION=mysql 

DB_HOST=mysql 

DB_USERNAME=root 

DB_PASSWORD=password 

DB_DATABASE=laravel_test 

DB_PORT=3306

L5_SWAGGER_CONST_HOST=http://localhost:8889

## Делаем сборку, миграции сидеры, чистим кэш. Делаем команды:

### Для Mac OS:

docker compose run composer update

docker compose run artisan key:generate

docker compose run artisan migrate --seed

chmod -R guo+w storage

docker compose run artisan cache:clear

docker compose run artisan optimize:clear

### Для Linux:

docker-compose run composer update

docker-compose run artisan key:generate

docker-compose run artisan migrate --seed

chmod -R guo+w storage

docker-compose run artisan cache:clear

docker-compose run artisan optimize:clear

## Генерируем Swagger документация для API

### Для Mac OS:

docker compose run artisan l5-swagger:generate 

### Для Linux:

docker-compose run artisan l5-swagger:generate 

# Запуск приложения (при настройках по умолчанию):

Swagger документация тут: http://localhost:8889/api/documentation

## API здесь (при настройках по умолчанию): 

POST http://localhost:8889/api/orders – Создание нового заказа

GET http://localhost:8889/api/orders/{id} – Получение информации о заказе по ID

# Интеграционные Тесты

### Для Mac OS:

docker compose run artisan test tests/Feature/OrderTest.php

### Для Linux:

docker-compose run artisan test tests/Feature/OrderTest.php

# Очистить кэши

### Для Mac OS:

docker compose run artisan cache:clear

docker compose run artisan optimize:clear

### Для Linux:

docker-compose run artisan cache:clear

docker-compose run artisan optimize:clear

# Сбросить миграции и заново запустить сидеры

### Для Mac OS:

docker compose run artisan migrate:fresh --seed

### Для Linux:

docker-compose run artisan migrate:fresh --seed

# Сгенерировать заново Swagger

### Для Mac OS:

docker compose exec app php artisan l5-swagger:generate

### Для Linux:

docker-compose exec app php artisan l5-swagger:generate

## Структура проекта

app/DTO - объекты передачи данных (Data Transfer Objects)

app/Http/Controllers/Api - API-контроллер

app/Http/Requests - валидатор запросов

app/Http/Resources - ресурс преобразовывающий данных в формат JSON для API

app/Interfaces - интерфейсы репозиториев

app/Models - модели Eloquent, базы данных

app/Repositories - реализации репозиториев

app/Services - бизнес-логика

database/migrations - миграций БД

database/seeders/ - сидеры БД

database/factories - фабрики моделей БД генерирующие тестовые данные

routes/api.php - маршруты API

tests/Feature - интеграционные тесты

.env - настройки окружения

openapi.yaml - документация OpenAPI
