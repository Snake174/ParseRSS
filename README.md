## Запуск

- Переименовать *.env.example* в *.env* и прописать свои параметры подключения
- composer install
- php artisan migrate
- php artisan key:generate
- php artisan schedule:run

В *app/Console/Kernel.php (27 строка)* выставить нужный интервал запуска
