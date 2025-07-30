# Laravel E-Commerce Platform

A full-featured e-commerce web application built with Laravel 12, featuring a complete admin panel, shopping cart functionality, and user management system.

## 🚀 Features

### Core Functionality

-   **Product Management**: Complete CRUD operations for products with categories, pricing, discounts, and inventory tracking
-   **Category Management**: Hierarchical product categorization system
-   **Order Management**: Full order lifecycle management with status tracking (pending, paid, shipped)
-   **Shopping Cart**: Add to cart, update quantities, remove items, and checkout functionality
-   **User Authentication**: Laravel Breeze integration with role-based access control

### Admin Panel

-   **Role-Based Access**: Secure admin panel with middleware protection
-   **Product Administration**: Create, edit, delete, and manage product inventory
-   **Category Administration**: Manage product categories and organization
-   **Order Administration**: View and manage customer orders
-   **User Management**: Promote users to admin roles via console commands

### Client Interface

-   **Responsive Design**: Bootstrap-based responsive frontend
-   **Product Catalog**: Browse products by categories with search functionality
-   **Shopping Experience**: Add products to cart, manage quantities, and checkout
-   **User Dashboard**: Personal profile and order history management

## 🛠️ Technology Stack

-   **Backend**: Laravel 12.x with PHP 8.2+
-   **Authentication**: Laravel Breeze
-   **Frontend**: Bootstrap 5, HTML5, CSS3, JavaScript
-   **Database**: MySQL/SQLite (configurable)
-   **Development Tools**: Laravel Sail, Vite, NPM

## 📁 Project Structure

```
finalLaravelProject/
├── app/
│   ├── Console/Commands/          # Custom Artisan commands
│   ├── Http/
│   │   ├── Controllers/           # Application controllers
│   │   │   ├── Auth/             # Authentication controllers
│   │   │   ├── UserControllers/  # User-specific controllers
│   │   │   └── [Admin, Cart, Category, Order, Product]Controller.php
│   │   ├── Middleware/           # Custom middleware (AdminMiddleware)
│   │   └── Requests/            # Form request validation
│   ├── Models/                   # Eloquent models
│   └── View/Components/         # Blade components
├── database/
│   ├── migrations/              # Database schema migrations
│   └── seeders/                # Database seeders
├── public/
│   ├── adminFront/             # Admin panel assets
│   └── clientFront/            # Client interface assets
├── resources/
│   └── views/
│       ├── adminViews/         # Admin panel views
│       ├── clientViews/        # Client interface views
│       └── auth/              # Authentication views
└── routes/
    ├── web.php                # Web routes
    └── auth.php              # Authentication routes
```

## 🚀 Quick Start

### Prerequisites

-   PHP 8.2 or higher
-   Composer
-   Node.js and NPM
-   MySQL or SQLite

### Installation

1. **Install dependencies**

    ```bash
    composer install
    npm install
    ```

2. **Environment setup**

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

3. **Database configuration**

    - Update `.env` file with your database credentials
    - For SQLite: `touch database/database.sqlite`

4. **Run migrations and seeders**

    ```bash
    copy .env.example .env
    php artisan key:generate
    php artisan migrate
    php artisan db:seed
    ```

5. **Build assets**

    ```bash
    npm run build
    # or for development
    npm run dev
    ```

6. **Start the application**
    ```bash
    php artisan serve
    ```

The application will be available at `http://localhost:8000`

## 👤 User Management

### Creating Admin Users

Use the custom Artisan command to promote existing users to admin:

```bash
php artisan make:admin user@example.com
```

### Default Roles

-   **Admin**: Full access to admin panel and all management features
-   **User**: Access to client interface, shopping cart, and order history

## 📊 Database Schema

### Core Tables

-   **users**: User accounts with role-based access
-   **categories**: Product categories
-   **products**: Product catalog with pricing, inventory, and discounts
-   **orders**: Customer orders with status tracking
-   **order_items**: Individual items within orders

### Key Relationships

-   Products belong to Categories
-   Orders belong to Users
-   Orders have many Order Items
-   Order Items reference Products

## 🛣️ Route Structure

### Public Routes

-   `/` - Client homepage and product catalog
-   `/cart/*` - Shopping cart operations
-   `/login`, `/register` - Authentication

### Protected Routes (Auth Required)

-   `/dashboard` - User dashboard
-   `/profile/*` - Profile management

### Admin Routes (Admin Role Required)

-   `/admin` - Admin dashboard
-   `/products/*` - Product management
-   `/category/*` - Category management
-   `/order/*` - Order management

## 🎨 Frontend Assets

### Admin Panel

-   **Framework**: Bootstrap with custom admin theme
-   **Location**: `public/adminFront/`
-   **Features**: Responsive dashboard, data tables, form validation

### Client Interface

-   **Framework**: Bootstrap with modern e-commerce design
-   **Location**: `public/clientFront/`
-   **Features**: Product galleries, shopping cart, responsive design

## 🔒 Security Features

-   **Authentication**: Laravel Breeze with session-based auth
-   **Authorization**: Role-based middleware protection
-   **CSRF Protection**: Built-in Laravel CSRF tokens
-   **Input Validation**: Form request validation
-   **Route Protection**: Middleware-based access control

## 🧪 Testing

Run the test suite:

```bash
php artisan test
```

## 📦 Development

### Available Scripts

```bash
# Development server with hot reload
composer run dev

# Run tests
composer run test

# Code formatting
php artisan pint
```

### Key Development Features

-   **Hot Module Replacement**: Vite integration for fast development
-   **Code Standards**: Laravel Pint for code formatting
-   **Database**: Migrations and seeders for consistent development environment

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 🆘 Support

For support and questions:

-   Check the [Laravel Documentation](https://laravel.com/docs)
-   Review the project's issue tracker
-   Consult the inline code comments and documentation

---

**Built with ❤️ using Laravel Framework**
