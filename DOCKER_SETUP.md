# Docker Setup Guide

This project is fully dockerized with MySQL database, Redis caching, and Nginx web server.

## Prerequisites

- Docker Engine 20.10+
- Docker Compose 1.29+
- Make (optional but recommended)

## Quick Start

### Option 1: Using Make (Recommended)

```bash
# Initialize the project (first time setup)
make init

# Or step by step:
make build          # Build Docker images
make up             # Start containers
make install        # Install dependencies and run migrations
```

### Option 2: Using Docker Compose directly

```bash
# Build and start containers
docker-compose up -d --build

# Install dependencies
docker-compose exec app composer install
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate
docker-compose exec app php artisan storage:link
```

## Available Make Commands

### Docker Management
- `make up` - Start all containers
- `make down` - Stop and remove containers
- `make restart` - Restart all containers
- `make build` - Build Docker images
- `make rebuild` - Rebuild and restart containers
- `make ps` - Show running containers
- `make logs` - Show logs from all containers
- `make logs-app` - Show logs from app container
- `make logs-nginx` - Show logs from nginx container
- `make logs-mysql` - Show logs from MySQL container

### Application Setup
- `make init` - Complete project initialization
- `make install` - Install dependencies and setup app
- `make shell` - Access app container bash
- `make shell-mysql` - Access MySQL shell

### Laravel Commands
- `make artisan cmd="route:list"` - Run artisan commands
- `make migrate` - Run database migrations
- `make migrate-fresh` - Fresh migrations (drops all tables)
- `make seed` - Seed the database
- `make fresh-seed` - Fresh migrations + seed
- `make test` - Run PHPUnit tests
- `make cache-clear` - Clear all caches
- `make optimize` - Optimize application

### Composer Commands
- `make composer cmd="install package"` - Run composer commands
- `make composer-install` - Install PHP dependencies
- `make composer-update` - Update PHP dependencies

### NPM Commands
- `make npm cmd="install package"` - Run npm commands
- `make npm-install` - Install Node dependencies
- `make npm-build` - Build frontend assets

### Database Management
- `make db-dump` - Dump database to SQL file
- `make db-import file=backup.sql` - Import database from SQL file

### Cleanup
- `make clean` - Remove containers, volumes, and images
- `make clean-volumes` - Remove all volumes

### Help
- `make help` - Show all available commands

## Services

The Docker setup includes the following services:

### Application (PHP-FPM)
- **Container:** task-management-app
- **PHP Version:** 8.2-fpm
- **Port:** Internal (9000)

### Nginx Web Server
- **Container:** task-management-nginx
- **Port:** 8000 → 80
- **URL:** http://localhost:8000

### MySQL Database
- **Container:** task-management-mysql
- **Port:** 3306
- **Database:** task_management
- **Username:** root
- **Password:** secret

### Redis Cache
- **Container:** task-management-redis
- **Port:** 6379

## Environment Configuration

1. Copy the environment file:
```bash
cp .env.example .env
```

2. The default configuration works with Docker out of the box:
```env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=task_management
DB_USERNAME=root
DB_PASSWORD=secret

REDIS_HOST=redis
REDIS_PORT=6379
```

## Accessing the Application

- **Application:** http://localhost:8000
- **API Endpoints:** http://localhost:8000/api
- **API Documentation:** http://localhost:8000/api/documentation

## Common Tasks

### Running Migrations
```bash
make migrate
```

### Seeding Database
```bash
make seed
```

### Fresh Start with Sample Data
```bash
make fresh-seed
```

### Accessing the Container
```bash
make shell
```

### Viewing Logs
```bash
make logs        # All services
make logs-app    # Application only
make logs-mysql  # MySQL only
```

### Running Tests
```bash
make test
```

### Clearing Cache
```bash
make cache-clear
```

## Troubleshooting

### Permission Issues
```bash
make permissions
```

### Rebuild Everything
```bash
make rebuild
```

### Complete Cleanup and Fresh Start
```bash
make clean
make init
```

### MySQL Connection Issues
1. Ensure MySQL container is healthy:
```bash
make ps
```

2. Check MySQL logs:
```bash
make logs-mysql
```

3. Verify environment variables in `.env` file

## Development Workflow

1. Start containers:
```bash
make up
```

2. Make your changes to the code

3. If you modify database schema:
```bash
make migrate
```

4. If you modify routes or config:
```bash
make cache-clear
```

5. View logs if issues arise:
```bash
make logs-app
```

6. Stop containers when done:
```bash
make down
```

## Production Deployment

For production, modify the docker-compose.yml to use the production target:

```yaml
app:
  build:
    target: production
```

And set appropriate environment variables in `.env`:
```env
APP_ENV=production
APP_DEBUG=false
```

## Notes

- The application volume is mounted for development, so changes are reflected immediately
- MySQL data persists in a Docker volume named `mysql-data`
- Redis data persists in a Docker volume named `redis-data`
- Storage and cache directories have proper permissions for www-data user
