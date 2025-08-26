<template>
  <div class="max-w-3xl mx-auto py-10 px-4">
    <h1 class="text-2xl font-bold mb-4">Application Details</h1>

  
    <!-- <div class="bg-white shadow rounded p-5 space-y-4">
        <div>
          <h2 class="text-lg font-semibold">{{ application.user.name }}</h2>
          <p class="text-sm text-gray-500">{{ application.user.email }}</p>
        </div>
  
        <div class="text-sm">
          <strong>Job Title:</strong>
          <span class="text-gray-700">{{ application.job.title }}</span>
        </div>
  
        <div>
          <strong>Cover Letter:</strong>
          <p class="mt-1 text-gray-700 whitespace-pre-line">
            {{ application.cover_letter }}
          </p>
        </div>
  
        <div class="text-sm text-gray-400">
          Submitted on: {{ formatDate(application.created_at) }}
        </div>
      </div> -->
  </div>

  <p v-if="application == ''">djghd</p>
</template>

<script>
export default {
  props: {
    application: Object,
  },
  methods: {
    formatDate(date) {
      return new Date(date).toLocaleDateString();
    },
  },
};
</script>