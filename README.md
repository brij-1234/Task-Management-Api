# Task Management REST API

A Task Management REST API built using Laravel.

## Features

- User Registration
- User Login
- User Logout
- Task CRUD APIs
- Pagination
- Filter Tasks by Status
- Laravel Sanctum Authentication
- Form Request Validation
- API Resources

---

## Tech Stack

- PHP 8.2
- Laravel 12
- SQLite
- Laravel Sanctum

---

## Repository

GitHub Repository:

```text
https://github.com/brij-1234/Task-Management-Api
```

---

## Setup Instructions

### 1. Clone Repository

```bash
git clone https://github.com/brij-1234/Task-Management-Api.git
cd Task-Management-Api
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Create Environment File

Copy `.env.example` file:

```bash
cp .env.example .env
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Database Configuration

This project uses **SQLite**.

SQLite database file is already included in:

```text
database/database.sqlite
```

Update the following in `.env`:

```env
DB_CONNECTION=sqlite
```

### 6. Clear Cache (Optional)

```bash
php artisan optimize:clear
```

### 7. Run Project

```bash
php artisan serve
```

Project URL:

```text
http://127.0.0.1:8000
```

---

## Authentication

This project uses Laravel Sanctum authentication.

After login, copy the generated token and add it in Postman using:

- Authorization Type: `Bearer Token`
- Paste only the token value

Example HTTP header:

```text
Authorization: Bearer your_token
```

---

## API Endpoints

### Authentication APIs

#### Register User

**POST** `/api/register`

Request Body:

```json
{
  "name": "Brij Kishore",
  "email": "brij.kishore@gmail.com",
  "password": "password123",
  "password_confirmation": "password123"
}
```

---

#### Login User

**POST** `/api/login`

Request Body:

```json
{
  "email": "brij.kishore@gmail.com",
  "password": "password123"
}
```

---

#### Logout User

**POST** `/api/logout`

Authorization:

```text
Bearer Token
```

---

### Task APIs

#### Create Task

**POST** `/api/tasks`

Request Body:

```json
{
  "title": "Crud system of laravel",
  "description": "The description of crud system",
  "status": "pending",
  "priority": "high",
  "due_date": "2026-06-20"
}
```

---

#### List Tasks

**GET** `/api/tasks`

Supports:

- Pagination
- Filter by status

Example:

```text
/api/tasks?status=pending&page=1
```

---

#### Update Task

**PUT** `/api/tasks/{id}`

Request Body:

```json
{
  "title": "Updated Task Title",
  "description": "Updated description",
  "status": "completed",
  "priority": "medium",
  "due_date": "2026-06-20"
}
```

---

#### Delete Task

**DELETE** `/api/tasks/{id}`

---

## Validation Rules

### Registration

#### Name
- Required
- String

#### Email
- Required
- Must be a valid email
- Must be unique

#### Password
Password must:

- Be at least 8 characters long
- Contain at least one letter
- Contain at least one number

#### Password Confirmation
- Required
- Must match the password

---

### Task Fields

#### Title
- Required
- String

#### Description
- Optional

#### Status
Allowed values:

- pending
- in_progress
- completed

#### Priority
Allowed values:

- low
- medium
- high

#### Due Date
- Must be a valid date
- Format: `YYYY-MM-DD`

Example:

```text
2026-06-20
```

---

## Database Schema

### Users Table

Default Laravel users table is used for authentication.

| Column | Description |
|--------|-------------|
| id | Primary Key |
| name | User name |
| email | Unique email address |
| password | Hashed password |

### Tasks Table

| Column | Description |
|--------|-------------|
| id | Primary Key |
| user_id | Foreign key referencing users table |
| title | Task title |
| description | Task description |
| status | Task status (pending, in_progress, completed) |
| priority | Task priority (low, medium, high) |
| due_date | Task due date |

### Relationship

- One User Has Many Tasks
- One Task Belongs To One User

```text
users.id → tasks.user_id
```

---

## Postman Collection

Postman collection is included in the project.

File:

```text
Task-Management-API.postman_collection.json
```