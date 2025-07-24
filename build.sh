#!/usr/bin/env bash

# Exit on error
set -e

# Install PHP dependencies
composer install --no-dev --optimize-autoloader

# Laravel cache and permissions
php artisan config:cache
php artisan route:cache
php artisan view:cache

chmod -R 775 storage bootstrap/cache
