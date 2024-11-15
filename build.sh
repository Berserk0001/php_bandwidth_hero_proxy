#!/bin/bash

# Install Composer dependencies
composer install --no-interaction --prefer-dist --optimize-autoloader

# Copy files to the output directory (if needed)
cp -r . ./public
