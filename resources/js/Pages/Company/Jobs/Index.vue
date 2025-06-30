<template>
  <div class="max-w-6xl mx-auto py-10 px-4">
    <h1 class="text-2xl font-bold mb-6">Your Job Posts</h1>

    <div v-if="!jobs.length" class="text-gray-500">You haven't posted any jobs yet.</div>

    <div class="space-y-4">
      <div v-for="job in jobs" :key="job.id" class="bg-white p-5 rounded shadow flex justify-between items-center">
        <div>
          <h2 class="text-lg font-semibold">{{ job.title }}</h2>
          <p class="text-sm text-gray-500">{{ job.location }} • {{ job.type }}</p>
          <span class="inline-block mt-1 text-xs px-2 py-1 rounded font-medium" :class="{
            'bg-green-100 text-green-800': job.status === 'open',
            'bg-yellow-100 text-yellow-800': job.status === 'draft',
            'bg-red-100 text-red-800': job.status === 'closed'
          }">
            {{ job.status }}
          </span>
        </div>

        <div class="flex items-center space-x-2">
          <Link :href="`/dashboard/jobs/${job.id}/edit`" class="text-indigo-600 hover:underline text-sm">Edit</Link>
          <Link :href="`/dashboard/jobs/${job.id}/applicants`" class="text-blue-600 hover:underline text-sm">Applicants
          </Link>
          <button @click="deleteJob(job.id)" class="text-red-600 hover:underline text-sm">
            Delete
          </button>
        </div>
      </div>
    </div>
  </div>

</template>

<script>
import { Link } from '@inertiajs/vue3';

export default {
  name: 'CompanyJobs',
  props: {
    jobs: Array,
  },
  methods: {
    deleteJob(id) {
      if (confirm('Are you sure you want to delete this job?')) {
        router.delete(`/dashboard/jobs/${id}`, {
          onFinish: () => {
            // Optionally show success message
          }
        });
      }
    },
  },
};
</script>