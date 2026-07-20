# 🖼️ Laravel Image Gallery App
<div align="center">
 
A clean, functional image gallery built with **Laravel**, demonstrating full CRUD media management with secure file handling and efficient database architecture.
 
[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net)
[![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![License](https://img.shields.io/badge/License-MIT-blue?style=for-the-badge)](LICENSE)
 
</div>

---
 
## 📸 Screenshots
 
> 💡 Add screenshots of the gallery grid, upload form, and edit view here once available.
 
| Gallery View | Edit Image |
|:---:|:---:|
| <img src="screenshots/gallery.png" width="250"> | <img src="screenshots/edit.PNG" width="250"> |
---

## 📖 Overview
 
This project demonstrates the implementation of full **CRUD** (Create, Read, Update, Delete) functionality for media management, with an emphasis on secure file handling and clean database design.
 
---

 
## 🧠 Key Learning: File Systems vs. Databases
 
A core architectural decision in this project was moving away from storing raw image data (BLOBs) in the database. Instead, this app implements:
 
- **Path-Based Storage** — Only the file path/string is stored in the MySQL database.
- **Storage Abstraction** — Uses Laravel's `Storage` facade to keep the actual files in the local `storage/app/public` directory.
**Why?** This keeps database performance high, prevents "DB bloat," and makes it straightforward to migrate to cloud storage (e.g. Amazon S3) later.
 
---

## ✨ Features
 
| Feature | Description |
|---------|--------------|
| **Secure Uploads** | Image upload with MIME type validation — only images are accepted |
| **Gallery View** | Responsive grid display of all uploaded images |
| **Edit/Update** | Update image titles or replace existing files |
| **Delete** | Removes both the database record and the physical file from the server |
| **CSRF Protection** | Secure form handling via Laravel's built-in security features |
 
---

 
## 🔒 Security Features
 
- **Validation** — Strict rules for file size and allowed extensions
- **Path Masking** — Files are stored in a way that prevents direct execution of malicious scripts
---
 
## 💻 Tech Stack
 
- **Backend:** PHP 8.x, Laravel 10.x / 11.x
- **Database:** MySQL
- **Frontend:** Blade Templates, Tailwind CSS (or Bootstrap)
- **File Handling:** Laravel Storage Facade
---

## 🚀 Installation
 
### Prerequisites
- PHP >= 8.1
- Composer
- Node.js & npm
- MySQL
### Steps
 
```bash
# 1. Clone the repository
git clone https://github.com/your-username/laravel-gallery-app.git
cd laravel-gallery-app
 
# 2. Install dependencies
composer install
npm install && npm run dev
 
# 3. Set up environment
cp .env.example .env
php artisan key:generate
 
# 4. Configure database
# Update your .env file with your local database credentials
 
# 5. Run migrations
php artisan migrate
 
# 6. Link storage (so uploaded images are publicly accessible)
php artisan storage:link
 
# 7. Start the server
php artisan serve
```
 
Then open **http://127.0.0.1:8000** in your browser.
 
---
 
## 🗺️ Roadmap
 
- [ ] Cloud storage support (Amazon S3)
- [ ] Image tagging/categorization
- [ ] Bulk upload
- [ ] Lightbox/full-screen image preview
---
 
## 🤝 Contributing
 
Contributions, issues, and feature requests are welcome. Check the issues page on the repository.
 
---
 
## 📄 License
 
This project is open-sourced under the [MIT License](LICENSE).
 
---
 
<div align="center">
Made with ❤️ using Laravel
 
</div>
