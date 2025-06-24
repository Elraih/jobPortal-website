<template>
  <div class="max-w-4xl mx-auto p-4">
    <h1 class="text-2xl font-semibold mb-4">Your Applications</h1>

    <div v-if="applications.length === 0" class="text-gray-500">
      You haven't applied to any jobs yet.
    </div>

    <div v-for="application in applications" :key="application.id" class="border rounded p-4 mb-4">
      <h2 class="text-lg font-medium">{{ application.job.title }}</h2>
      <p class="text-sm text-gray-500">{{ application.job.description.slice(0, 100) }}...</p>
      <p class="text-xs text-gray-400 mt-1">Applied on: {{ new Date(application.created_at).toLocaleDateString() }}</p>
    </div>
  </div>
  
</template>
  
<script>
import Layout from '@/Layouts/Layout.vue';

    export default {
        layout: Layout,
        props: {
          applications: Array
        },

        applications: [
          {
            'id': 1,
            'title': 'adslm',
          },
        ]
  }
</script>
  