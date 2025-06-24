<template>
    <div class="max-w-4xl mx-auto py-10 px-4">
      <h1 class="text-2xl font-bold mb-4">Application #{{ application.id }}</h1>
  
      <div class="bg-white shadow rounded p-5 space-y-4">
        <div>
          <h2 class="text-lg font-semibold">👤 {{ application.user.name }}</h2>
          <p class="text-sm text-gray-500">{{ application.user.email }}</p>
        </div>
  
        <div class="text-sm">
          <strong>Job:</strong> {{ application.job.title }}
          <br />
          <strong>Company:</strong> {{ application.job.company?.name || '—' }}
        </div>
  
        <div>
          <strong>Cover Letter:</strong>
          <p class="mt-1 text-gray-700 whitespace-pre-line">{{ application.cover_letter }}</p>
        </div>
  
        <div class="text-sm text-gray-400">
          Submitted: {{ formatDate(application.created_at) }}
        </div>
      </div>
    </div>
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
  