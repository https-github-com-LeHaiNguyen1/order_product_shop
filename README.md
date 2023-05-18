1. composer create-project laravel/laravel laravel_vuejs
2. cd laravel_vuejs
3. Thư viện: 
    composer require laravel/ui --dev
    php artisan ui vue
4. Cài đặt: 
    - npm install
    - npm install vue-loader --save-dev --legacy-peer-deps
    - Chạy lệnh này để build ra vuejs: npm run dev ; npm run watch
5. Cập nhật vuejs : npm install vue@latest --save-dev
6. Câu lệnh tạo model: 
    php artisan make:model Products -mcr
7. Câu lệnh tạo migrate
    - php artisan migrate 
    - php artisan migrate:fresh
9. Phiên bản sử dụng :
    "vue": "^2.5.17",
    "vue-loader": "^15.10.1",
    "vue-router": "2.8.1",
    "vue-template-compiler": "^2.5.17",
    "vueify": "^2.0.1",
    "vuex": "^4.1.0",
    "yarn": "^1.22.19"
10. Câu lệnh clear:
    - php artisan route:clear
    - php artisan cache:clear
    - php artisan view:clear
    - php artisan config:clear
11. Để có thể chạy được choose file :
    File Storage: php artisan storage:link
12. Dùng vue-flash-message 0.7.2 xuất ra thông báo
    - npm i vue-flash-message

II. Login 
1. Laravel Passport
    - install : composer require laravel/passport
2. Tao seeder admin:
    php artisan make:seeder AdminSeeder
    php artisan make:controller AuthController