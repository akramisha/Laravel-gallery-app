<div align="center">
# 🖼️ Laravel Image Gallery App
 
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
 
| Gallery View | Upload Form | Edit Image |
| :---: | :---: | :---: |
| ![Gallery](screenshots/gallery.png) | ![Upload](screenshots/upload.png) | ![Edit](screenshots/edit.png) |
 
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
