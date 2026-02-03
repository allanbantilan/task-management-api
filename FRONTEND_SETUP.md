# Task Management API - Vue.js Frontend

## ✅ Setup Complete!

Your Task Management application is now ready with:
- **Backend**: Laravel 11 REST API with Sanctum authentication
- **Frontend**: Vue 3 + Vite + Tailwind CSS
- **Features**: Login, Register, Logout, Full CRUD for Tasks

## 🚀 How to Run

### Terminal 1: Start Laravel Backend
```bash
cd /home/allan/PersonalProjects/task-management-api
php artisan serve
```
This will start the API at: http://localhost:8000

### Terminal 2: Start Vite Dev Server
```bash
cd /home/allan/PersonalProjects/task-management-api
npm run dev
```
This will compile and serve the Vue app

### Access the Application
Open your browser and go to: **http://localhost:8000**

## 📋 Features

### Authentication
- ✅ User Registration
- ✅ User Login
- ✅ User Logout
- ✅ Protected Routes

### Task Management
- ✅ Create Task
- ✅ View All Tasks
- ✅ Update Task
- ✅ Delete Task
- ✅ Filter by Status (Pending, In Progress, Completed)
- ✅ Beautiful Tailwind UI

### API Endpoints
```
POST   /api/register          - Register new user
POST   /api/login             - Login user
POST   /api/logout            - Logout user (auth required)
GET    /api/user              - Get authenticated user
GET    /api/tasks             - Get all tasks with filters
POST   /api/tasks             - Create new task
GET    /api/tasks/{id}        - Get single task
PUT    /api/tasks/{id}        - Update task
DELETE /api/tasks/{id}        - Delete task
POST   /api/comments          - Create comment
PUT    /api/comments/{id}     - Update comment
```

## 🛠️ Tech Stack

**Backend:**
- Laravel 11
- Laravel Sanctum (API Authentication)
- MySQL/PostgreSQL
- Swagger/OpenAPI Documentation

**Frontend:**
- Vue 3 (Composition API)
- Vue Router 4
- Axios
- Tailwind CSS 4
- Vite

## 📝 Usage

1. **Register** a new account
2. **Login** with your credentials
3. **Create tasks** with title, description, and status
4. **Edit or delete** tasks as needed
5. **Filter** tasks by status
6. **Logout** when done

## 🔧 Database Setup

Make sure you have:
1. Created the database
2. Configured `.env` file with database credentials
3. Run migrations:
```bash
php artisan migrate
```

## 🎨 UI Features
- Responsive design
- Dark mode support (via Tailwind)
- Modal dialogs for create/edit
- Loading states
- Error handling
- Clean and modern interface

Enjoy your Task Management App! 🎉
