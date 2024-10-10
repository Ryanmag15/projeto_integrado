# Use a imagem base do PHP
FROM php:8.2-cli

# Instala dependências do PHP e outras ferramentas necessárias
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    git \
    curl \
    unzip \
    libzip-dev \
    libonig-dev \
    && docker-php-ext-configure gd \
    && docker-php-ext-install pdo pdo_mysql gd zip

# Instala o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define o diretório de trabalho
WORKDIR /var/www

# Copia o código da aplicação, incluindo o composer.json
COPY ../ ./  

# Verifica o que foi copiado
RUN ls -la /var/www

# Cria os diretórios storage e bootstrap/cache se não existirem
RUN mkdir -p /var/www/storage /var/www/bootstrap/cache

# Dá permissão 777 para os diretórios de armazenamento
RUN chmod -R 777 /var/www/storage /var/www/bootstrap/cache

# Exponha a porta que o servidor embutido do Laravel vai rodar
EXPOSE 8000

# Definindo o comando padrão
CMD ["php", "artisan", "serve", "--host=0.0.0.0"]

# Copia o script de entrypoint
COPY entrypoint.sh /usr/local/bin/entrypoint.sh

# Define o script de entrypoint
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
