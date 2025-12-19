# E-Commerce Mini System

A simplified e-commerce backend using Laravel 11 + Sanctum Authentication.

## Features

- **Sanctum Authentication** - Register, Login, Logout, Get User Profile
- **Products Management** - Full CRUD operations with stock tracking
- **Shopping Cart** - Add products to cart with quantity management
- **Order System** - Create orders from cart, total calculation, automatic cart clearing

## Tech Stack

- **Backend**: Laravel 11
- **Authentication**: Sanctum
- **Database**: MySQL
- **PHP**: 8.1+

## Installation & Setup

### Prerequisites

- PHP 8.1+
- Composer
- MySQL
- XAMPP or similar environment

### Steps

1. **Clone the repository**
```bash
git clone https://github.com/ahmehamdy/e-commerce.git
cd PROJECT

2.Install dependencies
composer install

3.Configure environment
cp .env.example .env

4.Set up database
Create database:
mysql -u root -e "CREATE DATABASE ecommerce"

**Update .env with your DB credentials:**
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ecommerce
DB_USERNAME=root
DB_PASSWORD=

 5.Generate application key
 php artisan key:generate

6.Run migrations & seeders
php artisan migrate --seed

7.Start the development server
php artisan serve
Server runs at: http://localhost:8000

API Endpoints
Base URL
http://localhost:8000/api

Authentication
Register
POST /api/register
Content-Type: application/json

{
  "name": "Ahmed Hamdy",
  "email": "ahmed@example.com",
  "password": "123456",
  "password_confirmation": "123456"
}

Response:
{
  "user": { ... },
  "token": "your_sanctum_token_here"
}

Login
POST /api/login
Content-Type: application/json

{
  "email": "ahmed@example.com",
  "password": "123456"
}

Response:
{
  "user": { ... },
  "token": "your_sanctum_token_here"
}

Logout
POST /api/logout
Authorization: Bearer {token}

Products Module
Get All Products

GET /api/products
Authorization: Bearer {token}

Show Product
GET /api/products/{id}
Authorization: Bearer {token}


POST /api/products
Authorization: Bearer {token}
Content-Type: application/json


Create Product
{
  "title": { "en": "Laptop", "ar": "لاب توب" },
  "description": { "en": "Powerful laptop", "ar": "لاب توب قوي" },
  "price": 1500,
  "quantity": 10,
  "image": "products/default.png"
}

Cart Module
View Cart
GET /api/cart
Authorization: Bearer {token}

Add Item to Cart
POST /api/cart
Authorization: Bearer {token}
Content-Type: application/json

{
  "product_id": 1,
  "quantity": 2
}

Remove Item from Cart
DELETE /api/cart/{id}
Authorization: Bearer {token}

Orders Module
Create Order
POST /api/orders
Authorization: Bearer {token}
Response:
{
  "status": true,
  "message": "Order created successfully",
  "data": {
    "id": 1,
    "total_price": 3000,
    "items": [ ... ]
  }
}

List User Orders
GET /api/orders
Authorization: Bearer {token}

Show Order Details
GET /api/orders/{id}
Authorization: Bearer {token}


Project Structure
app/
 ├── Http/Controllers/
 │    ├── AuthController.php
 │    ├── ProductController.php
 │    ├── CartController.php
 │    └── OrderController.php
 └── Models/
      ├── User.php
      ├── Product.php
      ├── Cart.php
      ├── CartItem.php
      ├── Order.php
      └── OrderItem.php
database/
 └── migrations/
routes/
 └── api.php

Author

Ahmed Hamdy – Junior Full-Stack Developer Interview Task

License

MIT License
