<template>
    <div class="max-w-7xl mx-auto py-10 px-4">
      <h1 class="text-2xl font-bold mb-6">All Job Posts</h1>
  
      <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full table-auto">
          <thead>
            <tr class="bg-gray-100 text-left text-sm font-semibold text-gray-700">
              <th class="px-4 py-2">ID</th>
              <th class="px-4 py-2">Title</th>
              <th class="px-4 py-2">Company</th>
              <th class="px-4 py-2">Location</th>
              <th class="px-4 py-2">Type</th>
              <th class="px-4 py-2">Status</th>
              <th class="px-4 py-2">Posted</th>
              <th class="px-4 py-2 text-right">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="job in jobs"
              :key="job.id"
              class="border-t text-sm hover:bg-gray-50"
            >
              <td class="px-4 py-2">{{ job.id }}</td>
              <td class="px-4 py-2 font-medium">{{ job.title }}</td>
              <td class="px-4 py-2">{{ job.company?.name || '—' }}</td>
              <td class="px-4 py-2">{{ job.location }}</td>
              <td class="px-4 py-2">{{ job.type }}</td>
              <td class="px-4 py-2">
                <span
                  class="inline-block text-xs px-2 py-1 rounded font-medium"
                  :class="{
                    'bg-green-100 text-green-800': job.status === 'open',
                    'bg-yellow-100 text-yellow-800': job.status === 'draft',
                    'bg-red-100 text-red-800': job.status === 'closed'
                  }"
                >
                  {{ job.status }}
                </span>
              </td>
              <td class="px-4 py-2">{{ formatDate(job.created_at) }}</td>
              <td class="px-4 py-2 text-right space-x-2">
                <Link
                  :href="`/admin/jobs/${job.id}`"
                  class="text-blue-600 hover:underline"
                >View</Link>
                <!-- <button class="text-red-600 hover:underline">Delete</button> -->
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </template>
  
  <script>
//   import { Link } from '@inertiajs/vue'
  
  export default {
    name: 'AdminJobIndex',
    props: {
      jobs: Array,
    },
    methods: {
      formatDate(date) {
        return new Date(date).toLocaleDateString();
      },
    },
  };
</script>
  