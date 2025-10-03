#!/usr/bin/env bash
set -e

PORT="${PORT:-8080}"

# Point Apache to the runtime $PORT Railway provides
sed -ri "s/Listen [0-9]+/Listen ${PORT}/" /etc/apache2/ports.conf
sed -ri "s/:([0-9]+)>/:${PORT}>/" /etc/apache2/sites-available/000-default.conf

# Optional: set a ServerName to avoid warnings
echo "ServerName localhost" >/etc/apache2/conf-available/servername.conf
a2enconf servername >/dev/null 2>&1 || true

# Start Apache in foreground (as the base image expects)
exec apache2-foreground
