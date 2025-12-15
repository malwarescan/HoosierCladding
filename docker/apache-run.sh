#!/usr/bin/env bash
set -e

PORT="${PORT:-8080}"

# Log startup
echo "[apache-run] Starting Apache on port ${PORT}..."

# Point Apache to the runtime $PORT Railway provides
sed -ri "s/Listen [0-9]+/Listen ${PORT}/" /etc/apache2/ports.conf || {
    echo "[apache-run] ERROR: Failed to update ports.conf"
    exit 1
}

sed -ri "s/:([0-9]+)>/:${PORT}>/" /etc/apache2/sites-available/000-default.conf || {
    echo "[apache-run] ERROR: Failed to update 000-default.conf"
    exit 1
}

# Optional: set a ServerName to avoid warnings
echo "ServerName localhost" >/etc/apache2/conf-available/servername.conf
a2enconf servername >/dev/null 2>&1 || true

# Ensure health.php exists and is accessible
if [ ! -f /var/www/html/health.php ]; then
    echo "[apache-run] WARNING: health.php not found, creating it..."
    echo '<?php header("Content-Type: text/plain"); echo "ok"; ?>' > /var/www/html/health.php
    chmod 644 /var/www/html/health.php
    chown www-data:www-data /var/www/html/health.php
fi

echo "[apache-run] Configuration updated. Starting Apache in foreground..."
# Start Apache in foreground (as the base image expects)
exec apache2-foreground
