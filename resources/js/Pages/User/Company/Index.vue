<template>
  <div class="max-w-6xl mx-auto py-10 px-4">
    <h1 class="text-3xl font-bold mb-6">Explore Companies</h1>

    <div v-if="!companies.length" class="text-gray-500">No companies found.</div>

    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
      <div v-for="company in companies" :key="company.id"
        class="bg-white shadow-sm rounded border p-5 hover:shadow-md transition">
        <h2 class="text-lg font-semibold text-gray-800">{{ company.name }}</h2>

        <p class="text-sm text-gray-500 mt-1">
          <span class="font-medium text-gray-600">Jobs:</span> {{ company.jobs_count }}
        </p>

        <div class="mt-2">
          <a v-if="company.website" :href="company.website" class="text-blue-600 text-sm hover:underline"
            target="_blank" rel="noopener noreferrer">
            Visit Website →
          </a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    companies: Array,
  },
}
</script>