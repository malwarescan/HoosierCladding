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

# Configure Apache
RUN echo '<Directory /var/www/html>' >> /etc/apache2/apache2.conf \
    && echo '    AllowOverride All' >> /etc/apache2/apache2.conf \
    && echo '    DirectoryIndex index.php index.html' >> /etc/apache2/apache2.conf \
    && echo '</Directory>' >> /etc/apache2/apache2.conf

# Expose port 80
EXPOSE 80

# Start Apache directly
CMD ["apache2-foreground"]
