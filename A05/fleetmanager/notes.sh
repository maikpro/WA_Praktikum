# Nützliche Commands für Laravel

# Starte die Applikation:
php artisan serve

# Migration
## Drop All Tables & Migrate
php artisan migrate:fresh

## Drop All Tables & Migrate + run all database seeds
php artisan migrate:fresh --seed

## Migration erstellen
php artisan make:migration create_manufacturers_table
