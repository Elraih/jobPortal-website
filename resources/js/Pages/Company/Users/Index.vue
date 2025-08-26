<template>
    <div class="max-w-6xl mx-auto py-10 px-4">
      <h1 class="text-2xl font-bold mb-6">Job Seekers</h1>
  
      <div v-if="!jobSeekers.length" class="text-gray-500">No job seekers found.</div>
  
      <table v-else class="w-full table-auto border shadow text-sm bg-white rounded">
        <thead class="bg-gray-100 text-left">
          <tr>
            <th class="px-4 py-2">Name</th>
            <th class="px-4 py-2">Email</th>
            <th class="px-4 py-2">Applications</th>
            <th class="px-4 py-2">Joined</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in jobSeekers" :key="user.id" class="border-t">
            <td class="px-4 py-2 font-medium">{{ user.name }}</td>
            <td class="px-4 py-2">{{ user.email }}</td>
            <td class="px-4 py-2">{{ user.applications_count }}</td>
            <td class="px-4 py-2">{{ formatDate(user.created_at) }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      jobSeekers: Array,
    },
    methods: {
      formatDate(date) {
        return new Date(date).toLocaleDateString()
      },
    },
  }
  </script>
  