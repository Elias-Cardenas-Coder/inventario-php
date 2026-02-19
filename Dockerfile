FROM php:8.4-cli

# ===============================
# Dependencias del sistema
# ===============================
RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    git \
    curl \
    sqlite3 \
    libsqlite3-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_sqlite gd \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# ===============================
# Composer
# ===============================
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# ===============================
# Directorio de trabajo
# ===============================
WORKDIR /var/www/html

# ===============================
# Copiar proyecto
# ===============================
COPY . .

# Evita warning de git en docker
RUN git config --global --add safe.directory /var/www/html

# ===============================
# Instalar dependencias PHP
# ===============================
RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction

# ===============================
# Base de datos + permisos
# ===============================
RUN touch database/database.sqlite \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache database \
    && chmod 664 database/database.sqlite

# ===============================
# Storage link (IMÁGENES)
# ===============================
RUN php artisan storage:link

# ===============================
# Puerto
# ===============================
EXPOSE 8000

# ===============================
# Servidor Laravel
# ===============================
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
