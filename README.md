# OverclockHUB

**Diploma In Information Technology - Web Application Development (TSE3623) - Final Project - Kolej Poly-Tech MARA (KPTM)**

OverclockHUB is an e-commerce web application built using the Laravel framework. It provides a comprehensive platform for managing computing products, handling customer carts and orders, and providing user support.

##  Features

-   **User Authentication & Authorization**: Secure login, registration, and role-based access control (Admin & Customer).
-   **Product Catalog**: Browse PC components and accessories with categories management.
-   **Shopping Cart**: Add, update, and remove items with seamless cart session handling.
-   **Order Management**: Secure checkout process and detailed order history tracking.
-   **Voucher/Discount System**: Apply promotional codes during checkout.
-   **Support Ticket System**: Direct support communication channel for users.

##  Tech Stack

-   **Backend**: Laravel 12 (PHP ^8.2)
-   **Database**: MySQL / SQLite (configured via `.env`)
-   **Frontend**: Laravel UI / Blade Templates, Vite for asset building
-   **Containerization**: Docker support included (`docker-compose.yml`)

##  Prerequisites

List of software needed to run the project locally:
-   PHP 8.2+
-   Composer
-   Node.js & npm (for frontend assets)
-   Docker & Docker Compose (Optional, for containerized environment)

##  Installation & Setup

### Local Setup

1. **Clone the repository:**
   ```bash
   git clone <repo-url>
   cd WAD-FINAL-PROJECT
   ```

2. **Install PHP and Node dependencies:**
   ```bash
   composer install
   npm install
   ```

3. **Configure Environment:**
   Copy the example environment file and generate your application key:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   *Note: Update your `.env` file with proper database credentials (e.g., MySQL or SQLite).*

4. **Run Migrations and Seeders:**
   Prepare your database structure and sample data:
   ```bash
   php artisan migrate:fresh --seed
   ```

5. **Build Frontend Assets and Start Development Server:**
   ```bash
   npm run dev
   php artisan serve
   ```
   The application will be accessible at `http://127.0.0.1:8000`.

### Docker Setup
If you prefer running the app via Docker:
```bash
docker-compose up -d --build
```
Access the web application at `http://localhost`.

##  Authors
-   **Course:** Web Application Development (TSE3623)
-   OverclockHUB Final Project

