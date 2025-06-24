<template>
    <div class="max-w-6xl mx-auto py-10 px-4">
      <h1 class="text-2xl font-bold mb-4">Company: {{ company.name }}</h1>
  
      <div v-if="company.website" class="mb-4">
        <a :href="company.website" class="text-blue-600 hover:underline" target="_blank">
          {{ company.website }}
        </a>
      </div>
  
      <div v-if="company.description" class="mb-6 text-gray-700">
        <p>{{ company.description }}</p>
      </div>
  
      <h2 class="text-xl font-semibold mb-2">Jobs Posted</h2>
      <div v-if="!company.jobs.length" class="text-gray-500">No jobs posted.</div>
  
      <ul v-else class="space-y-2">
        <li
          v-for="job in company.jobs"
          :key="job.id"
          class="p-4 border bg-white rounded shadow-sm"
        >
          <h3 class="text-lg font-medium">{{ job.title }}</h3>
          <p class="text-sm text-gray-500">
            {{ job.location }} • {{ job.type }} • {{ formatDate(job.created_at) }}
          </p>
          <span
            class="inline-block mt-1 text-xs px-2 py-1 rounded font-medium"
            :class="{
              'bg-green-100 text-green-800': job.status === 'open',
              'bg-yellow-100 text-yellow-800': job.status === 'draft',
              'bg-red-100 text-red-800': job.status === 'closed',
            }"
          >
            {{ job.status }}
          </span>
        </li>
      </ul>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      company: Object,
    },
    methods: {
      formatDate(date) {
        return new Date(date).toLocaleDateString()
      },
    },
  }
  </script>
  