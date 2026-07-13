FROM richarvey/nginx-php-fpm:latest

# Copy application files
COPY . .

# Install PHP dependencies during image build
ENV COMPOSER_ALLOW_SUPERUSER 1
RUN composer install --no-dev --optimize-autoloader

# Configure image variables for production environment
ENV WEBROOT /var/www/html/public
ENV SKIP_COMPOSER 1
ENV RUN_SCRIPTS 1
ENV PHP_ERRORS_STDERR 1
ENV REAL_IP_HEADER 1

# Expose Nginx port
EXPOSE 80
