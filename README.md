# BloodBankAPI_Laravel
An API for Blood Bank Management System built with Laravel



# COMMANDS FOR DEVELOPMENT IN GIT BASH

# CREATE  TABLE
php artisan make:migration create_[TABLE-NAME]_table

# MIGRATE TABLE
php artisan migrate

# CREATE A MODEL
php artisan make:model [model-name] -m

# CREATE CONTROLLER
php artisan make:controller Api\\[name]Controller --model=[model-name]

# CREATE RESOURCES
$ php artisan make:resource [name]Resource
