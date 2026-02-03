# Task Management API

A RESTful API built with Laravel for managing tasks and comments. This API provides authentication, task management, and commenting functionality with comprehensive API documentation.

## Features

- 🔐 **Authentication**: User registration and login with Laravel Sanctum
- ✅ **Task Management**: Create, read, update, and delete tasks
- 💬 **Comments**: Add and update comments on tasks
- 📊 **Task Status**: Track tasks with statuses (Pending, In Progress, Completed)
- 📚 **API Documentation**: Auto-generated Swagger/OpenAPI documentation
- 🔒 **Authorization**: Protected routes with token-based authentication

## Tech Stack

- **Framework**: Laravel 12.x
- **PHP**: 8.2+
- **Database**: SQLite (configurable)
- **Authentication**: Laravel Sanctum
- **API Documentation**: L5-Swagger (Swagger/OpenAPI)

## Installation

### Prerequisites

- PHP 8.2 or higher
- Composer
- Node.js & NPM

### Setup

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd task-management-api
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database setup**
   ```bash
   touch database/database.sqlite
   php artisan migrate
   ```

5. **Seed the database** (optional)
   ```bash
   php artisan db:seed --class=UserSeeder
   php artisan db:seed --class=TaskSeeder
   ```

6. **Generate API documentation**
   ```bash
   php artisan l5-swagger:generate
   ```

7. **Start the development server**
   ```bash
   php artisan serve
   ```

The API will be available at `http://localhost:8000`

## API Documentation

Once the server is running, access the interactive API documentation at:

```
http://localhost:8000/api/documentation
```

The Swagger UI provides a complete overview of all endpoints with request/response examples and the ability to test endpoints directly.

## API Endpoints

### Authentication

| Method | Endpoint | Description | Auth Required |
|--------|----------|-------------|---------------|
| POST | `/api/register` | Register a new user | No |
| POST | `/api/login` | Login and get access token | No |
| GET | `/api/user` | Get authenticated user | Yes |

### Tasks

| Method | Endpoint | Description | Auth Required |
|--------|----------|-------------|---------------|
| GET | `/api/tasks` | Get all tasks | Yes |
| POST | `/api/tasks` | Create a new task | Yes |
| GET | `/api/tasks/{id}` | Get a specific task | Yes |
| PUT | `/api/tasks/{id}` | Update a task | Yes |
| DELETE | `/api/tasks/{id}` | Delete a task | Yes |

### Comments

| Method | Endpoint | Description | Auth Required |
|--------|----------|-------------|---------------|
| POST | `/api/comments` | Create a comment on a task | Yes |
| PUT | `/api/comments/{id}` | Update a comment | Yes |

## Usage Examples

### Register a New User

```bash
curl -X POST http://localhost:8000/api/register \
  -H "Content-Type: application/json" \
  -d '{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123",
    "password_confirmation": "password123"
  }'
```

### Login

```bash
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "john@example.com",
    "password": "password123"
  }'
```

Response:
```json
{
  "access_token": "1|abcdefghijklmnopqrstuvwxyz",
  "token_type": "Bearer"
}
```

### Create a Task

```bash
curl -X POST http://localhost:8000/api/tasks \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer YOUR_ACCESS_TOKEN" \
  -d '{
    "title": "Complete project documentation",
    "description": "Write comprehensive API documentation",
    "status": "pending"
  }'
```

### Get All Tasks

```bash
curl -X GET http://localhost:8000/api/tasks \
  -H "Authorization: Bearer YOUR_ACCESS_TOKEN"
```

### Update a Task

```bash
curl -X PUT http://localhost:8000/api/tasks/1 \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer YOUR_ACCESS_TOKEN" \
  -d '{
    "title": "Updated task title",
    "description": "Updated description",
    "status": "in_progress"
  }'
```

### Create a Comment

```bash
curl -X POST http://localhost:8000/api/comments \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer YOUR_ACCESS_TOKEN" \
  -d '{
    "task_id": 1,
    "content": "This is a comment on the task"
  }'
```

## Database Schema

### Users Table
- `id`: Primary key
- `name`: User's full name
- `email`: Unique email address
- `password`: Hashed password
- `email_verified_at`: Email verification timestamp
- `timestamps`: created_at, updated_at

### Tasks Table
- `id`: Primary key
- `user_id`: Foreign key to users
- `title`: Task title
- `description`: Task description (nullable)
- `status`: Task status (pending, in_progress, completed)
- `timestamps`: created_at, updated_at

### Comments Table
- `id`: Primary key
- `user_id`: Foreign key to users
- `task_id`: Foreign key to tasks
- `content`: Comment content
- `timestamps`: created_at, updated_at

## Task Statuses

Tasks can have one of the following statuses:

- `pending`: Task is pending and not yet started
- `in_progress`: Task is currently being worked on
- `completed`: Task has been completed

## Testing

Run the test suite:

```bash
php artisan test
```

## Seeded Test Data

If you run the seeders, you'll get:
- **15 users** with realistic names and emails
- **55 tasks** with various statuses and realistic descriptions
- All seeded users have password: `password`

Example seeded users:
- john.anderson@example.com
- sarah.mitchell@example.com
- michael.chen@example.com

## Development

### Generate API Documentation

After making changes to API endpoints:

```bash
php artisan l5-swagger:generate
```

### Code Formatting

```bash
./vendor/bin/pint
```

### Clear Cache

```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
```

## Project Structure

```
app/
├── Enums/
│   └── TaskStatus.php          # Task status enum
├── Http/
│   ├── Controllers/
│   │   └── Api/
│   │       ├── CommentController.php
│   │       ├── LoginController.php
│   │       ├── RegisterController.php
│   │       └── TaskController.php
│   ├── Requests/              # Form validation requests
│   └── Resources/             # API resources
├── Models/
│   ├── Comment.php
│   ├── Task.php
│   └── User.php
database/
├── migrations/                # Database migrations
└── seeders/                   # Database seeders
    ├── TaskSeeder.php
    └── UserSeeder.php
routes/
└── api.php                    # API route definitions
```

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Support

For issues, questions, or contributions, please open an issue in the repository.
