<template>
    <div class="max-w-6xl mx-auto py-10 px-4">
      <h1 class="text-2xl font-bold mb-6">Companies</h1>
  
      <div v-if="!companies.length" class="text-gray-500">No companies found.</div>
  
      <table v-else class="w-full table-auto border shadow text-sm bg-white rounded">
        <thead class="bg-gray-100 text-left">
          <tr>
            <th class="px-4 py-2">Name</th>
            <th class="px-4 py-2">Website</th>
            <th class="px-4 py-2">Jobs</th>
            <th class="px-4 py-2">Joined</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="company in companies" :key="company.id" class="border-t">
            <td class="px-4 py-2 font-medium">{{ company.name }}</td>
            <td class="px-4 py-2">
              <a
                v-if="company.website"
                :href="company.website"
                target="_blank"
                class="text-blue-600 hover:underline"
              >{{ company.website }}</a>
              <span v-else class="text-gray-400">—</span>
            </td>
            <td class="px-4 py-2">{{ company.jobs_count }}</td>
            <td class="px-4 py-2">{{ formatDate(company.created_at) }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      companies: Array,
    },
    methods: {
      formatDate(date) {
        return new Date(date).toLocaleDateString()
      },
    },
  }
  </script>
  