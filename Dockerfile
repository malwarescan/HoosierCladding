FROM php:8.2-apache

# System / PHP extensions you already use
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip \
 && docker-php-ext-install zip mysqli pdo_mysql \
 && rm -rf /var/lib/apt/lists/*

# Apache: enable mod_rewrite + allow .htaccess + default DirectoryIndex
RUN a2enmod rewrite \
 && printf "\n<Directory /var/www/html>\n    AllowOverride All\n    DirectoryIndex index.php index.html\n</Directory>\n" \
    >> /etc/apache2/apache2.conf

# App files
WORKDIR /var/www/html

# Copy your actual website files
COPY . /var/www/html

# Create the fast health endpoint for Railway
RUN echo '<?php header("Content-Type: text/plain"); echo "ok"; ?>' > /var/www/html/health.php

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html \
 && chmod -R 755 /var/www/html

# Startup script to bind Apache to $PORT at runtime
COPY docker/apache-run.sh /usr/local/bin/apache-run
RUN chmod +x /usr/local/bin/apache-run

# Expose is just metadata, but it helps local runs
EXPOSE 8080

# Use our launcher (it will exec apache2-foreground)
CMD ["apache-run"]
