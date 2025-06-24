<template>
    <div class="max-w-4xl mx-auto py-10 px-4">
      <h1 class="text-2xl font-bold mb-2">{{ job.title }}</h1>
  
      <div class="text-sm text-gray-600 mb-2">
        <span class="font-medium">Company:</span>
        <span>{{ job.company?.name || '—' }}</span>
      </div>
  
      <div class="text-sm text-gray-500 mb-4">
        {{ job.location }} • {{ job.type }} • 
        <span
          :class="{
            'text-green-600': job.status === 'open',
            'text-yellow-600': job.status === 'draft',
            'text-red-600': job.status === 'closed',
          }"
        >
          {{ job.status }}
        </span>
      </div>
  
      <div class="prose max-w-none" v-html="job.description"></div>
  
      <div class="mt-8 text-sm text-gray-400">
        Posted on {{ formatDate(job.created_at) }}
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: 'JobShowAdmin',
    props: {
      job: Object,
    },
    methods: {
      formatDate(date) {
        return new Date(date).toLocaleDateString();
      },
    },
  };
  </script>
  