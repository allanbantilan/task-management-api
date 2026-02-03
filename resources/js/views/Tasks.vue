<template>
    <div
        class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100"
    >
        <!-- Login Success Message Slider -->
        <transition
            enter-active-class="transform transition duration-500 ease-out"
            enter-from-class="translate-y-0 opacity-0 translate-x-full"
            enter-to-class="translate-y-0 opacity-100 translate-x-0"
            leave-active-class="transform transition duration-300 ease-in"
            leave-from-class="translate-y-0 opacity-100 translate-x-0"
            leave-to-class="translate-y-0 opacity-0 translate-x-full"
        >
            <div
                v-if="showLoginSuccess"
                class="fixed top-4 right-4 left-4 sm:left-auto sm:max-w-md z-50 bg-green-50 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded-lg shadow-lg flex items-start gap-3"
            >
                <svg class="h-6 w-6 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <div class="flex-1">
                    <p class="font-semibold">Login Successful</p>
                    <p class="text-sm">{{ loginSuccessMessage }}</p>
                </div>
                <button
                    @click="showLoginSuccess = false"
                    type="button"
                    class="text-green-500 hover:text-green-700 transition duration-200 flex-shrink-0"
                >
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        </transition>

        <!-- Task Success Message Slider -->
        <transition
            enter-active-class="transform transition duration-500 ease-out"
            enter-from-class="translate-y-0 opacity-0 translate-x-full"
            enter-to-class="translate-y-0 opacity-100 translate-x-0"
            leave-active-class="transform transition duration-300 ease-in"
            leave-from-class="translate-y-0 opacity-100 translate-x-0"
            leave-to-class="translate-y-0 opacity-0 translate-x-full"
        >
            <div
                v-if="showTaskSuccess"
                class="fixed top-20 right-4 left-4 sm:left-auto sm:max-w-md z-50 bg-blue-50 border-l-4 border-blue-500 text-blue-700 px-4 py-3 rounded-lg shadow-lg flex items-start gap-3"
            >
                <svg class="h-6 w-6 text-blue-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <div class="flex-1">
                    <p class="font-semibold">Success</p>
                    <p class="text-sm">{{ taskSuccessMessage }}</p>
                </div>
                <button
                    @click="showTaskSuccess = false"
                    type="button"
                    class="text-blue-500 hover:text-blue-700 transition duration-200 flex-shrink-0"
                >
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        </transition>

        <!-- Modern Navbar -->
        <nav
            class="bg-white/80 backdrop-blur-md shadow-sm border-b border-gray-200 sticky top-0 z-40"
        >
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center space-x-3">
                        <div
                            class="h-10 w-10 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-xl flex items-center justify-center shadow-md"
                        >
                            <svg
                                class="h-6 w-6 text-white"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"
                                ></path>
                            </svg>
                        </div>
                        <h1
                            class="text-xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent"
                        >
                            Task Manager
                        </h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div
                            class="hidden sm:flex items-center space-x-2 text-sm text-gray-600 bg-gray-100 px-4 py-2 rounded-lg"
                        >
                            <svg
                                class="h-5 w-5 text-gray-500"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                ></path>
                            </svg>
                            <span class="font-medium">{{ userEmail }}</span>
                        </div>
                        <button
                            @click="showLogoutConfirmation"
                            class="flex items-center space-x-2 px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 rounded-lg shadow-md transition duration-200 transform hover:scale-105"
                        >
                            <svg
                                class="h-4 w-4"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                                ></path>
                            </svg>
                            <span>Logout</span>
                        </button>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Header Section with Stats -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-900">
                            My Tasks
                        </h2>
                        <p class="mt-1 text-sm text-gray-600">
                            Manage and track your tasks efficiently
                        </p>
                    </div>
                    <button
                        @click="openCreateModal"
                        class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl hover:from-indigo-700 hover:to-purple-700 shadow-lg transition duration-200 transform hover:scale-105 font-semibold whitespace-nowrap"
                    >
                        <svg
                            class="h-5 w-5 mr-2"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 4v16m8-8H4"
                            ></path>
                        </svg>
                        New Task
                    </button>
                </div>

                <!-- Quick Stats -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
                    <div
                        class="bg-white/80 backdrop-blur-sm rounded-xl p-4 border border-gray-200 shadow-sm"
                    >
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">
                                    Total Tasks
                                </p>
                                <p class="text-2xl font-bold text-gray-900">
                                    {{ pagination.total || tasks.length }}
                                </p>
                            </div>
                            <div
                                class="h-12 w-12 bg-blue-100 rounded-lg flex items-center justify-center"
                            >
                                <svg
                                    class="h-6 w-6 text-blue-600"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"
                                    ></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div
                        class="bg-white/80 backdrop-blur-sm rounded-xl p-4 border border-gray-200 shadow-sm"
                    >
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">
                                    In Progress
                                </p>
                                <p class="text-2xl font-bold text-blue-600">
                                    {{
                                        tasks.filter(
                                            (t) => t.status === "in_progress",
                                        ).length
                                    }}
                                </p>
                            </div>
                            <div
                                class="h-12 w-12 bg-blue-100 rounded-lg flex items-center justify-center"
                            >
                                <svg
                                    class="h-6 w-6 text-blue-600"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z"
                                    ></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div
                        class="bg-white/80 backdrop-blur-sm rounded-xl p-4 border border-gray-200 shadow-sm"
                    >
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">
                                    Completed
                                </p>
                                <p class="text-2xl font-bold text-green-600">
                                    {{
                                        tasks.filter(
                                            (t) => t.status === "completed",
                                        ).length
                                    }}
                                </p>
                            </div>
                            <div
                                class="h-12 w-12 bg-green-100 rounded-lg flex items-center justify-center"
                            >
                                <svg
                                    class="h-6 w-6 text-green-600"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                                    ></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filters -->
                <div
                    class="bg-white/80 backdrop-blur-sm rounded-xl p-6 border border-gray-200 shadow-sm"
                >
                    <div class="flex items-center gap-2 mb-4">
                        <svg
                            class="h-5 w-5 text-indigo-600"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"
                            ></path>
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-900">
                            Filters
                        </h3>
                        <button
                            v-if="
                                filters.status ||
                                filters.priority ||
                                filters.category_id
                            "
                            @click="
                                () => {
                                    filters.status = '';
                                    filters.priority = '';
                                    filters.category_id = '';
                                    fetchTasks();
                                }
                            "
                            class="ml-auto text-sm text-indigo-600 hover:text-indigo-700 font-medium transition duration-200"
                        >
                            Clear All
                        </button>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="space-y-2">
                            <label
                                class="flex items-center gap-2 text-sm font-semibold text-gray-700"
                            >
                                <div
                                    class="h-8 w-8 bg-amber-100 rounded-lg flex items-center justify-center"
                                >
                                    <svg
                                        class="h-4 w-4 text-amber-600"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                                        ></path>
                                    </svg>
                                </div>
                                Status
                            </label>
                            <select
                                v-model="filters.status"
                                @change="fetchTasks"
                                class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-200 hover:border-indigo-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition duration-200 bg-white text-gray-700 font-medium"
                            >
                                <option value="">All Statuses</option>
                                <option value="pending">⏳ Pending</option>
                                <option value="in_progress">
                                    🚀 In Progress
                                </option>
                                <option value="completed">✅ Completed</option>
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label
                                class="flex items-center gap-2 text-sm font-semibold text-gray-700"
                            >
                                <div
                                    class="h-8 w-8 bg-purple-100 rounded-lg flex items-center justify-center"
                                >
                                    <svg
                                        class="h-4 w-4 text-purple-600"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"
                                        ></path>
                                    </svg>
                                </div>
                                Category
                            </label>
                            <select
                                v-model="filters.category_id"
                                @change="fetchTasks"
                                class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-200 hover:border-indigo-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition duration-200 bg-white text-gray-700 font-medium"
                            >
                                <option value="">All Categories</option>
                                <option
                                    v-for="category in categories"
                                    :key="category.id"
                                    :value="category.id"
                                >
                                    {{ category.icon }} {{ category.name }}
                                </option>
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label
                                class="flex items-center gap-2 text-sm font-semibold text-gray-700"
                            >
                                <div
                                    class="h-8 w-8 bg-red-100 rounded-lg flex items-center justify-center"
                                >
                                    <svg
                                        class="h-4 w-4 text-red-600"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M13 10V3L4 14h7v7l9-11h-7z"
                                        ></path>
                                    </svg>
                                </div>
                                Priority
                            </label>
                            <select
                                v-model="filters.priority"
                                @change="fetchTasks"
                                class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-200 hover:border-indigo-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition duration-200 bg-white text-gray-700 font-medium"
                            >
                                <option value="">All Priorities</option>
                                <option value="low">🟢 Low</option>
                                <option value="medium">🟡 Medium</option>
                                <option value="high">🔴 High</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Loading State -->
            <div
                v-if="loading"
                class="flex flex-col items-center justify-center py-16"
            >
                <div class="relative">
                    <div
                        class="h-16 w-16 rounded-full border-4 border-gray-200"
                    ></div>
                    <div
                        class="absolute top-0 left-0 h-16 w-16 rounded-full border-4 border-indigo-600 border-t-transparent animate-spin"
                    ></div>
                </div>
                <p class="mt-4 text-gray-600 font-medium">
                    Loading your tasks...
                </p>
            </div>

            <!-- Empty State -->
            <div
                v-else-if="tasks.length === 0"
                class="text-center py-16 bg-white/80 backdrop-blur-sm rounded-2xl border-2 border-dashed border-gray-300"
            >
                <div
                    class="mx-auto h-24 w-24 bg-gradient-to-r from-indigo-100 to-purple-100 rounded-full flex items-center justify-center mb-4"
                >
                    <svg
                        class="h-12 w-12 text-indigo-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"
                        ></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">
                    No tasks yet
                </h3>
                <p class="text-gray-600 mb-6">
                    Get started by creating your first task
                </p>
                <button
                    @click="openCreateModal"
                    class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl hover:from-indigo-700 hover:to-purple-700 shadow-lg transition duration-200 transform hover:scale-105 font-semibold"
                >
                    <svg
                        class="h-5 w-5 mr-2"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 4v16m8-8H4"
                        ></path>
                    </svg>
                    Create Your First Task
                </button>
            </div>

            <!-- Tasks Grid -->
            <div v-else>
                <div
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8"
                >
                    <div
                        v-for="task in tasks"
                        :key="task.id"
                        @click="viewTask(task.id)"
                        class="group bg-white/80 backdrop-blur-sm rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 cursor-pointer"
                    >
                        <!-- Main content container with flex-col -->
                        <div class="flex flex-col h-full">
                            <!-- Header section with category fixed to right -->
                            <div class="flex justify-between items-start mb-4">
                                <!-- Task title section that can grow -->
                                <div class="flex-1 min-w-0 mr-4">
                                    <h3
                                        class="text-lg font-bold text-gray-900 group-hover:text-indigo-600 transition duration-200 truncate"
                                    >
                                        {{ task.title }}
                                    </h3>
                                </div>

                                <!-- Category badge - fixed to right, won't move -->
                                <div class="flex-shrink-0">
                                    <span
                                        v-if="task.category"
                                        class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium gap-1 whitespace-nowrap"
                                        :style="{
                                            backgroundColor:
                                                task.category.color + '20',
                                            color: task.category.color,
                                        }"
                                    >
                                        <span
                                            class="flex items-center justify-center text-sm leading-none"
                                            >{{ task.category.icon }}</span
                                        >
                                        <span>{{ task.category.name }}</span>
                                    </span>
                                </div>
                            </div>

                            <!-- Status and priority badges -->
                            <div class="flex items-center gap-2 mb-4">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold whitespace-nowrap"
                                    :class="getStatusClass(task.status)"
                                >
                                    <span
                                        class="h-1.5 w-1.5 rounded-full mr-1.5"
                                        :class="getStatusDotClass(task.status)"
                                    ></span>
                                    {{ formatStatus(task.status) }}
                                </span>
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold whitespace-nowrap"
                                    :class="getPriorityClass(task.priority)"
                                >
                                    <span class="mr-1.5">{{
                                        getPriorityIcon(task.priority)
                                    }}</span>
                                    {{ formatPriority(task.priority) }}
                                </span>
                            </div>

                            <!-- Description with flex-grow to push buttons down -->
                            <p
                                class="text-gray-600 text-sm mb-6 line-clamp-3 leading-relaxed flex-grow"
                            >
                                {{
                                    task.description ||
                                    "No description provided"
                                }}
                            </p>

                            <!-- Buttons at the bottom -->
                            <div class="flex gap-2 mt-auto">
                                <button
                                    @click.stop="openEditModal(task)"
                                    class="flex-1 flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-medium bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition duration-200 whitespace-nowrap"
                                >
                                    <svg
                                        class="h-4 w-4 flex-shrink-0"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                                        ></path>
                                    </svg>
                                    Edit
                                </button>
                                <button
                                    @click.stop="confirmDelete(task)"
                                    class="flex-1 flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-medium bg-red-50 text-red-700 rounded-lg hover:bg-red-100 transition duration-200 whitespace-nowrap"
                                >
                                    <svg
                                        class="h-4 w-4 flex-shrink-0"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                        ></path>
                                    </svg>
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div
                v-if="pagination.lastPage > 1"
                class="bg-white/80 items-center backdrop-blur-sm rounded-xl shadow-sm border border-gray-200 p-4 mt-8"
            >
                <div class="flex flex-col items-center gap-4">
                    <div class="flex items-center gap-2">
                        <button
                            @click="prevPage"
                            :disabled="pagination.currentPage === 1"
                            class="px-3 py-2 text-sm font-medium rounded-lg border border-gray-300 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed transition duration-200"
                        >
                            <svg
                                class="h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M15 19l-7-7 7-7"
                                ></path>
                            </svg>
                        </button>

                        <div class="flex items-center gap-1">
                            <button
                                v-for="page in Math.min(pagination.lastPage, 5)"
                                :key="page"
                                @click="goToPage(page)"
                                :class="[
                                    'px-4 py-2 text-sm font-medium rounded-lg transition duration-200',
                                    pagination.currentPage === page
                                        ? 'bg-gradient-to-r from-indigo-600 to-purple-600 text-white shadow-md'
                                        : 'border border-gray-300 hover:bg-gray-50 text-gray-700',
                                ]"
                            >
                                {{ page }}
                            </button>
                            <span
                                v-if="pagination.lastPage > 5"
                                class="px-2 text-gray-500"
                                >...</span
                            >
                            <button
                                v-if="pagination.lastPage > 5"
                                @click="goToPage(pagination.lastPage)"
                                :class="[
                                    'px-4 py-2 text-sm font-medium rounded-lg transition duration-200',
                                    pagination.currentPage ===
                                    pagination.lastPage
                                        ? 'bg-gradient-to-r from-indigo-600 to-purple-600 text-white shadow-md'
                                        : 'border border-gray-300 hover:bg-gray-50 text-gray-700',
                                ]"
                            >
                                {{ pagination.lastPage }}
                            </button>
                        </div>

                        <button
                            @click="nextPage"
                            :disabled="
                                pagination.currentPage === pagination.lastPage
                            "
                            class="px-3 py-2 text-sm font-medium rounded-lg border border-gray-300 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed transition duration-200"
                        >
                            <svg
                                class="h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 5l7 7-7 7"
                                ></path>
                            </svg>
                        </button>
                    </div>

                    <div class="text-sm text-gray-700">
                        Showing
                        <span class="font-semibold">{{ tasks.length }}</span>
                        of
                        <span class="font-semibold">{{
                            pagination.total
                        }}</span>
                        tasks
                    </div>
                </div>
            </div>
        </div>

        <!-- Task Modal (Create/Edit) -->
        <div
            v-if="showModal"
            class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4 z-50"
            @click.self="closeModal"
        >
            <div class="bg-white rounded-2xl shadow-2xl max-w-lg w-full p-8">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-bold text-gray-900">
                        {{ isEditing ? "Edit Task" : "Create New Task" }}
                    </h3>
                    <button
                        @click="closeModal"
                        class="text-gray-400 hover:text-gray-600 transition duration-200"
                    >
                        <svg
                            class="h-6 w-6"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"
                            ></path>
                        </svg>
                    </button>
                </div>

                <form @submit.prevent="saveTask" class="space-y-5">
                    <div
                        v-if="formError"
                        class="bg-red-50 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded-md flex items-start gap-3"
                    >
                        <svg
                            class="h-5 w-5 text-red-500 mt-0.5"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd"
                            ></path>
                        </svg>
                        <span class="text-sm">{{ formError }}</span>
                    </div>

                    <div>
                        <label
                            class="block text-sm font-semibold text-gray-700 mb-2"
                            >Task Title</label
                        >
                        <input
                            v-model="taskForm.title"
                            type="text"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200"
                            placeholder="Enter task title"
                        />
                    </div>

                    <div>
                        <label
                            class="block text-sm font-semibold text-gray-700 mb-2"
                            >Description</label
                        >
                        <textarea
                            v-model="taskForm.description"
                            rows="4"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200"
                            placeholder="Describe your task..."
                        ></textarea>
                    </div>

                    <div>
                        <label
                            class="block text-sm font-semibold text-gray-700 mb-2"
                            >Status</label
                        >
                        <select
                            v-model="taskForm.status"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200"
                        >
                            <option value="pending">Pending</option>
                            <option value="in_progress">In Progress</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>

                    <div>
                        <label
                            class="block text-sm font-semibold text-gray-700 mb-2"
                            >Priority</label
                        >
                        <select
                            v-model="taskForm.priority"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200"
                        >
                            <option value="low">🟢 Low</option>
                            <option value="medium">🟡 Medium</option>
                            <option value="high">🔴 High</option>
                        </select>
                    </div>

                    <div>
                        <label
                            class="block text-sm font-semibold text-gray-700 mb-2"
                            >Category</label
                        >
                        <select
                            v-model="taskForm.category_id"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200"
                        >
                            <option value="">No Category</option>
                            <option
                                v-for="category in categories"
                                :key="category.id"
                                :value="category.id"
                            >
                                {{ category.icon }} {{ category.name }}
                            </option>
                        </select>
                    </div>

                    <div class="flex gap-3 pt-4">
                        <button
                            type="button"
                            @click="closeModal"
                            class="flex-1 px-6 py-3 text-sm font-semibold text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition duration-200"
                        >
                            Cancel
                        </button>
                        <button
                            type="submit"
                            :disabled="saving"
                            class="flex-1 flex items-center justify-center px-6 py-3 text-sm font-semibold text-white bg-gradient-to-r from-indigo-600 to-purple-600 rounded-lg hover:from-indigo-700 hover:to-purple-700 disabled:opacity-50 transition duration-200 shadow-lg"
                        >
                            <svg
                                v-if="saving"
                                class="animate-spin -ml-1 mr-2 h-4 w-4 text-white"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                            >
                                <circle
                                    class="opacity-25"
                                    cx="12"
                                    cy="12"
                                    r="10"
                                    stroke="currentColor"
                                    stroke-width="4"
                                ></circle>
                                <path
                                    class="opacity-75"
                                    fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                ></path>
                            </svg>
                            {{ saving ? "Saving..." : "Save Task" }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div
            v-if="showDeleteModal"
            class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4 z-50"
            @click.self="closeDeleteModal"
        >
            <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-8">
                <div
                    class="flex items-center justify-center h-16 w-16 mx-auto mb-4 bg-red-100 rounded-full"
                >
                    <svg
                        class="h-8 w-8 text-red-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"
                        ></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 text-center mb-2">
                    Delete Task
                </h3>
                <p class="text-gray-600 text-center mb-6">
                    Are you sure you want to delete
                    <span class="font-semibold"
                        >"{{ taskToDelete?.title }}"</span
                    >? This action cannot be undone.
                </p>
                <div class="flex gap-3">
                    <button
                        @click="closeDeleteModal"
                        class="flex-1 px-6 py-3 text-sm font-semibold text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition duration-200"
                    >
                        Cancel
                    </button>
                    <button
                        @click="deleteTask"
                        :disabled="deleting"
                        class="flex-1 flex items-center justify-center px-6 py-3 text-sm font-semibold text-white bg-red-600 rounded-lg hover:bg-red-700 disabled:opacity-50 transition duration-200"
                    >
                        <svg
                            v-if="deleting"
                            class="animate-spin -ml-1 mr-2 h-4 w-4 text-white"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                        >
                            <circle
                                class="opacity-25"
                                cx="12"
                                cy="12"
                                r="10"
                                stroke="currentColor"
                                stroke-width="4"
                            ></circle>
                            <path
                                class="opacity-75"
                                fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                            ></path>
                        </svg>
                        {{ deleting ? "Deleting..." : "Delete" }}
                    </button>
                </div>
            </div>
        </div>

        <!-- Logout Confirmation Modal -->
        <div
            v-if="showLogoutModal"
            class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4 z-50"
            @click.self="closeLogoutModal"
        >
            <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-8">
                <div
                    class="flex items-center justify-center h-16 w-16 mx-auto mb-4 bg-red-100 rounded-full"
                >
                    <svg
                        class="h-8 w-8 text-red-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                        ></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 text-center mb-2">
                    Logout Confirmation
                </h3>
                <p class="text-gray-600 text-center mb-6">
                    Are you sure you want to logout? You will need to login again to access your tasks.
                </p>
                <div class="flex gap-3">
                    <button
                        @click="closeLogoutModal"
                        class="flex-1 px-6 py-3 text-sm font-semibold text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition duration-200"
                    >
                        Cancel
                    </button>
                    <button
                        @click="handleLogout"
                        class="flex-1 flex items-center justify-center px-6 py-3 text-sm font-semibold text-white bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 rounded-lg transition duration-200"
                    >
                        Logout
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, onMounted } from "vue";
import { useRouter } from "vue-router";
import api from "../services/api";

