Для развертки проекта клонируем репозиторий

composer install

npm i && npm run build

Копируем env файлик, убрав расширение example

меняем DB_CONNECTION=mysql на DB_CONNECTION=sqlite

php artisan key: generate
