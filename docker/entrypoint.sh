#!/bin/bash
set -e

echo "Running migrations..."
php artisan migrate --force

echo "Publishing assets..."
php artisan storage:link || true

echo "Starting application..."
exec "$@"
