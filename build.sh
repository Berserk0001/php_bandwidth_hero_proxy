#!/bin/bash

# Install Composer if not already installed
if ! command -v composer &> /dev/null; then
    echo "Composer not found. Installing Composer..."
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
    php -r "if (hash_file('sha384', 'composer-setup.php') === 'e21205b2077ef9b1f295f13
