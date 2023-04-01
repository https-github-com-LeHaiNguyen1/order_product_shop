## Setting laravel

0. Setup Vshot xampp and host windows

1. Setup src
  - coppy .env.example to .env
  - composer install
  - create database connection mysql and add database name order_plading_page
  - Character set : utf8mb4
  - Collation: utf8mb4_unicode_ci

2. php artisan key:generate

3. Create table database : php artisan make:migration create_newColum_role_table

4. Create add new column table : php artisan make:migration add_new_column_to_newColum_table --table= NewColum  

5. Update seender:  php artisan migrate:fresh --seed --seeder=UsersTableSeeder

6. Create update migrate: php artisan migrate --seed

7. Folder structure with sass 7–1 Pattern, Abstracts (or utilities)

   **Pattern Template 7-1**, an extraordinarily neat architecture that any Web Designer can understand at a glance. Structure with the help of SASS syntax (**.sass extension**).

``` txt
sass/                    
|    
|– Auth /                   
|   |–Login /
|      |– index.css  
|     |– index.css.map  
|     |– index.sass   
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
