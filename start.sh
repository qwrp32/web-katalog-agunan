#!/bin/bash

# Run Laravel setup
php artisan migrate --force
php artisan storage:link
php artisan config:cache

# Start Laravel dev server
php artisan serve --host=0.0.0.0 --port=${PORT:-8000}