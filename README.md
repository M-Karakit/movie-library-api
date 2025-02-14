# Movie Library API 🎬

[![PHP Version](https://img.shields.io/badge/PHP-8.0%2B-777BB4?logo=php)](https://www.php.net/)
[![Laravel Version](https://img.shields.io/badge/Laravel-10.x-FF2D20?logo=laravel)](https://laravel.com)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

A robust RESTful API for managing movie databases with advanced query capabilities. Built with Laravel following RESTful best practices.

## ✨ Features
- **CRUD Operations** for Movies & Ratings
- 🔍 Advanced Filtering (genre, director, release year)
- 📊 Dynamic Sorting (release year ascending/descending)
- 📑 Pagination Support
- 🔐 User Authentication for Ratings/Reviews
- 🚀 API Documentation (Postman Collection)
- ✅ Comprehensive Error Handling

## 🚀 Getting Started

### Prerequisites
- PHP 8.0+
- Composer 2.0+
- MySQL 5.7+

### Installation
1. **Clone Repository**
   ```bash
   git clone https://github.com/M-Karakit/movie-library-api.git
   ```

   ```bash
   cd movie-library-api
   ```

2. **Install Dependencies:**
    ```bash
    composer install
    ```

3. **Set Up Environment:**
    ```bash
    cp .env.example .env
    ```

    Open the .env file and add your database configuration:
    ```bash
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=movies-library
        DB_USERNAME=root
        DB_PASSWORD=

4. **📂 Run Migrations** 
    To set up the database tables, run:

    ```bash
    php artisan migrate
    ```


5. **Start the Local Server**
    To run the local server, use:

    ```bash
    php artisan serve
    ```




    **⚡ Advanced Features**  

&nbsp;&nbsp;&nbsp;&nbsp;📌 Pagination.  
&nbsp;&nbsp;&nbsp;&nbsp;Controls the number of movies displayed per page for optimized performance.  

&nbsp;&nbsp;&nbsp;&nbsp;🎭 Filtering.  
&nbsp;&nbsp;&nbsp;&nbsp;Filter movies by **genre** or **director** for targeted searches.  

&nbsp;&nbsp;&nbsp;&nbsp;📅 Sorting.  
&nbsp;&nbsp;&nbsp;&nbsp;Sort movies by **release year** in **ascending** or **descending** order.  


## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

      






