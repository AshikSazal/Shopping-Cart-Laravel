php artisan make:model Product -m
php artisan make:seed ProductTableSeeder
php artisan migrate
php artisan db:seed
php artisan make:controller ProductController
php artisan make:controller UserController

change occurred in  Middleware/Authenticate.php, RedirectIfAuthenticated.php

file create in app\Models\Class\Cart.php
"stripe/stripe-php": "^14.0.0"
file create in public\js\checkout.js
php artisan make:model Order -m