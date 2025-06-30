<template>
  <div class="max-w-6xl mx-auto py-10 px-4">
    <!-- Company Info -->
    <div class="mb-10">
      <h1 class="text-3xl font-bold text-gray-800">{{ company.name }}</h1>

      <div v-if="company.website" class="mt-1">
        <a :href="company.website" target="_blank" class="text-blue-600 hover:underline text-sm">
          {{ company.website }}
        </a>
      </div>

      <div v-if="company.description" class="mt-4 text-gray-700 whitespace-pre-line">
        {{ company.description }}
      </div>
    </div>

    <!-- Job Listings -->
    <div>
      <h2 class="text-2xl font-semibold mb-4">Open Positions</h2>

      <div v-if="!company.jobs.length" class="text-gray-500">This company hasn't posted any jobs yet.</div>

      <div v-else class="space-y-4">
        <div v-for="job in company.jobs" :key="job.id"
          class="border rounded p-4 bg-white shadow-sm hover:shadow transition">
          <h3 class="text-lg font-semibold text-gray-800">
            <Link :href="`/jobs/${job.id}`" class="hover:underline">
            {{ job.title }}
            </Link>
          </h3>
          <p class="text-sm text-gray-600">{{ job.location }} • {{ job.type }}</p>
          <p class="text-xs text-gray-500 mt-1">Posted: {{ formatDate(job.created_at) }}</p>

          <span class="inline-block mt-2 text-xs px-2 py-1 rounded font-medium" :class="{
            'bg-green-100 text-green-800': job.status === 'open',
            'bg-yellow-100 text-yellow-800': job.status === 'draft',
            'bg-red-100 text-red-800': job.status === 'closed',
          }">
            {{ job.status }}
          </span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Link } from '@inertiajs/vue3';

export default {
  props: {
    company: Object,
  },
  methods: {
    formatDate(date) {
      return new Date(date).toLocaleDateString();
    },
  },
  components: { Link }
}
</script>