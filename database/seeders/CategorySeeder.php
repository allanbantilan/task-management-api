<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Work',
                'color' => '#3b82f6',
                'icon' => '💼',
            ],
            [
                'name' => 'Personal',
                'color' => '#8b5cf6',
                'icon' => '👤',
            ],
            [
                'name' => 'Shopping',
                'color' => '#ec4899',
                'icon' => '🛒',
            ],
            [
                'name' => 'Health',
                'color' => '#10b981',
                'icon' => '❤️',
            ],
            [
                'name' => 'Education',
                'color' => '#f59e0b',
                'icon' => '📚',
            ],
            [
                'name' => 'Finance',
                'color' => '#14b8a6',
                'icon' => '💰',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
