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

# Set working directory
WORKDIR /var/www/html

# Create a simple working index.php first
RUN echo '<?php echo "PHP Working! Version: " . phpversion(); ?>' > /var/www/html/index.php

# Create a simple test PHP file
RUN echo '<?php echo "Test OK - PHP Version: " . phpversion(); ?>' > /var/www/html/test.php

# Create a simple HTML fallback
RUN echo '<!DOCTYPE html><html><head><title>Hoosier Cladding</title></head><body><h1>Hoosier Cladding LLC</h1><p>Website loading...</p></body></html>' > /var/www/html/index.html

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Configure Apache for Railway deployment
RUN echo '<Directory /var/www/html>' >> /etc/apache2/apache2.conf \
    && echo '    AllowOverride All' >> /etc/apache2/apache2.conf \
    && echo '    DirectoryIndex index.php index.html' >> /etc/apache2/apache2.conf \
    && echo '</Directory>' >> /etc/apache2/apache2.conf

# Configure Apache to listen on the port Railway provides
RUN echo 'Listen 80' >> /etc/apache2/ports.conf \
    && echo '<VirtualHost *:80>' >> /etc/apache2/sites-available/000-default.conf \
    && echo '    DocumentRoot /var/www/html' >> /etc/apache2/sites-available/000-default.conf \
    && echo '    <Directory /var/www/html>' >> /etc/apache2/sites-available/000-default.conf \
    && echo '        AllowOverride All' >> /etc/apache2/sites-available/000-default.conf \
    && echo '        Require all granted' >> /etc/apache2/sites-available/000-default.conf \
    && echo '    </Directory>' >> /etc/apache2/sites-available/000-default.conf \
    && echo '</VirtualHost>' >> /etc/apache2/sites-available/000-default.conf

# Create a startup script that handles Railway's PORT variable
RUN echo '#!/bin/bash' > /start.sh \
    && echo 'echo "=== Starting Hoosier Cladding PHP Application ==="' >> /start.sh \
    && echo 'echo "PHP Version: $(php --version | head -1)"' >> /start.sh \
    && echo 'echo "Apache Version: $(apache2 -v | head -1)"' >> /start.sh \
    && echo 'echo "Railway PORT: $PORT"' >> /start.sh \
    && echo 'echo "Checking Apache config..."' >> /start.sh \
    && echo 'apache2ctl configtest' >> /start.sh \
    && echo 'echo "Configuring Apache for port $PORT..."' >> /start.sh \
    && echo "sed -i 's/Listen 80/Listen $PORT/g' /etc/apache2/ports.conf" >> /start.sh \
    && echo "sed -i 's/:80/:$PORT/g' /etc/apache2/sites-available/000-default.conf" >> /start.sh \
    && echo 'echo "Starting Apache on port $PORT..."' >> /start.sh \
    && echo 'exec apache2-foreground' >> /start.sh \
    && chmod +x /start.sh

# Expose port (Railway will set the PORT env var)
EXPOSE $PORT

# Start with our Railway-compatible script
CMD ["/start.sh"]
