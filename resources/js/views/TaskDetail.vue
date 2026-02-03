<template>
  <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
    <!-- Modern Navbar -->
    <nav class="bg-white/80 backdrop-blur-md shadow-sm border-b border-gray-200 sticky top-0 z-40">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
          <div class="flex items-center space-x-3">
            <button @click="goBack" class="text-gray-600 hover:text-gray-900 transition duration-200">
              <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
              </svg>
            </button>
            <div class="h-10 w-10 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-xl flex items-center justify-center shadow-md">
              <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
              </svg>
            </div>
            <h1 class="text-xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">Task Details</h1>
          </div>
          <div class="flex items-center space-x-4">
            <button
              @click="handleLogout"
              class="flex items-center space-x-2 px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 rounded-lg shadow-md transition duration-200 transform hover:scale-105"
            >
              <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
              </svg>
              <span>Logout</span>
            </button>
          </div>
        </div>
      </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <!-- Loading State -->
      <div v-if="loading" class="flex flex-col items-center justify-center py-16">
        <div class="relative">
          <div class="h-16 w-16 rounded-full border-4 border-gray-200"></div>
          <div class="absolute top-0 left-0 h-16 w-16 rounded-full border-4 border-indigo-600 border-t-transparent animate-spin"></div>
        </div>
        <p class="mt-4 text-gray-600 font-medium">Loading task...</p>
      </div>

      <!-- Task Details Card -->
      <div v-else-if="task" class="space-y-6">
        <!-- Task Info -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-gray-200 p-8">
          <div class="flex justify-between items-start mb-6">
            <div class="flex-1">
              <h2 class="text-3xl font-bold text-gray-900 mb-3">{{ task.title }}</h2>
              <span
                class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-semibold"
                :class="getStatusClass(task.status)"
              >
                <span class="h-2 w-2 rounded-full mr-2" :class="getStatusDotClass(task.status)"></span>
                {{ formatStatus(task.status) }}
              </span>
            </div>
          </div>
          
          <div class="mb-6">
            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-2">Description</h3>
            <p class="text-gray-700 text-base leading-relaxed">{{ task.description || 'No description provided' }}</p>
          </div>

          <div class="flex items-center gap-4 pt-4 border-t border-gray-200">
            <div class="flex items-center text-sm text-gray-600">
              <svg class="h-5 w-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
              </svg>
              <span class="font-medium">{{ task.comments?.length || 0 }} Comments</span>
            </div>
          </div>
        </div>

        <!-- Comments Section -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-gray-200 p-8">
          <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
            <svg class="h-7 w-7 mr-3 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
            </svg>
            Comments
          </h3>

          <!-- Add Comment Form -->
          <div class="mb-8">
            <form @submit.prevent="addComment" class="space-y-4">
              <div v-if="commentError" class="bg-red-50 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded-md flex items-start gap-3">
                <svg class="h-5 w-5 text-red-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                </svg>
                <span class="text-sm">{{ commentError }}</span>
              </div>

              <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Add a Comment</label>
                <textarea
                  v-model="newComment"
                  rows="3"
                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200"
                  placeholder="Share your thoughts..."
                  :disabled="submitting"
                ></textarea>
              </div>

              <button
                type="submit"
                :disabled="!newComment.trim() || submitting"
                class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg hover:from-indigo-700 hover:to-purple-700 shadow-lg transition duration-200 transform hover:scale-105 font-semibold disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none"
              >
                <svg v-if="submitting" class="animate-spin -ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <svg v-else class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                {{ submitting ? 'Posting...' : 'Post Comment' }}
              </button>
            </form>
          </div>

          <!-- Comments List -->
          <div class="space-y-4">
            <div v-if="!task.comments || task.comments.length === 0" class="text-center py-12">
              <div class="mx-auto h-16 w-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                </svg>
              </div>
              <p class="text-gray-500">No comments yet</p>
              <p class="text-sm text-gray-400 mt-1">Be the first to comment!</p>
            </div>

            <div
              v-for="comment in task.comments"
              :key="comment.id"
              class="bg-gray-50 rounded-xl p-5 border border-gray-200 hover:border-indigo-200 transition duration-200"
            >
              <div class="flex justify-between items-start mb-3">
                <div class="flex items-center space-x-3">
                  <div class="h-10 w-10 rounded-full bg-gradient-to-r from-indigo-500 to-purple-500 flex items-center justify-center text-white font-semibold">
                    {{ comment.user.name.charAt(0).toUpperCase() }}
                  </div>
                  <div>
                    <p class="font-semibold text-gray-900">{{ comment.user.name }}</p>
                    <p class="text-xs text-gray-500">{{ formatDate(comment.created_at) }}</p>
                  </div>
                </div>
                <div class="flex gap-2" v-if="comment.user.id === currentUserId">
                  <button
                    @click="startEditComment(comment)"
                    class="text-blue-600 hover:text-blue-800 transition duration-200"
                    title="Edit comment"
                  >
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                  </button>
                </div>
              </div>

              <!-- Edit Mode -->
              <div v-if="editingCommentId === comment.id" class="space-y-3">
                <textarea
                  v-model="editCommentContent"
                  rows="2"
                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200"
                ></textarea>
                <div class="flex gap-2">
                  <button
                    @click="updateComment"
                    :disabled="updating"
                    class="px-4 py-2 text-sm bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition duration-200 disabled:opacity-50"
                  >
                    {{ updating ? 'Saving...' : 'Save' }}
                  </button>
                  <button
                    @click="cancelEdit"
                    class="px-4 py-2 text-sm bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition duration-200"
                  >
                    Cancel
                  </button>
                </div>
              </div>

              <!-- View Mode -->
              <p v-else class="text-gray-700 leading-relaxed">{{ comment.content }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import { useRouter, useRoute } from 'vue-router';
import api from '../services/api';

export default {
  name: 'TaskDetail',
  setup() {
    const router = useRouter();
    const route = useRoute();
    const task = ref(null);
    const loading = ref(false);
    const submitting = ref(false);
    const updating = ref(false);
    const newComment = ref('');
    const commentError = ref('');
    const editingCommentId = ref(null);
    const editCommentContent = ref('');
    const currentUserId = ref(null);

    const fetchTask = async () => {
      loading.value = true;
      try {
        const response = await api.getTask(route.params.id);
        task.value = response.data;
      } catch (error) {
        console.error('Error fetching task:', error);
        router.push('/tasks');
      } finally {
        loading.value = false;
      }
    };

    const fetchUser = async () => {
      try {
        const user = await api.getUser();
        currentUserId.value = user.id;
      } catch (error) {
        console.error('Error fetching user:', error);
      }
    };

    const addComment = async () => {
      if (!newComment.value.trim()) return;

      submitting.value = true;
      commentError.value = '';

      try {
        await api.createComment({
          task_id: task.value.id,
          content: newComment.value
        });
        
        newComment.value = '';
        await fetchTask();
      } catch (error) {
        if (error.response?.data?.errors) {
          commentError.value = Object.values(error.response.data.errors).flat().join(', ');
        } else {
          commentError.value = error.response?.data?.message || 'Failed to add comment';
        }
      } finally {
        submitting.value = false;
      }
    };

    const startEditComment = (comment) => {
      editingCommentId.value = comment.id;
      editCommentContent.value = comment.content;
    };

    const updateComment = async () => {
      updating.value = true;
      try {
        await api.updateComment(editingCommentId.value, {
          content: editCommentContent.value
        });
        
        cancelEdit();
        await fetchTask();
      } catch (error) {
        console.error('Error updating comment:', error);
      } finally {
        updating.value = false;
      }
    };

    const cancelEdit = () => {
      editingCommentId.value = null;
      editCommentContent.value = '';
    };

    const goBack = () => {
      router.push('/tasks');
    };

    const handleLogout = async () => {
      try {
        await api.logout();
      } catch (error) {
        console.error('Logout error:', error);
      } finally {
        localStorage.removeItem('token');
        router.push('/login');
      }
    };

    const getStatusClass = (status) => {
      const classes = {
        pending: 'bg-amber-50 text-amber-700 border border-amber-200',
        in_progress: 'bg-blue-50 text-blue-700 border border-blue-200',
        completed: 'bg-green-50 text-green-700 border border-green-200'
      };
      return classes[status] || classes.pending;
    };

    const getStatusDotClass = (status) => {
      const classes = {
        pending: 'bg-amber-500',
        in_progress: 'bg-blue-500',
        completed: 'bg-green-500'
      };
      return classes[status] || classes.pending;
    };

    const formatStatus = (status) => {
      if (!status) return '';
      return status.replace('_', ' ').replace(/\b\w/g, l => l.toUpperCase());
    };

    const formatDate = (date) => {
      if (!date) return '';
      return new Date(date).toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'short',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
      });
    };

    onMounted(() => {
      fetchUser();
      fetchTask();
    });

    return {
      task,
      loading,
      submitting,
      updating,
      newComment,
      commentError,
      editingCommentId,
      editCommentContent,
      currentUserId,
      addComment,
      startEditComment,
      updateComment,
      cancelEdit,
      goBack,
      handleLogout,
      getStatusClass,
      getStatusDotClass,
      formatStatus,
      formatDate
    };
  }
};
</script>
