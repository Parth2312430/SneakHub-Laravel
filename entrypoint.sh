#!/bin/sh

# Set up SQLite database
echo "Setting up SQLite database..."
mkdir -p /var/www/html/database
touch /var/www/html/database/database.sqlite
chmod -R 777 /var/www/html/database
chmod -R 777 /var/www/html/storage
chmod -R 777 /var/www/html/bootstrap/cache

# Run migrations and seeders (force is required in production)
echo "Running Migrations & Seeding..."
php artisan migrate:fresh --seed --force

# Cache Laravel configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Dynamically replace the Apache port with $PORT (defaults to 7860 if not set)
PORT_TO_LISTEN=${PORT:-7860}
echo "Configuring Apache to listen on port $PORT_TO_LISTEN..."
sed -i "s/Listen .*/Listen $PORT_TO_LISTEN/g" /etc/apache2/ports.conf
sed -i "s/<VirtualHost \*:.*/<VirtualHost \*:$PORT_TO_LISTEN>/g" /etc/apache2/sites-available/*.conf

# Start Apache in the foreground
echo "Starting Apache..."
exec apache2-foreground
