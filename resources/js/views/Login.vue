<template>
  <div class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-purple-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <!-- Success Message Slider -->
    <transition
      enter-active-class="transform transition duration-500 ease-out"
      enter-from-class="translate-y-0 opacity-0 translate-x-full"
      enter-to-class="translate-y-0 opacity-100 translate-x-0"
      leave-active-class="transform transition duration-300 ease-in"
      leave-from-class="translate-y-0 opacity-100 translate-x-0"
      leave-to-class="translate-y-0 opacity-0 translate-x-full"
    >
      <div
        v-if="showSuccess"
        class="fixed top-4 right-4 left-4 sm:left-auto sm:max-w-md z-50 bg-green-50 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded-lg shadow-lg flex items-start gap-3"
      >
        <svg class="h-6 w-6 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
        </svg>
        <div class="flex-1">
          <p class="font-semibold">Logged Out Successfully</p>
          <p class="text-sm">{{ successMessage }}</p>
        </div>
        <button
          @click="showSuccess = false"
          class="text-green-500 hover:text-green-700 transition duration-200"
        >
          <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
          </svg>
        </button>
      </div>
    </transition>

    <div class="max-w-md w-full">
      <!-- Logo/Title Section -->
      <div class="text-center mb-8">
        <div class="mx-auto h-16 w-16 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-2xl flex items-center justify-center mb-4 shadow-lg">
          <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
          </svg>
        </div>
        <h2 class="text-3xl font-bold text-gray-900">
          Welcome Back
        </h2>
        <p class="mt-2 text-sm text-gray-600">
          Sign in to manage your tasks
        </p>
      </div>

      <!-- Login Card -->
      <div class="bg-white/80 backdrop-blur-sm shadow-2xl rounded-2xl p-8 border border-gray-100">
        <form class="space-y-6" @submit.prevent="handleLogin" novalidate>
          <div v-if="error" class="bg-red-50 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded-md flex items-start gap-3">
            <svg class="h-5 w-5 text-red-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
            </svg>
            <span class="text-sm flex-1">{{ error }}</span>
            <button
              @click="error = ''"
              type="button"
              class="text-red-500 hover:text-red-700 transition duration-200 flex-shrink-0"
            >
              <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
              </svg>
            </button>
          </div>

          <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
              Email Address
            </label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                </svg>
              </div>
              <input
                id="email"
                v-model="form.email"
                type="email"
                required
                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200 text-gray-900 placeholder-gray-400"
                placeholder="you@example.com"
              />
            </div>
          </div>

          <div>
            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
              Password
            </label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
              </div>
              <input
                id="password"
                v-model="form.password"
                type="password"
                required
                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200 text-gray-900 placeholder-gray-400"
                placeholder="••••••••"
              />
            </div>
          </div>

          <button
            type="submit"
            :disabled="loading"
            class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-lg shadow-lg text-sm font-semibold text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50 disabled:cursor-not-allowed transition duration-200 transform hover:scale-[1.02]"
          >
            <svg v-if="loading" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            {{ loading ? 'Signing in...' : 'Sign in' }}
          </button>

          <div class="text-center pt-4">
            <router-link to="/register" class="text-sm font-medium text-indigo-600 hover:text-indigo-500 transition duration-200">
              Don't have an account? <span class="underline">Create one</span>
            </router-link>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, onMounted, watch } from 'vue';
import { useRouter, useRoute } from 'vue-router';
import api from '../services/api';

export default {
  name: 'Login',
  setup() {
    const router = useRouter();
    const route = useRoute();
    const form = ref({
      email: '',
      password: ''
    });
    const loading = ref(false);
    const error = ref('');
    const successMessage = ref('');
    const showSuccess = ref(false);

    // Clear error when user starts typing
    watch(form, () => {
      if (error.value) {
        error.value = '';
      }
    }, { deep: true });

    const handleLogin = async () => {
      // Clear previous error
      error.value = '';
      
      // Validate fields
      if (!form.value.email || !form.value.password) {
        error.value = 'Please fill in all fields.';
        return;
      }
      
      if (!form.value.email.includes('@')) {
        error.value = 'Please enter a valid email address.';
        return;
      }
      
      loading.value = true;

      try {
        const response = await api.login(form.value);
        localStorage.setItem('token', response.access_token);
        router.push('/tasks?login=success');
      } catch (err) {
        error.value = err.response?.data?.message || 'Login failed. Please check your credentials.';
      } finally {
        loading.value = false;
      }
    };

    onMounted(() => {
      if (route.query.logout === 'true') {
        successMessage.value = 'You have been successfully logged out.';
        showSuccess.value = true;
        
        // Remove query parameter from URL
        router.replace('/login');
        
        // Auto-hide after 4 seconds
        setTimeout(() => {
          showSuccess.value = false;
        }, 4000);
      }
    });

    return {
      form,
      loading,
      error,
      successMessage,
      showSuccess,
      handleLogin
    };
  }
};
</script>
