.PHONY: help up down build rebuild restart logs ps shell composer artisan migrate migrate-fresh seed test cache-clear install stop clean

# Colors for terminal output
BLUE := \033[0;34m
GREEN := \033[0;32m
YELLOW := \033[0;33m
RED := \033[0;31m
NC := \033[0m # No Color

help: ## Show this help message
	@echo "$(BLUE)Task Management API - Docker Commands$(NC)"
	@echo ""
	@echo "$(GREEN)Available commands:$(NC)"
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "  $(YELLOW)%-20s$(NC) %s\n", $$1, $$2}'
	@echo ""

# Docker Compose Commands
up: ## Start all containers in detached mode
	@echo "$(BLUE)Starting containers...$(NC)"
	docker-compose up -d
	@echo "$(GREEN)✓ Containers started successfully$(NC)"
	@echo "$(YELLOW)Application available at: http://localhost:8000$(NC)"

down: ## Stop and remove all containers
	@echo "$(BLUE)Stopping containers...$(NC)"
	docker-compose down
	@echo "$(GREEN)✓ Containers stopped$(NC)"

build: ## Build all Docker images
	@echo "$(BLUE)Building Docker images...$(NC)"
	docker-compose build --no-cache
	@echo "$(GREEN)✓ Build completed$(NC)"

rebuild: down build up ## Rebuild and restart all containers

restart: ## Restart all containers
	@echo "$(BLUE)Restarting containers...$(NC)"
	docker-compose restart
	@echo "$(GREEN)✓ Containers restarted$(NC)"

stop: ## Stop all containers without removing them
	@echo "$(BLUE)Stopping containers...$(NC)"
	docker-compose stop
	@echo "$(GREEN)✓ Containers stopped$(NC)"

ps: ## Show running containers
	docker-compose ps

logs: ## Show logs from all containers
	docker-compose logs -f

logs-app: ## Show logs from app container
	docker-compose logs -f app

logs-nginx: ## Show logs from nginx container
	docker-compose logs -f nginx

logs-mysql: ## Show logs from mysql container
	docker-compose logs -f mysql

# Container Access
shell: ## Access app container shell
	docker-compose exec app bash

shell-mysql: ## Access MySQL shell
	docker-compose exec mysql mysql -u root -p

# Laravel Commands
install: ## Install application (composer, npm, generate key, migrate)
	@echo "$(BLUE)Installing application...$(NC)"
	@make composer-install
	@make npm-install
	@make npm-build
	@make key-generate
	@make migrate
	@echo "$(GREEN)✓ Application installed successfully$(NC)"

composer: ## Run composer command (usage: make composer cmd="install package")
	docker-compose exec app composer $(cmd)

composer-install: ## Install PHP dependencies
	@echo "$(BLUE)Installing PHP dependencies...$(NC)"
	docker-compose exec app composer install
	@echo "$(GREEN)✓ PHP dependencies installed$(NC)"

composer-update: ## Update PHP dependencies
	docker-compose exec app composer update

artisan: ## Run artisan command (usage: make artisan cmd="route:list")
	docker-compose exec app php artisan $(cmd)
	@docker-compose exec -u root app chown -R 1000:1000 /var/www/html/app /var/www/html/database 2>/dev/null || true

key-generate: ## Generate application key
	@echo "$(BLUE)Generating application key...$(NC)"
	docker-compose exec app php artisan key:generate
	@echo "$(GREEN)✓ Application key generated$(NC)"

migrate: ## Run database migrations
	@echo "$(BLUE)Running migrations...$(NC)"
	docker-compose exec app php artisan migrate --force
	@echo "$(GREEN)✓ Migrations completed$(NC)"

migrate-fresh: ## Fresh database with migrations
	@echo "$(YELLOW)⚠ Warning: This will drop all tables!$(NC)"
	docker-compose exec app php artisan migrate:fresh --force

migrate-rollback: ## Rollback last migration
	docker-compose exec app php artisan migrate:rollback

seed: ## Seed the database
	@echo "$(BLUE)Seeding database...$(NC)"
	docker-compose exec app php artisan db:seed
	@echo "$(GREEN)✓ Database seeded$(NC)"

migrate-seed: migrate seed ## Run migrations and seed database

fresh-seed: ## Fresh database with migrations and seed
	@echo "$(BLUE)Refreshing database...$(NC)"
	docker-compose exec app php artisan migrate:fresh --seed --force
	@echo "$(GREEN)✓ Database refreshed$(NC)"

# Testing
test: ## Run PHPUnit tests
	docker-compose exec app php artisan test

test-coverage: ## Run tests with coverage
	docker-compose exec app php artisan test --coverage

# Cache Commands
cache-clear: ## Clear all Laravel caches
	@echo "$(BLUE)Clearing caches...$(NC)"
	docker-compose exec app php artisan cache:clear
	docker-compose exec app php artisan config:clear
	docker-compose exec app php artisan route:clear
	docker-compose exec app php artisan view:clear
	@echo "$(GREEN)✓ All caches cleared$(NC)"

config-cache: ## Cache configuration
	docker-compose exec app php artisan config:cache

route-cache: ## Cache routes
	docker-compose exec app php artisan route:cache

view-cache: ## Cache views
	docker-compose exec app php artisan view:cache

optimize: ## Optimize the application
	docker-compose exec app php artisan optimize

# Storage & Permissions
storage-link: ## Create storage symbolic link
	docker-compose exec app php artisan storage:link

permissions: ## Fix storage and cache permissions
	@echo "$(BLUE)Fixing permissions...$(NC)"
	docker-compose exec -u root app chown -R 1000:1000 /var/www/html
	docker-compose exec app chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache
	@echo "$(GREEN)✓ Permissions fixed$(NC)"

# Database Commands
db-dump: ## Dump database to file
	@echo "$(BLUE)Dumping database...$(NC)"
	docker-compose exec mysql mysqldump -u root -psecret task_management > backup_$$(date +%Y%m%d_%H%M%S).sql
	@echo "$(GREEN)✓ Database dumped$(NC)"

db-import: ## Import database from file (usage: make db-import file=backup.sql)
	@echo "$(BLUE)Importing database...$(NC)"
	docker-compose exec -T mysql mysql -u root -psecret task_management < $(file)
	@echo "$(GREEN)✓ Database imported$(NC)"

# Cleanup Commands
clean: down ## Remove containers, volumes, and images
	@echo "$(RED)Removing all containers, volumes, and images...$(NC)"
	docker-compose down -v --rmi all
	@echo "$(GREEN)✓ Cleanup completed$(NC)"

clean-volumes: ## Remove all volumes
	@echo "$(RED)Removing volumes...$(NC)"
	docker-compose down -v
	@echo "$(GREEN)✓ Volumes removed$(NC)"

# NPM Commands
npm: ## Run npm command (usage: make npm cmd="install package")
	docker-compose exec app npm $(cmd)

npm-install: ## Install Node dependencies
	docker-compose exec app npm install

npm-build: ## Build frontend assets
	docker-compose exec app npm run build

npm-dev: ## Run frontend in development mode
	docker-compose exec app npm run dev

# API Documentation
swagger-generate: ## Generate Swagger documentation
	docker-compose exec app php artisan l5-swagger:generate

# Quick Start
init: build up install storage-link permissions ## Initialize project from scratch
	@echo "$(GREEN)✓ Project initialized successfully!$(NC)"
	@echo "$(YELLOW)Access the application at: http://localhost:8000$(NC)"
	@echo "$(YELLOW)API Documentation at: http://localhost:8000/api/documentation$(NC)"
