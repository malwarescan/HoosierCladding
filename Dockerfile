# Use PHP 8.2 with Apache
FROM php:8.2-apache

# Install required PHP extensions
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install zip \
    && docker-php-ext-install mysqli \
    && docker-php-ext-install pdo_mysql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy composer files
COPY composer.json composer.lock ./

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Copy application files
COPY . .

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy custom Apache configuration
RUN echo '<Directory /var/www/html>' >> /etc/apache2/apache2.conf \
    && echo '    AllowOverride All' >> /etc/apache2/apache2.conf \
    && echo '</Directory>' >> /etc/apache2/apache2.conf

# Create a simple test PHP file
RUN echo '<?php phpinfo(); ?>' > /var/www/html/test.php

# Create a simple fallback index if main one fails
COPY index-simple.php /var/www/html/index-fallback.php

# Create a simple index.html that redirects to PHP
RUN echo '<!DOCTYPE html><html><head><meta http-equiv="refresh" content="0;url=/test.php"></head><body>Redirecting to PHP test...</body></html>' > /var/www/html/index.html

# Expose port 80
EXPOSE 80

# Create startup script
RUN echo '#!/bin/bash' > /start.sh \
    && echo 'echo "Starting Apache..."' >> /start.sh \
    && echo 'apache2ctl start' >> /start.sh \
    && echo 'echo "Apache started. Checking status..."' >> /start.sh \
    && echo 'sleep 5' >> /start.sh \
    && echo 'apache2ctl status' >> /start.sh \
    && echo 'echo "Starting Apache foreground process..."' >> /start.sh \
    && echo 'exec apache2-foreground' >> /start.sh \
    && chmod +x /start.sh

# Start with our custom script
CMD ["/start.sh"]
