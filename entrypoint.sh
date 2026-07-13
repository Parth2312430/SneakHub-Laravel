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

# Start Apache in the foreground
echo "Starting Apache..."
exec apache2-foreground
