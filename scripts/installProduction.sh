#!/usr/bin/env bash

# Go to the installation folder
cd /var/www/lestaubiere/api

echo "### Print dependency versions ###"
echo "node: `php -v`"

# Get the latest version via git
echo "### Getting the latest version via git ###"
git fetch origin
git reset origin/master --hard

# Install Back-end dependencies for Lumen
echo "### Installing Back-end depenencies for Lumen ###"
composer install

# Setup Lumen database
echo "### Setting up Lumen database ###"
php artisan migrate:install
php artisan migrate
