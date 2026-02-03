<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use App\Enums\TaskStatus;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        if ($users->isEmpty()) {
            $this->command->warn('No users found. Please seed users first.');
            return;
        }

        $tasks = [
            ['title' => 'Review pull request #234', 'description' => 'Review the authentication refactoring PR and provide feedback on code quality and security concerns.', 'status' => TaskStatus::PENDING],
            ['title' => 'Update project documentation', 'description' => 'Update README with new API endpoints and installation instructions for the latest version.', 'status' => TaskStatus::IN_PROGRESS],
            ['title' => 'Fix login bug on mobile', 'description' => 'Users are reporting issues with login on iOS devices. Investigate and fix the responsive design issue.', 'status' => TaskStatus::COMPLETED],
            ['title' => 'Optimize database queries', 'description' => 'Identify and optimize slow queries in the reports module. Target: reduce load time by 50%.', 'status' => TaskStatus::PENDING],
            ['title' => 'Write unit tests for payment module', 'description' => 'Create comprehensive unit tests covering all payment processing scenarios including edge cases.', 'status' => TaskStatus::IN_PROGRESS],
            ['title' => 'Upgrade Laravel to version 11', 'description' => 'Plan and execute Laravel framework upgrade. Test all features thoroughly before deploying.', 'status' => TaskStatus::PENDING],
            ['title' => 'Design new dashboard layout', 'description' => 'Create mockups for the new admin dashboard with improved UX and modern design patterns.', 'status' => TaskStatus::COMPLETED],
            ['title' => 'Implement email notifications', 'description' => 'Set up email notifications for task assignments, deadlines, and status changes using queues.', 'status' => TaskStatus::IN_PROGRESS],
            ['title' => 'Configure CI/CD pipeline', 'description' => 'Set up GitHub Actions for automated testing, linting, and deployment to staging environment.', 'status' => TaskStatus::COMPLETED],
            ['title' => 'Refactor authentication system', 'description' => 'Migrate from session-based auth to Sanctum tokens for better API support and security.', 'status' => TaskStatus::PENDING],
            ['title' => 'Add search functionality', 'description' => 'Implement full-text search for tasks using Laravel Scout and Meilisearch.', 'status' => TaskStatus::IN_PROGRESS],
            ['title' => 'Create API documentation', 'description' => 'Generate comprehensive API documentation using Swagger/OpenAPI specifications.', 'status' => TaskStatus::COMPLETED],
            ['title' => 'Fix memory leak in background jobs', 'description' => 'Investigate and resolve memory leak occurring in long-running queue workers.', 'status' => TaskStatus::PENDING],
            ['title' => 'Implement rate limiting', 'description' => 'Add rate limiting to API endpoints to prevent abuse and ensure fair usage.', 'status' => TaskStatus::COMPLETED],
            ['title' => 'Setup monitoring and alerts', 'description' => 'Configure application monitoring using Laravel Telescope and set up alerts for critical errors.', 'status' => TaskStatus::IN_PROGRESS],
            ['title' => 'Optimize image upload process', 'description' => 'Implement image compression and lazy loading for better performance on slow connections.', 'status' => TaskStatus::PENDING],
            ['title' => 'Add export to CSV feature', 'description' => 'Allow users to export task lists and reports to CSV format with filtering options.', 'status' => TaskStatus::COMPLETED],
            ['title' => 'Implement two-factor authentication', 'description' => 'Add 2FA support using TOTP (Time-based One-Time Password) for enhanced security.', 'status' => TaskStatus::PENDING],
            ['title' => 'Fix timezone handling issues', 'description' => 'Resolve timezone conversion problems affecting task due dates and scheduling.', 'status' => TaskStatus::IN_PROGRESS],
            ['title' => 'Create admin dashboard widgets', 'description' => 'Build interactive widgets showing key metrics, recent activities, and system health.', 'status' => TaskStatus::COMPLETED],
            ['title' => 'Implement task commenting system', 'description' => 'Add ability for users to comment on tasks with real-time updates and notifications.', 'status' => TaskStatus::PENDING],
            ['title' => 'Optimize frontend bundle size', 'description' => 'Reduce JavaScript bundle size by implementing code splitting and lazy loading.', 'status' => TaskStatus::IN_PROGRESS],
            ['title' => 'Setup backup automation', 'description' => 'Configure automated daily backups of database and uploaded files to cloud storage.', 'status' => TaskStatus::COMPLETED],
            ['title' => 'Add file attachment support', 'description' => 'Allow users to attach files to tasks with proper validation and virus scanning.', 'status' => TaskStatus::PENDING],
            ['title' => 'Implement dark mode', 'description' => 'Add dark mode theme option with system preference detection and smooth transitions.', 'status' => TaskStatus::IN_PROGRESS],
            ['title' => 'Fix CORS issues for API', 'description' => 'Configure CORS middleware properly to allow requests from authorized frontend domains.', 'status' => TaskStatus::COMPLETED],
            ['title' => 'Create mobile app mockups', 'description' => 'Design UI mockups for native mobile application for iOS and Android platforms.', 'status' => TaskStatus::PENDING],
            ['title' => 'Implement task templates', 'description' => 'Add feature to create reusable task templates for common workflows and processes.', 'status' => TaskStatus::IN_PROGRESS],
            ['title' => 'Setup Redis caching', 'description' => 'Configure Redis for caching frequently accessed data and session management.', 'status' => TaskStatus::COMPLETED],
            ['title' => 'Add task dependencies', 'description' => 'Implement functionality to set task dependencies and prevent completion until prerequisites are done.', 'status' => TaskStatus::PENDING],
            ['title' => 'Fix password reset email bug', 'description' => 'Password reset emails contain broken links. Update email templates and routing.', 'status' => TaskStatus::COMPLETED],
            ['title' => 'Implement advanced filtering', 'description' => 'Add multi-criteria filtering for tasks: status, date range, assignee, priority, tags.', 'status' => TaskStatus::IN_PROGRESS],
            ['title' => 'Create onboarding tutorial', 'description' => 'Design and implement interactive onboarding flow for new users with tooltips.', 'status' => TaskStatus::PENDING],
            ['title' => 'Optimize database indexes', 'description' => 'Analyze query patterns and add appropriate indexes to improve database performance.', 'status' => TaskStatus::COMPLETED],
            ['title' => 'Add task priority levels', 'description' => 'Implement priority system (low, medium, high, urgent) with visual indicators.', 'status' => TaskStatus::IN_PROGRESS],
            ['title' => 'Setup error tracking', 'description' => 'Integrate Sentry or similar service for automatic error tracking and reporting.', 'status' => TaskStatus::PENDING],
            ['title' => 'Implement task reminders', 'description' => 'Add scheduled reminders for upcoming task deadlines via email and in-app notifications.', 'status' => TaskStatus::COMPLETED],
            ['title' => 'Create REST API versioning', 'description' => 'Implement API versioning strategy to maintain backward compatibility for clients.', 'status' => TaskStatus::IN_PROGRESS],
            ['title' => 'Add bulk operations', 'description' => 'Enable bulk actions: delete, update status, assign users for multiple tasks at once.', 'status' => TaskStatus::PENDING],
            ['title' => 'Fix N+1 query problems', 'description' => 'Identify and resolve N+1 query issues using eager loading throughout the application.', 'status' => TaskStatus::COMPLETED],
            ['title' => 'Implement team workspaces', 'description' => 'Add workspace functionality to organize tasks by teams or projects with proper permissions.', 'status' => TaskStatus::IN_PROGRESS],
            ['title' => 'Setup SSL certificate renewal', 'description' => 'Configure automatic SSL certificate renewal using Let\'s Encrypt and monitoring.', 'status' => TaskStatus::COMPLETED],
            ['title' => 'Add activity logs', 'description' => 'Track all user actions and system events for audit trail and debugging purposes.', 'status' => TaskStatus::PENDING],
            ['title' => 'Implement drag-and-drop sorting', 'description' => 'Add drag-and-drop interface for task reordering and status changes on kanban board.', 'status' => TaskStatus::IN_PROGRESS],
            ['title' => 'Create performance benchmarks', 'description' => 'Establish baseline performance metrics and create automated benchmarking tests.', 'status' => TaskStatus::COMPLETED],
            ['title' => 'Add webhook support', 'description' => 'Implement webhook system to notify external services of task events and changes.', 'status' => TaskStatus::PENDING],
            ['title' => 'Fix form validation errors', 'description' => 'Standardize form validation across all modules and improve error message clarity.', 'status' => TaskStatus::IN_PROGRESS],
            ['title' => 'Implement task archiving', 'description' => 'Add ability to archive completed tasks to keep active task list clean and organized.', 'status' => TaskStatus::COMPLETED],
            ['title' => 'Setup load balancing', 'description' => 'Configure load balancer for distributing traffic across multiple application servers.', 'status' => TaskStatus::PENDING],
            ['title' => 'Add keyboard shortcuts', 'description' => 'Implement keyboard shortcuts for common actions to improve power user productivity.', 'status' => TaskStatus::IN_PROGRESS],
            ['title' => 'Create user analytics dashboard', 'description' => 'Build analytics dashboard showing user engagement, task completion rates, and trends.', 'status' => TaskStatus::COMPLETED],
            ['title' => 'Implement guest user access', 'description' => 'Allow guest users to view shared tasks without requiring full account registration.', 'status' => TaskStatus::PENDING],
            ['title' => 'Fix calendar integration', 'description' => 'Resolve sync issues with Google Calendar and Outlook calendar integrations.', 'status' => TaskStatus::IN_PROGRESS],
            ['title' => 'Add custom task fields', 'description' => 'Allow administrators to create custom fields for tasks to fit different workflows.', 'status' => TaskStatus::COMPLETED],
            ['title' => 'Setup staging environment', 'description' => 'Create isolated staging environment for testing features before production deployment.', 'status' => TaskStatus::PENDING],
        ];

        foreach ($tasks as $taskData) {
            Task::create([
                'user_id' => $users->random()->id,
                'title' => $taskData['title'],
                'description' => $taskData['description'],
                'status' => $taskData['status']->value,
            ]);
        }

        $this->command->info('Successfully seeded 55 tasks with assorted statuses!');
    }
}
