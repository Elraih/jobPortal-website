<template>
    <div class="max-w-6xl mx-auto py-10 px-4">
      <h1 class="text-2xl font-bold mb-6">jobSeekers</h1>
  
      <div v-if="jobSeekers.length <= 0 " class="text-gray-500">No jobSeekers found.</div>
  
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
          <tr v-for="jobSeeker in jobSeekers" :key="jobSeeker.id" class="border-t">
            <td class="px-4 py-2 font-medium">{{ jobSeeker.user_profile.name }}</td>
            <td class="px-4 py-2">
              <a
                v-if="jobSeeker.user_profile.website"
                :href="jobSeeker.user_profile.website"
                target="_blank"
                class="text-blue-600 hover:underline"
              >{{ jobSeeker.user_profile.website }}</a>
              <span v-else class="text-gray-400">—</span>
            </td>
            <td class="px-4 py-2">{{ jobSeeker.job_posts_count }}</td>
            <td class="px-4 py-2">{{ formatDate(jobSeeker.created_at) }}</td>
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
    mounted(){
      console.log(this.jobSeekers);
      
    },
    methods: {
      formatDate(date) {
        return new Date(date).toLocaleDateString()
      },
    },
  }
  </script>
  