export default {
    name: "Tasks",
    setup() {
        const router = useRouter();
        const tasks = ref([]);
        const categories = ref([]);
        const loading = ref(false);
        const showModal = ref(false);
        const showDeleteModal = ref(false);
        const showLogoutModal = ref(false);
        const isEditing = ref(false);
        const saving = ref(false);
        const deleting = ref(false);
        const formError = ref("");
        const taskToDelete = ref(null);
        const userEmail = ref("");
        const showLoginSuccess = ref(false);
        const loginSuccessMessage = ref("");
        const showTaskSuccess = ref(false);
        const taskSuccessMessage = ref("");

        const filters = ref({
            status: "",
            priority: "",
            category_id: "",
        });

        const pagination = ref({
            currentPage: 1,
            lastPage: 1,
            perPage: 9,
            total: 0,
        });

        const taskForm = ref({
            title: "",
            description: "",
            status: "pending",
            priority: "medium",
            category_id: "",
        });

        const fetchTasks = async (page = 1) => {
            loading.value = true;
            try {
                const params = {
                    page,
                    per_page: pagination.value.perPage,
                };
                if (filters.value.status) {
                    params.status = filters.value.status;
                }
                if (filters.value.priority) {
                    params.priority = filters.value.priority;
                }
                if (filters.value.category_id) {
                    params.category_id = filters.value.category_id;
                }
                const response = await api.getTasks(params);
                tasks.value = response.data;

                // Update pagination metadata
                if (response.meta) {
                    pagination.value.currentPage = response.meta.current_page;
                    pagination.value.lastPage = response.meta.last_page;
                    pagination.value.total = response.meta.total;
                }
            } catch (error) {
                console.error("Error fetching tasks:", error);
            } finally {
                loading.value = false;
            }
        };

        const fetchCategories = async () => {
            try {
                const response = await api.getCategories();
                categories.value = response.data;
            } catch (error) {
                console.error("Error fetching categories:", error);
            }
        };

        const fetchUser = async () => {
            try {
                const user = await api.getUser();
                userEmail.value = user.email;
            } catch (error) {
                console.error("Error fetching user:", error);
            }
        };

        const openCreateModal = () => {
            isEditing.value = false;
            taskForm.value = {
                title: "",
                description: "",
                status: "pending",
                priority: "medium",
                category_id: "",
            };
            formError.value = "";
            showModal.value = true;
        };

        const openEditModal = (task) => {
            isEditing.value = true;
            taskForm.value = {
                id: task.id,
                title: task.title,
                description: task.description,
                status: task.status,
                priority: task.priority,
                category_id: task.category_id || "",
            };
            formError.value = "";
            showModal.value = true;
        };

        const closeModal = () => {
            showModal.value = false;
            taskForm.value = {
                title: "",
                description: "",
                status: "pending",
                priority: "medium",
                category_id: "",
            };
            formError.value = "";
        };

        const saveTask = async () => {
            saving.value = true;
            formError.value = "";

            try {
                const taskData = {
                    title: taskForm.value.title,
                    description: taskForm.value.description,
                    status: taskForm.value.status,
                    priority: taskForm.value.priority,
                    category_id: taskForm.value.category_id || null,
                };

                if (isEditing.value) {
                    await api.updateTask(taskForm.value.id, taskData);
                    taskSuccessMessage.value = 'Task updated successfully!';
                } else {
                    await api.createTask(taskData);
                    taskSuccessMessage.value = 'Task created successfully!';
                }
                
                closeModal();
                fetchTasks();
                
                // Show success notification
                showTaskSuccess.value = true;
                setTimeout(() => {
                    showTaskSuccess.value = false;
                }, 4000);
            } catch (error) {
                if (error.response?.data?.errors) {
                    formError.value = Object.values(error.response.data.errors)
                        .flat()
                        .join(", ");
                } else {
                    formError.value =
                        error.response?.data?.message || "Failed to save task";
                }
            } finally {
                saving.value = false;
            }
        };

        const confirmDelete = (task) => {
            taskToDelete.value = task;
            showDeleteModal.value = true;
        };

        const closeDeleteModal = () => {
            showDeleteModal.value = false;
            taskToDelete.value = null;
        };

        const deleteTask = async () => {
            deleting.value = true;
            try {
                await api.deleteTask(taskToDelete.value.id);
                closeDeleteModal();
                fetchTasks();
                
                // Show success notification
                taskSuccessMessage.value = 'Task deleted successfully!';
                showTaskSuccess.value = true;
                setTimeout(() => {
                    showTaskSuccess.value = false;
                }, 4000);
            } catch (error) {
                console.error("Error deleting task:", error);
            } finally {
                deleting.value = false;
            }
        };

        const showLogoutConfirmation = () => {
            showLogoutModal.value = true;
        };

        const closeLogoutModal = () => {
            showLogoutModal.value = false;
        };

        const handleLogout = async () => {
            try {
                await api.logout();
            } catch (error) {
                console.error("Logout error:", error);
            } finally {
                localStorage.removeItem("token");
                router.push("/login?logout=true");
            }
        };

        const getStatusClass = (status) => {
            const classes = {
                pending: "bg-amber-50 text-amber-700 border border-amber-200",
                in_progress: "bg-blue-50 text-blue-700 border border-blue-200",
                completed: "bg-green-50 text-green-700 border border-green-200",
            };
            return classes[status] || classes.pending;
        };

        const getStatusDotClass = (status) => {
            const classes = {
                pending: "bg-amber-500",
                in_progress: "bg-blue-500",
                completed: "bg-green-500",
            };
            return classes[status] || classes.pending;
        };

        const formatStatus = (status) => {
            return status
                .replace("_", " ")
                .replace(/\b\w/g, (l) => l.toUpperCase());
        };

        const formatPriority = (priority) => {
            if (!priority) return "";
            return priority.charAt(0).toUpperCase() + priority.slice(1);
        };

        const getPriorityClass = (priority) => {
            const classes = {
                low: "bg-green-50 text-green-700 border border-green-200",
                medium: "bg-yellow-50 text-yellow-700 border border-yellow-200",
                high: "bg-red-50 text-red-700 border border-red-200",
            };
            return classes[priority] || classes.medium;
        };

        const getPriorityIcon = (priority) => {
            const icons = {
                low: "🟢",
                medium: "🟡",
                high: "🔴",
            };
            return icons[priority] || icons.medium;
        };

        const viewTask = (taskId) => {
            router.push(`/tasks/${taskId}`);
        };

        const goToPage = (page) => {
            if (page >= 1 && page <= pagination.value.lastPage) {
                fetchTasks(page);
            }
        };

        const nextPage = () => {
            if (pagination.value.currentPage < pagination.value.lastPage) {
                fetchTasks(pagination.value.currentPage + 1);
            }
        };

        const prevPage = () => {
            if (pagination.value.currentPage > 1) {
                fetchTasks(pagination.value.currentPage - 1);
            }
        };

        onMounted(() => {
            // Check if user just logged in
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('login') === 'success') {
                loginSuccessMessage.value = 'Welcome back! You have successfully logged in.';
                showLoginSuccess.value = true;
                
                // Remove query parameter from URL
                window.history.replaceState({}, document.title, '/tasks');
                
                // Auto-hide after 4 seconds
                setTimeout(() => {
                    showLoginSuccess.value = false;
                }, 4000);
            }
            
            fetchUser();
            fetchCategories();
            fetchTasks();
        });

        return {
            tasks,
            categories,
            loading,
            showModal,
            showDeleteModal,
            showLogoutModal,
            showLoginSuccess,
            loginSuccessMessage,
            showTaskSuccess,
            taskSuccessMessage,
            isEditing,
            saving,
            deleting,
            formError,
            taskForm,
            taskToDelete,
            filters,
            userEmail,
            fetchTasks,
            openCreateModal,
            openEditModal,
            closeModal,
            saveTask,
            confirmDelete,
            closeDeleteModal,
            deleteTask,
            viewTask,
            showLogoutConfirmation,
            closeLogoutModal,
            handleLogout,
            getStatusClass,
            getStatusDotClass,
            formatStatus,
            formatPriority,
            getPriorityClass,
            getPriorityIcon,
            pagination,
            goToPage,
            nextPage,
            prevPage,
        };
    },
};
</script>
