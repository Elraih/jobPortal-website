<template>
  <div class="max-w-3xl mx-auto py-10 px-4">
    <h1 class="text-2xl font-bold mb-4">Company Profile</h1>

    <div class="bg-white shadow rounded p-6 space-y-4">
      <div>
        <p class="font-semibold text-gray-700">Name:</p>
        <!-- <p class="text-gray-900">{{ company.name }}</p> -->
      </div>

      <div v-if="company">
        <p class="font-semibold text-gray-700">Website:</p>
        <p>
          <!-- <a :href="company.website" class="text-blue-600 hover:underline" target="_blank">
            {{ company.website }}
          </a> -->
        </p>
      </div>

      <div v-if="company">
        <p class="font-semibold text-gray-700">Description:</p>
        <p class="text-gray-800 whitespace-pre-line">{{ company.description }}</p>
      </div>

      <div>
        <Link :href="route('company.profile.edit')" class="inline-block mt-4 text-indigo-600 hover:underline">
        Edit Profile
        </Link>
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
}
</script>
