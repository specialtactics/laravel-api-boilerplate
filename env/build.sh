#!/usr/bin/env bash

composer install
composer dump-autoload --optimize
php artisan ide-helper:generate
php artisan ide-helper:meta
