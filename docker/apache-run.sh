#!/usr/bin/env bash
set -e

PORT="${PORT:-8080}"

# Log startup with environment info
echo "[apache-run] ========================================"
echo "[apache-run] Apache Startup Script"
echo "[apache-run] PORT=${PORT}"
echo "[apache-run] PWD=$(pwd)"
echo "[apache-run] ========================================"

# Point Apache to the runtime $PORT Railway provides
echo "[apache-run] Updating Apache port configuration..."
if ! sed -ri "s/Listen [0-9]+/Listen ${PORT}/" /etc/apache2/ports.conf 2>&1; then
    echo "[apache-run] ERROR: Failed to update ports.conf"
    cat /etc/apache2/ports.conf
    exit 1
fi

if ! sed -ri "s/:([0-9]+)>/:${PORT}>/" /etc/apache2/sites-available/000-default.conf 2>&1; then
    echo "[apache-run] ERROR: Failed to update 000-default.conf"
    cat /etc/apache2/sites-available/000-default.conf
    exit 1
fi

echo "[apache-run] Port configuration updated successfully"

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
