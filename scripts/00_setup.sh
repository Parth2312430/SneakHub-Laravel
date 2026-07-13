#!/usr/bin/env bash

# Make sure SQLite file exists and is writable
echo "Setting up SQLite database..."
mkdir -p /var/www/html/database
touch /var/www/html/database/database.sqlite
chmod -R 777 /var/www/html/database
chmod -R 777 /var/www/html/storage

# Run database migrations and seeders (force is required in production)
echo "Running Migrations & Seeding..."
php artisan migrate:fresh --seed --force

# Cache Laravel configuration for speed
php artisan config:cache
php artisan route:cache
php artisan view:cache
