<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Набор API-методов для аутентификации и авторизации (jwt). Cохранения событий и получения статистики.

Приложение содержит эндпоинты для аутентификации и авторизации с использованием jwt. При регистрации нового пользователя на указанный email отправляется письмо для верификации, также отправляется уведомление о создании пользователя в телеграмм. Зарегистрированный пользователь может создавать события (POST:/api/events) и получать статистику по событиям (GET: /api/events/stats) с фильтрацией и агрегацией. Документация (не полная)swagger доступна по url: /api/documentation#/ <br>

## Разворот

1. `git clone https://github.com/ilyazenQ/auth-stats.git`<br>
2. `cd auth-stats`<br>
3. `composer require laravel/sail --dev`<br>
4. `./vendor/bin/sail up -d`<br>
5. `cp .env.example .env` В .env.example указаны верные данные для cтандартного sail контейнера. В .env указать подключение к тг боту (TELEGRAM_BOT_TOKEN, TELEGRAM_CHAT_ID)<br>
6. `./vendor/bin/sail shell`<br>
7. `composer install`<br>
8. `php artisan key:generate`<br>
9. `php artisan storage:link`<br>
10. `php artisan jwt:secret`<br>
11. `php artisan migrate`<br>
12. `php artisan l5-swagger:generate`<br>