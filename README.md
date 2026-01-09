# User & Order Management REST API

This project is a simple RESTful API built as part of a backend technical assignment.  
It demonstrates basic user and order management with business rule enforcement.

---

## Tech Stack

- PHP 8.2+
- Laravel 12
- MySQL
- PHPUnit (Laravel built-in testing)

---

## How to Run the Project

### 1. Clone Repository
```bash
git clone <(https://github.com/Rhezaaa/user-order-api.git)>
cd user-order-api

2. Install Dependencies
composer install

3. Environment Setup
cp .env.example .env
php artisan key:generate

4. Database Configuration

Update database credentials in .env:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=user_order_api
DB_USERNAME=root
DB_PASSWORD=

5. Run Migrations
php artisan migrate

6. Run Application
php artisan serve


The API will be available at:
http://127.0.0.1:8000

Assumptions & Trade-offs

Authentication is not implemented to keep the scope focused on core backend logic
Order status handling is simplified (PENDING, PAID, CANCELLED)
No deployment setup is included; the project runs locally
Laravel 12 is used, but only stable core features are relied upon
Validation and business rules are handled at the controller level for clarity
