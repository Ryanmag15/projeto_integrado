#!/bin/bash

# Mude para o diretório de trabalho
cd /var/www

# Rodar migrações
php artisan migrate --force

# Rodar seeders
php artisan db:seed --force

# Iniciar o servidor embutido
php artisan serve --host=0.0.0.0
