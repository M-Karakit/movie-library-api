# Movie Library API

## Introduction

This project is a RESTful API for managing a movie library built with Laravel. It provides basic CRUD operations for movies and their ratings, along with advanced features such as filtering, sorting, and pagination.

## Requirements

- [PHP](https://www.php.net/) 8.0 or higher
- [Composer](https://getcomposer.org/)
- [MySQL](https://www.mysql.com/)

## Setting Up the Project

1. **Clone the Repository**

   Clone the repository using Git:

   ```bash
   git clone https://github.com/M-Karakit/movie-library-api.git
   cd movie-library-api

2. **Install Dependencies:**
    composer install

3. **Set Up Environment:**
    cp .env.example .env

    Open the .env file and add your database configuration:
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=movies-library
        DB_USERNAME=root
        DB_PASSWORD=

4. **Run Migrations** 
    To set up the database tables, run:
    php artisan migrate


5. **Start the Local Server**
    To run the local server, use:
    php artisan serve

   **Project Structure**

      ##  Models

      ##  Movie: Represents a movie with fields title, director, genre, release_year, and description.
      ##  Rating: Represents a rating with fields user_id, movie_id, rating, and review.
     
      ##  Migrations

      ##  create_movies_table: Creates the movies table.
      ##  create_ratings_table: Creates the ratings table.
     
      ##  Controllers

      ##  MovieController: Handles requests related to movies.
      ##  RatingController: Handles requests related to ratings.
      
      ##  Services

      ##  MovieService: Contains business logic for movies such as creating, updating, and deleting movies.


    **Advanced Features**

      ##  Pagination: Applied to the list of movies to determine the number of movies displayed per page.
      ##  Filtering: Allows filtering movies by genre or director.
      ##  Sorting: Allows sorting movies by release year in ascending or descending order.






