<template>
    <div class="max-w-3xl mx-auto py-10 px-4">
      <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">{{ job.title }}</h1>
  
        <div class="text-sm text-gray-500 mt-1">
          {{ job.location }} • {{ job.type }}
        </div>
  
        <div class="mt-2 text-sm text-gray-700">
          <span class="font-medium">Company:</span>
          <span>{{ job.company?.name }}</span>
          <span v-if="job.company?.website" class="ml-2">
            |
            <a
              :href="job.company.website"
              target="_blank"
              class="text-blue-600 hover:underline"
            >Visit Website</a>
          </span>
        </div>
  
        <div class="mt-2">
          <span
            class="inline-block text-xs px-2 py-1 rounded font-medium"
            :class="{
              'bg-green-100 text-green-800': job.status === 'open',
              'bg-red-100 text-red-800': job.status === 'closed',
              'bg-yellow-100 text-yellow-800': job.status === 'draft',
            }"
          >
            {{ job.status }}
          </span>
        </div>
      </div>
  
      <div class="prose max-w-none text-gray-800" v-html="job.description"></div>
  
      <!-- Apply Button -->
      <div class="mt-8">
        <Link
          v-if="job.status === 'open'"
          :href="`/jobs/${job.id}/apply`"
          class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-6 py-2 rounded"
        >
          Apply Now
        </Link>
      </div>
    </div>
  </template>
  
  <script>
  import { Link } from '@inertiajs/vue3';
  
  export default {
    props: {
      job: Object,
    },
    components: { Link },
  }
  </script>
  