# Laravel Image Gallery App
A clean, functional Image Gallery application built with Laravel. This project demonstrates the implementation of full CRUD (Create, Read, Update, Delete) functionality for media management, focusing on secure file handling and efficient database architecture.

# Key Learning: File Systems vs. Databases
One of the core architectural decisions in this project was moving away from storing raw image data (BLOBs) in the database. Instead, this app implements:

## Path-Based Storage: 
Only the file path/string is stored in the MySQL database.

## Storage Abstraction: 
Utilizing Laravel's Storage facade to keep the actual files in the local storage/app/public directory.

## Why? 
This ensures better database performance, prevents "DB bloat," and allows for easier migration to cloud services like Amazon S3 in the future.

# Features
## Secure Uploads: 
Image upload with MIME type validation (ensuring only images are accepted).

## Gallery View: 
A responsive grid display of all uploaded images.

## Edit/Update: 
Ability to update image titles or replace existing files.

## Delete: 
Complete removal of both the database record and the physical file from the server.

## CSRF Protection: 
Secure form handling using Laravel's built-in security features.

# Tech Stack
## Backend: 
PHP 8.x, Laravel 10.x/11.x

## Database: 
MySQL

## Frontend: 
Blade Templates, Tailwind CSS (or Bootstrap)

## File Handling: 
Laravel Storage Facade

# Installation

## Clone the repository:

`git clone https://github.com/your-username/laravel-gallery-app.git`

## Install dependencies:

`composer install
npm install && npm run dev` 

## Setup Environment:

`cp .env.example .env
php artisan key:generate`

## Configure Database:

Update your .env file with your local database credentials.

## Run Migrations:

`php artisan migrate` 

## Link Storage:

`php artisan storage:link`

## Start Server:

`php artisan serve`

# Security Features
## Validation: 
Strict rules for file size and extensions.

## Path Masking: 
Files are stored in a way that prevents direct execution of malicious scripts.