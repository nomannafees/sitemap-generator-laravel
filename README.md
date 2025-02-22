# Laravel Sitemap Generator
This project is a Laravel-based web application that crawls a website and generates an XML sitemap for SEO purposes. It is optimized for speed and performance using Laravel queues and background jobs.

# Zoom Link
https://www.loom.com/share/518dfef4f649443c846689e3c9bcc933?sid=d7a7d4f5-f16c-4765-95f9-df7a6e982f83
# Features

Accepts a domain URL and crawls the entire website.

Generates an XML sitemap following SEO best practices.

Uses Laravel queues for efficient execution.

Simple UI with Bootstrap 5.

Allows users to download the sitemap.xml file.

# Prerequisites

Ensure you have the following installed:

PHP 8.1 or higher

Composer

Laravel 10 (latest stable version)

MySQL

# Step 1: Clone the repository from GitHub
git clone https://github.com/nomannafees/laravel-sitemap-generator.git

cd laravel-sitemap-generator

#Step 2: Install PHP dependencies using Composer
Install Dependencies<br>
Run<br>
composer install

#Step 3: Configure Environment

Copy the example .env file and set your environment variables
cp .env.example .env

Open the .env file and configure database settings<br>
DB_CONNECTION=mysql<br>
DB_HOST=127.0.0.1<br>
DB_PORT=3306<br>
DB_DATABASE=sitemap_db<br>
DB_USERNAME=root<br>
DB_PASSWORD=yourpassword<br>

# Step 4: Generate Application Key

php artisan key:generate<br>
php artisan config:cache<br>
Set Up Database

# Step 5 Run migrations
php artisan migrate

# Step 6: Setup Storage Symlink for Sitemap XML

php artisan storage:link

# Step 7: Start Laravel Development Server

php artisan serve

Now, visit http://127.0.0.1:8000 in your browser.

# Step 8: Configure Queue Driver

Open .env and set:

QUEUE_CONNECTION=database

# Step 9: Run Queue Worker

php artisan queue:work

Generating & Downloading Sitemap

Generate Sitemap

Enter the website URL in the input field.

Click "Generate Sitemap".

Download Sitemap

Click "Download Sitemap" after generation.

Stopping the Server & Queue

# Stop the development server
CTRL + C

# Stop the queue worker
php artisan queue:restart

#Deploying to Production

Step 1: Set Up Production Environment

php artisan config:cache
php artisan route:cache
php artisan view:cache

Step 2: Set File Permissions

chmod -R 775 storage bootstrap/cache

# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Check queue status
php artisan queue:failed
php artisan queue:restart

# Congratulations!

Your Laravel Sitemap Generator is ready.
