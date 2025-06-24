<template>
  <div class="max-w-6xl mx-auto py-10 px-4">
    <h1 class="text-2xl font-bold mb-6">All Job Applications</h1>

    <div v-if="!applications.length" class="text-gray-500">
      No applications found.
    </div>

    <div v-else class="space-y-4">
      <div
        v-for="app in applications"
        :key="app.id"
        class="bg-white p-5 rounded border shadow-sm"
      >
        <div class="flex justify-between items-start">
          <div>
            <h2 class="text-lg font-semibold">{{ app.user.name }}</h2>
            <p class="text-sm text-gray-500">{{ app.user.email }}</p>
            <p class="text-sm text-gray-600">
              <span class="font-medium text-gray-700">Job:</span> {{ app.job.title }}
              <br />
              <span class="font-medium text-gray-700">Company:</span> {{ app.job.company?.name }}
            </p>
          </div>
          <div class="text-xs text-gray-400">
            Applied on {{ formatDate(app.created_at) }}
          </div>
        </div>

        <div class="mt-4 text-sm text-gray-700 whitespace-pre-line">
          <strong>Cover Letter:</strong>
          <p class="mt-1">{{ app.cover_letter }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    applications: Array,
  },
  methods: {
    formatDate(date) {
      return new Date(date).toLocaleDateString();
    },
  },
}
</script>
