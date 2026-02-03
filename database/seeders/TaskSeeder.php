<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use App\Models\Category;
use App\Enums\TaskStatus;
use App\Enums\PriorityEnum;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $categories = Category::all();

        if ($users->isEmpty()) {
            $this->command->warn('No users found. Please seed users first.');
            return;
        }

        if ($categories->isEmpty()) {
            $this->command->warn('No categories found. Please seed categories first.');
            return;
        }

        // Get category IDs by name for easier assignment
        $workId = $categories->where('name', 'Work')->first()?->id;
        $personalId = $categories->where('name', 'Personal')->first()?->id;
        $educationId = $categories->where('name', 'Education')->first()?->id;
        $financeId = $categories->where('name', 'Finance')->first()?->id;
        $healthId = $categories->where('name', 'Health')->first()?->id;

        $tasks = [
            ['title' => 'Review pull request #234', 'description' => 'Review the authentication refactoring PR and provide feedback on code quality and security concerns.', 'status' => TaskStatus::PENDING, 'priority' => PriorityEnum::MEDIUM, 'category_id' => $workId],
            ['title' => 'Update project documentation', 'description' => 'Update README with new API endpoints and installation instructions for the latest version.', 'status' => TaskStatus::IN_PROGRESS, 'priority' => PriorityEnum::LOW, 'category_id' => $workId],
            ['title' => 'Fix login bug on mobile', 'description' => 'Users are reporting issues with login on iOS devices. Investigate and fix the responsive design issue.', 'status' => TaskStatus::COMPLETED, 'priority' => PriorityEnum::HIGH, 'category_id' => $workId],
            ['title' => 'Fix login bug on mobile', 'description' => 'Users are reporting issues with login on iOS devices. Investigate and fix the responsive design issue.', 'status' => TaskStatus::COMPLETED, 'priority' => PriorityEnum::HIGH, 'category_id' => $workId],
            ['title' => 'Optimize database queries', 'description' => 'Identify and optimize slow queries in the reports module. Target: reduce load time by 50%.', 'status' => TaskStatus::PENDING, 'priority' => PriorityEnum::HIGH, 'category_id' => $workId],
            ['title' => 'Write unit tests for payment module', 'description' => 'Create comprehensive unit tests covering all payment processing scenarios including edge cases.', 'status' => TaskStatus::IN_PROGRESS, 'priority' => PriorityEnum::MEDIUM, 'category_id' => $financeId],
            ['title' => 'Upgrade Laravel to version 11', 'description' => 'Plan and execute Laravel framework upgrade. Test all features thoroughly before deploying.', 'status' => TaskStatus::PENDING, 'priority' => PriorityEnum::HIGH, 'category_id' => $workId],
            ['title' => 'Design new dashboard layout', 'description' => 'Create mockups for the new admin dashboard with improved UX and modern design patterns.', 'status' => TaskStatus::COMPLETED, 'priority' => PriorityEnum::MEDIUM, 'category_id' => $workId],
            ['title' => 'Implement email notifications', 'description' => 'Set up email notifications for task assignments, deadlines, and status changes using queues.', 'status' => TaskStatus::IN_PROGRESS, 'priority' => PriorityEnum::MEDIUM, 'category_id' => $workId],
            ['title' => 'Configure CI/CD pipeline', 'description' => 'Set up GitHub Actions for automated testing, linting, and deployment to staging environment.', 'status' => TaskStatus::COMPLETED, 'priority' => PriorityEnum::HIGH, 'category_id' => $workId],
            ['title' => 'Refactor authentication system', 'description' => 'Migrate from session-based auth to Sanctum tokens for better API support and security.', 'status' => TaskStatus::PENDING, 'priority' => PriorityEnum::HIGH, 'category_id' => $workId],
            ['title' => 'Add search functionality', 'description' => 'Implement full-text search for tasks using Laravel Scout and Meilisearch.', 'status' => TaskStatus::IN_PROGRESS, 'priority' => PriorityEnum::MEDIUM, 'category_id' => $workId],
            ['title' => 'Create API documentation', 'description' => 'Generate comprehensive API documentation using Swagger/OpenAPI specifications.', 'status' => TaskStatus::COMPLETED, 'priority' => PriorityEnum::LOW, 'category_id' => $workId],
            ['title' => 'Fix memory leak in background jobs', 'description' => 'Investigate and resolve memory leak occurring in long-running queue workers.', 'status' => TaskStatus::PENDING, 'priority' => PriorityEnum::HIGH, 'category_id' => $workId],
            ['title' => 'Implement rate limiting', 'description' => 'Add rate limiting to API endpoints to prevent abuse and ensure fair usage.', 'status' => TaskStatus::COMPLETED, 'priority' => PriorityEnum::MEDIUM, 'category_id' => $workId],
            ['title' => 'Setup monitoring and alerts', 'description' => 'Configure application monitoring using Laravel Telescope and set up alerts for critical errors.', 'status' => TaskStatus::IN_PROGRESS, 'priority' => PriorityEnum::HIGH, 'category_id' => $workId],
            ['title' => 'Optimize image upload process', 'description' => 'Implement image compression and lazy loading for better performance on slow connections.', 'status' => TaskStatus::PENDING, 'priority' => PriorityEnum::LOW, 'category_id' => $workId],
            ['title' => 'Add export to CSV feature', 'description' => 'Allow users to export task lists and reports to CSV format with filtering options.', 'status' => TaskStatus::COMPLETED, 'priority' => PriorityEnum::LOW, 'category_id' => $workId],
            ['title' => 'Implement two-factor authentication', 'description' => 'Add 2FA support using TOTP (Time-based One-Time Password) for enhanced security.', 'status' => TaskStatus::PENDING, 'priority' => PriorityEnum::HIGH, 'category_id' => $workId],
            ['title' => 'Fix timezone handling issues', 'description' => 'Resolve timezone conversion problems affecting task due dates and scheduling.', 'status' => TaskStatus::IN_PROGRESS, 'priority' => PriorityEnum::MEDIUM, 'category_id' => $workId],
            ['title' => 'Create admin dashboard widgets', 'description' => 'Build interactive widgets showing key metrics, recent activities, and system health.', 'status' => TaskStatus::COMPLETED, 'priority' => PriorityEnum::MEDIUM, 'category_id' => $workId],
            ['title' => 'Implement task commenting system', 'description' => 'Add ability for users to comment on tasks with real-time updates and notifications.', 'status' => TaskStatus::PENDING, 'priority' => PriorityEnum::MEDIUM, 'category_id' => $workId],
            ['title' => 'Optimize frontend bundle size', 'description' => 'Reduce JavaScript bundle size by implementing code splitting and lazy loading.', 'status' => TaskStatus::IN_PROGRESS, 'priority' => PriorityEnum::LOW, 'category_id' => $workId],
            ['title' => 'Setup backup automation', 'description' => 'Configure automated daily backups of database and uploaded files to cloud storage.', 'status' => TaskStatus::COMPLETED, 'priority' => PriorityEnum::HIGH, 'category_id' => $workId],
            ['title' => 'Add file attachment support', 'description' => 'Allow users to attach files to tasks with proper validation and virus scanning.', 'status' => TaskStatus::PENDING, 'priority' => PriorityEnum::MEDIUM, 'category_id' => $workId],
            ['title' => 'Implement dark mode', 'description' => 'Add dark mode theme option with system preference detection and smooth transitions.', 'status' => TaskStatus::IN_PROGRESS, 'priority' => PriorityEnum::LOW, 'category_id' => $personalId],
            ['title' => 'Fix CORS issues for API', 'description' => 'Configure CORS middleware properly to allow requests from authorized frontend domains.', 'status' => TaskStatus::COMPLETED, 'priority' => PriorityEnum::HIGH, 'category_id' => $workId],
            ['title' => 'Create mobile app mockups', 'description' => 'Design UI mockups for native mobile application for iOS and Android platforms.', 'status' => TaskStatus::PENDING, 'priority' => PriorityEnum::MEDIUM, 'category_id' => $workId],
            ['title' => 'Implement task templates', 'description' => 'Add feature to create reusable task templates for common workflows and processes.', 'status' => TaskStatus::IN_PROGRESS, 'priority' => PriorityEnum::MEDIUM, 'category_id' => $workId],
            ['title' => 'Setup Redis caching', 'description' => 'Configure Redis for caching frequently accessed data and session management.', 'status' => TaskStatus::COMPLETED, 'priority' => PriorityEnum::HIGH, 'category_id' => $workId],
            ['title' => 'Add task dependencies', 'description' => 'Implement functionality to set task dependencies and prevent completion until prerequisites are done.', 'status' => TaskStatus::PENDING, 'priority' => PriorityEnum::MEDIUM, 'category_id' => $workId],
            ['title' => 'Fix password reset email bug', 'description' => 'Password reset emails contain broken links. Update email templates and routing.', 'status' => TaskStatus::COMPLETED, 'priority' => PriorityEnum::HIGH, 'category_id' => $workId],
            ['title' => 'Implement advanced filtering', 'description' => 'Add multi-criteria filtering for tasks: status, date range, assignee, priority, tags.', 'status' => TaskStatus::IN_PROGRESS, 'priority' => PriorityEnum::MEDIUM, 'category_id' => $workId],
            ['title' => 'Create onboarding tutorial', 'description' => 'Design and implement interactive onboarding flow for new users with tooltips.', 'status' => TaskStatus::PENDING, 'priority' => PriorityEnum::LOW, 'category_id' => $educationId],
            ['title' => 'Optimize database indexes', 'description' => 'Analyze query patterns and add appropriate indexes to improve database performance.', 'status' => TaskStatus::COMPLETED, 'priority' => PriorityEnum::HIGH, 'category_id' => $workId],
            ['title' => 'Add task priority levels', 'description' => 'Implement priority system (low, medium, high, urgent) with visual indicators.', 'status' => TaskStatus::IN_PROGRESS, 'priority' => PriorityEnum::MEDIUM, 'category_id' => $workId],
            ['title' => 'Setup error tracking', 'description' => 'Integrate Sentry or similar service for automatic error tracking and reporting.', 'status' => TaskStatus::PENDING, 'priority' => PriorityEnum::HIGH, 'category_id' => $workId],
            ['title' => 'Implement task reminders', 'description' => 'Add scheduled reminders for upcoming task deadlines via email and in-app notifications.', 'status' => TaskStatus::COMPLETED, 'priority' => PriorityEnum::MEDIUM, 'category_id' => $workId],
            ['title' => 'Create REST API versioning', 'description' => 'Implement API versioning strategy to maintain backward compatibility for clients.', 'status' => TaskStatus::IN_PROGRESS, 'priority' => PriorityEnum::LOW, 'category_id' => $workId],
            ['title' => 'Add bulk operations', 'description' => 'Enable bulk actions: delete, update status, assign users for multiple tasks at once.', 'status' => TaskStatus::PENDING, 'priority' => PriorityEnum::MEDIUM, 'category_id' => $workId],
            ['title' => 'Fix N+1 query problems', 'description' => 'Identify and resolve N+1 query issues using eager loading throughout the application.', 'status' => TaskStatus::COMPLETED, 'priority' => PriorityEnum::HIGH, 'category_id' => $workId],
            ['title' => 'Implement team workspaces', 'description' => 'Add workspace functionality to organize tasks by teams or projects with proper permissions.', 'status' => TaskStatus::IN_PROGRESS, 'priority' => PriorityEnum::HIGH, 'category_id' => $workId],
            ['title' => 'Setup SSL certificate renewal', 'description' => 'Configure automatic SSL certificate renewal using Let\'s Encrypt and monitoring.', 'status' => TaskStatus::COMPLETED, 'priority' => PriorityEnum::HIGH, 'category_id' => $workId],
            ['title' => 'Add activity logs', 'description' => 'Track all user actions and system events for audit trail and debugging purposes.', 'status' => TaskStatus::PENDING, 'priority' => PriorityEnum::MEDIUM, 'category_id' => $workId],
            ['title' => 'Implement drag-and-drop sorting', 'description' => 'Add drag-and-drop interface for task reordering and status changes on kanban board.', 'status' => TaskStatus::IN_PROGRESS, 'priority' => PriorityEnum::MEDIUM, 'category_id' => $workId],
            ['title' => 'Create performance benchmarks', 'description' => 'Establish baseline performance metrics and create automated benchmarking tests.', 'status' => TaskStatus::COMPLETED, 'priority' => PriorityEnum::LOW, 'category_id' => $workId],
            ['title' => 'Add webhook support', 'description' => 'Implement webhook system to notify external services of task events and changes.', 'status' => TaskStatus::PENDING, 'priority' => PriorityEnum::MEDIUM, 'category_id' => $workId],
            ['title' => 'Fix form validation errors', 'description' => 'Standardize form validation across all modules and improve error message clarity.', 'status' => TaskStatus::IN_PROGRESS, 'priority' => PriorityEnum::LOW, 'category_id' => $workId],
            ['title' => 'Implement task archiving', 'description' => 'Add ability to archive completed tasks to keep active task list clean and organized.', 'status' => TaskStatus::COMPLETED, 'priority' => PriorityEnum::LOW, 'category_id' => $workId],
            ['title' => 'Setup load balancing', 'description' => 'Configure load balancer for distributing traffic across multiple application servers.', 'status' => TaskStatus::PENDING, 'priority' => PriorityEnum::HIGH, 'category_id' => $workId],
            ['title' => 'Add keyboard shortcuts', 'description' => 'Implement keyboard shortcuts for common actions to improve power user productivity.', 'status' => TaskStatus::IN_PROGRESS, 'priority' => PriorityEnum::LOW, 'category_id' => $personalId],
            ['title' => 'Create user analytics dashboard', 'description' => 'Build analytics dashboard showing user engagement, task completion rates, and trends.', 'status' => TaskStatus::COMPLETED, 'priority' => PriorityEnum::MEDIUM, 'category_id' => $financeId],
            ['title' => 'Implement guest user access', 'description' => 'Allow guest users to view shared tasks without requiring full account registration.', 'status' => TaskStatus::PENDING, 'priority' => PriorityEnum::LOW, 'category_id' => $workId],
            ['title' => 'Fix calendar integration', 'description' => 'Resolve sync issues with Google Calendar and Outlook calendar integrations.', 'status' => TaskStatus::IN_PROGRESS, 'priority' => PriorityEnum::MEDIUM, 'category_id' => $personalId],
            ['title' => 'Add custom task fields', 'description' => 'Allow administrators to create custom fields for tasks to fit different workflows.', 'status' => TaskStatus::COMPLETED, 'priority' => PriorityEnum::MEDIUM, 'category_id' => $workId],
            ['title' => 'Setup staging environment', 'description' => 'Create isolated staging environment for testing features before production deployment.', 'status' => TaskStatus::PENDING, 'priority' => PriorityEnum::HIGH, 'category_id' => $workId],
        ];

        foreach ($tasks as $taskData) {
            Task::create([
                'user_id' => $users->random()->id,
                'title' => $taskData['title'],
                'description' => $taskData['description'],
                'status' => $taskData['status']->value,
                'priority' => $taskData['priority']->value,
                'category_id' => $taskData['category_id'],
            ]);
        }

        $this->command->info('Successfully seeded 55 tasks with assorted statuses, priorities, and categories!');
    }
}
