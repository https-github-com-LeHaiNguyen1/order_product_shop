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

    sass/
    |
    |– abstracts/ (or utilities/)
    |   |– _variables.scss    // Sass Variables
    |   |– _functions.scss    // Sass Functions
    |   |– _mixins.scss       // Sass Mixins
    |
    |– base/
    |   |– _reset.scss        // Reset/normalize
    |   |– _typography.scss   // Typography rules
    |
    |– components/ (or modules/)
    |   |– _buttons.scss      // Buttons
    |   |– _carousel.scss     // Carousel
    |   |– _slider.scss       // Slider
    |
    |– layout/
    |   |– _navigation.scss   // Navigation
    |   |– _grid.scss         // Grid system
    |   |– _header.scss       // Header
    |   |– _footer.scss       // Footer
    |   |– _sidebar.scss      // Sidebar
    |   |– _forms.scss        // Forms
    |
    |– pages/
    |   |– _home.scss         // Home specific styles
    |   |– _about.scss        // About specific styles
    |   |– _contact.scss      // Contact specific styles
    |
    |– themes/
    |   |– _theme.scss        // Default theme
    |   |– _admin.scss        // Admin theme
    |
    |– vendors/
    |   |– _bootstrap.scss    // Bootstrap
    |   |– _jquery-ui.scss    // jQuery UI
    |
    `– main.scss              // Main Sass file

