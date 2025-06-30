<template>
  <div class="max-w-5xl mx-auto py-10 px-4">
    <h1 class="text-2xl font-bold mb-6">
      Applications for: <span class="text-indigo-700">title</span>
    </h1>

    <div v-if="applications.length <= 0" class="text-gray-500">No applications yet.</div>

    <div v-else class="space-y-4">
      <div v-for="application in applications" :key="application.id" class="bg-white p-5 shadow rounded border">
        <div class="flex justify-between items-start">
          <div>
            <h2 class="font-semibold text-lg">{{ application.user.name }}</h2>
            <p class="text-sm text-gray-500">{{ application.user.email }}</p>
          </div>
          <div class="text-sm text-gray-400">
            Applied on {{ formatDate(application.created_at) }}
          </div>
        </div>
        <div class="mt-4 text-sm">
          <strong>Cover Letter:</strong>
          <p class="mt-1 text-gray-700 whitespace-pre-line">{{ application.cover_letter }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    job: Object,
    applications: Array,
  },
  methods: {
    formatDate(date) {
      return new Date(date).toLocaleDateString();
    },
  },
}
</script>