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

# Configure Apache to serve XML files properly (prevent PHP processing)
RUN echo '<FilesMatch "\.(xml|txt)$">' >> /etc/apache2/apache2.conf \
 && echo '    SetHandler default-handler' >> /etc/apache2/apache2.conf \
 && echo '</FilesMatch>' >> /etc/apache2/apache2.conf

# App files
WORKDIR /var/www/html

# Copy your actual website files
COPY . /var/www/html

# Generate sitemaps during build
RUN php /var/www/html/scripts/generate_sitemaps.php \
 && cp /var/www/html/public/sitemap*.xml /var/www/html/

# Create the fast health endpoint for Railway (PHP version)
RUN echo '<?php header("Content-Type: text/plain"); echo "ok"; ?>' > /var/www/html/health.php

# Also create a static HTML version as backup (doesn't require PHP)
RUN echo 'ok' > /var/www/html/health.txt

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html \
 && find /var/www/html -type f -exec chmod 644 {} \; \
 && find /var/www/html -type d -exec chmod 755 {} \;

# Startup script to bind Apache to $PORT at runtime
COPY docker/apache-run.sh /usr/local/bin/apache-run
RUN chmod +x /usr/local/bin/apache-run

# Expose is just metadata, but it helps local runs
EXPOSE 8080

# Use our launcher (it will exec apache2-foreground)
CMD ["apache-run"]
