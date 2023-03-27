## Setting laravel

0. Setup Vshot xampp and host windows

1. Setup src
   1.0 coppy .env.example to .env
   1.1 composer install
   1.2 create database connection mysql and add database name order_plading_page
    1.1.1 Character set : utf8mb4
    1.1.2 Collation: utf8mb4_unicode_ci

2. Create update migrate: php artisan migrate --seed

3. Folder structure with sass 7–1 Pattern, Abstracts (or utilities)

   **Pattern Template 7-1**, an extraordinarily neat architecture that any Web Designer can understand at a glance. Structure with the help of SASS syntax (**.sass extension**).

``` txt
sass/                    
|    
|– abstracts/                   
|   |– _mixins.sass     
|   |– _variables.sass   
|– base/              
|   |– _base.sass   
|   |– _fonts.sass   
|   |– _helpers.sass
|   |– _typography.sass
|– components/   
|   |– _alert.sass     
|   |– _button.sass        
|   ...
|– layout/                
|   |– _footer.sass
|   |– _header.sass
|– pages/                
|   |– _home.sass        
|   ...
|– themes/                
|   |– _dark.sass        
|   |– _light.sass     
|– vendors/                
|   |– _normalize.sass       
|   |– _owl-carousel.sass
|   ...
`– main.sass             
```

# Compile SASS.

## Watch: Autocompile if it detects changes 

``` bash
node-sass --watch --source-map true --output-style compressed sass/main.sass css/main.css
```
