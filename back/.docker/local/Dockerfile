FROM php:8.2-cli

# Instala dependências do PHP
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libzip-dev \
    libonig-dev \
    && docker-php-ext-configure gd \
    && docker-php-ext-install pdo pdo_mysql gd zip

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define o diretório de trabalho
WORKDIR /var/www

# Copia o código da aplicação
COPY . .

COPY --chown=root:root ./.docker/local/entrypoint.sh /run/entrypoint.sh

RUN chmod +x /run/entrypoint.sh

# Instala as dependências do Laravel
RUN composer install

# Dá permissão 777 ao storage e ao cache
RUN chmod -R 777 /var/www/storage /var/www/bootstrap/cache

# Opcional: dar permissão 777 para todo o diretório de trabalho
RUN chmod -R 777 /var/www

# Exponha a porta que o servidor embutido do Laravel vai rodar
EXPOSE 8000

ENTRYPOINT  "/run/entrypoint.sh" 
