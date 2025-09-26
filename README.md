
## 🚀 Laravel 12 Sanctum API Practice Project

This project is a **practice API backend** built with **Laravel 12** and **Sanctum**.
It demonstrates how to:

* Build a secure REST API with **Laravel Sanctum**
* Handle **user registration & authentication**
* Protect routes using `auth:sanctum` middleware
* Implement a simple **Post resource** (CRUD-style)

---

## 📂 Project Structure

```
/app
  /Http
    /Controllers
      AuthController.php   # Handles user registration, login, logout
      PostController.php   # Handles post CRUD
    /Requests
      RegisterRequest.php  # Validation rules for registration
      LoginRequest.php     # Validation rules for login
/app/Models
  User.php                # User model with HasApiTokens
  Post.php                # Post model with relationship to User
/routes
  api.php                 # API routes
  web.php                 # Blade views for testing
/resources/views          # Blade views for register, login, posts
/bootstrap/app.php        # Middleware & route groups configuration
```

---

## ⚙️ Requirements

* PHP 8.2+
* Composer
* SQlite (or MYSQL/Postgres )
* Laravel 12
* Postman (for testing)

---

## 🔧 Installation & Setup

### 1️⃣ Clone Project & Install Dependencies

```bash
git clone https://github.com/yourusername/laravel12-sanctum-api.git
cd laravel12-sanctum-api
composer install
npm install && npm run build   # optional if using frontend
```

### 2️⃣ Configure Environment

Copy `.env.example` → `.env` and update:

```env
APP_NAME=Laravel Sanctum API
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=sqlite
#DB_HOST=127.0.0.1
#DB_PORT=3306
#DB_DATABASE=sanctum_api
#DB_USERNAME=root
#DB_PASSWORD=
```

### 3️⃣ Generate App Key

```bash
php artisan key:generate
```

### 4️⃣ Run Migrations

```bash
php artisan migrate
```

This creates:

* `users` table
* `personal_access_tokens` table (for Sanctum)
* `posts` table

### 5️⃣ Serve Application

```bash
php artisan serve
```

API available at:

```
http://127.0.0.1:8000/api
```

---

## 🔑 Authentication

This project uses **Laravel Sanctum** for authentication.

* On **register**, a new API token is created.
* On **login**, the user receives a new token.
* This token must be sent in the **Authorization header**:

```http
Authorization: Bearer <your_token>
```

---

## API Endpoints

### Authentication

#### Register

```http
POST /api/register
```

**Body (JSON):**

```json
{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "password123",
  "password_confirmation": "password123"
}
```

**Response:**

```json
{
  "status": "success",
  "message": "User registered successfully",
  "data": {
    "user": {
      "id": 1,
      "name": "John Doe",
      "email": "john@example.com"
    },
    "access_token": "1|xyz123...",
    "token_type": "Bearer"
  }
}
```

---

#### Login

```http
POST /api/login
```

**Body (JSON):**

```json
{
  "email": "john@example.com",
  "password": "password123"
}
```

**Response:**

```json
{
  "status": "success",
  "message": "Login successful",
  "data": {
    "user": {
      "id": 1,
      "name": "John Doe",
      "email": "john@example.com"
    },
    "access_token": "1|xyz123...",
    "token_type": "Bearer"
  }
}
```

---

#### Logout

```http
POST /api/logout
```

**Headers:**

```
Authorization: Bearer <your_token>
```

**Response:**

```json
{
  "status": "success",
  "message": "Logged out successfully"
}
```

---

### Posts

#### Get All Posts (Public)

```http
GET /api/posts
```

**Response:**

```json
{
  "status": "success",
  "data": [
    {
      "id": 1,
      "title": "First Post",
      "content": "Hello world!",
      "user": {
        "id": 1,
        "name": "John Doe"
      }
    }
  ]
}
```

---

#### Create Post (Protected)

```http
POST /api/posts
```

**Headers:**

```
Authorization: Bearer <your_token>
```

**Body (JSON):**

```json
{
  "title": "New Post",
  "content": "This is my new post"
}
```

**Response:**

```json
{
  "status": "success",
  "message": "Post created successfully",
  "data": {
    "id": 2,
    "title": "New Post",
    "content": "This is my new post",
    "user_id": 1
  }
}
```

---

## Testing With Postman

1. Register a new user (`POST /api/register`).
2. Copy the `access_token` from the response.
3. Use it in **Authorization Header** for protected requests:

   ```
   Authorization: Bearer <your_token>
   ```
4. Test `GET /api/posts` (public).
5. Test `POST /api/posts` (requires token).
6. Logout with `POST /api/logout`.

---

## Optional Frontend (Blade)

This project also includes **simple Blade views** for:

* `/register` → Registration form
* `/login` → Login form
* `/posts` → Dashboard with post creation + listing

These views use **vanilla JS + fetch()** to call the API.

---

## Learning Outcomes

Learnings:

* How to install and configure Laravel Sanctum in Laravel 12
* How to build authentication endpoints (register/login/logout)
* How to protect API routes using `auth:sanctum`
* How to build a simple resource controller (`PostController`)
* How to test APIs with **Postman**
* How to connect Blade views with your API

---

## License

This project is open-source and free to use for **learning purposes**.

---

👉 Do you want me to also add **full CRUD (update, delete) for posts** in this README so it looks like a real-world API doc?

