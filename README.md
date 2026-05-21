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

## Setup Instructions

### 1. Extract ZIP

Extract the project zip file.

### 2. Install Dependencies

```bash
composer install
```

### 3. Environment File

`.env` file and SQLite database are already included in the project.

### 4. Clear Cache (Optional)

```bash
php artisan optimize:clear
```

### 5. Run Project

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

Use token in Authorization header:

```text
Authorization: Bearer your_token
```

---

## API Endpoints

### Authentication APIs

| Method | Endpoint |
|--------|----------|
| POST | /api/register |
| POST | /api/login |
| POST | /api/logout |

### Task APIs

| Method | Endpoint |
|--------|----------|
| POST | /api/tasks |
| GET | /api/tasks |
| PUT | /api/tasks/{id} |
| DELETE | /api/tasks/{id} |

### Task Listing Features

- Pagination
- Filter by status

Example:

```text
/api/tasks?status=pending&page=1
```

---

## Validation Rules

### Password
- Minimum 8 characters
- At least one letter
- At least one number

### Status
Allowed values:
- pending
- in_progress
- completed

### Priority
Allowed values:
- low
- medium
- high

---

## Database Schema

### Users Table

Default Laravel users table is used. Below are the columns used in this project:

- id
- name
- email
- password

### Tasks Table

- id
- user_id
- title
- description
- status
- priority
- due_date

### Relationship

One User Has Many Tasks

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