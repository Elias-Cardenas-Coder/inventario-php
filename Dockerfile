# Etapa de construcción
FROM php:8.4-apache AS builder

WORKDIR /var/www/html

# Instala dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    wget \
    zip \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath xml zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copia archivos del proyecto
COPY . /var/www/html/

# Crea directorios necesarios
RUN mkdir -p /var/www/html/bootstrap/cache && \
    mkdir -p /var/www/html/storage

# Instala dependencias de PHP
RUN composer install --no-dev --optimize-autoloader --no-progress --no-interaction

# Instala Node.js y dependencias
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && npm install \
    && npm run build

# Etapa de producción
FROM php:8.4-apache

WORKDIR /var/www/html

# Instala solo extensiones de PHP necesarias (sin herramientas de desarrollo)
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath xml zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Copia Composer desde la etapa de construcción
COPY --from=builder /usr/bin/composer /usr/bin/composer

# Copia los archivos compilados desde la etapa anterior
COPY --from=builder /var/www/html /var/www/html

# Configura los permisos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Habilita módulos de Apache necesarios
RUN a2enmod rewrite \
    && a2enmod headers

# Configuración de Apache para Laravel
RUN echo '<Directory /var/www/html/public>\n\
    Options -MultiViews +FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' > /etc/apache2/conf-available/laravel.conf \
    && a2enconf laravel

# Configura el DocumentRoot
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

# Archivo de configuración de Apache para mejor rendimiento
RUN echo 'ServerTokens Prod\n\
ServerSignature Off\n\
<IfModule mod_headers.c>\n\
    Header always set X-Frame-Options "SAMEORIGIN"\n\
    Header always set X-Content-Type-Options "nosniff"\n\
    Header always set X-XSS-Protection "1; mode=block"\n\
</IfModule>' >> /etc/apache2/apache2.conf

# Expone el puerto 80
EXPOSE 80

# Comando por defecto
CMD ["apache2-foreground"]
