<template>
  <div class="bg-white shadow rounded-lg p-5 flex items-start justify-between">
    <div>

      <Link :href="href" class="text-xl font-bold text-blue-700">{{ title }}</Link>
      <p class="text-sm text-gray-600">{{ company }}</p>
      <div class="text-sm mt-2 flex flex-wrap gap-2">
        <span class="bg-gray-100 px-2 py-1 rounded">{{ experience }}</span>
        <span class="bg-gray-100 px-2 py-1 rounded">{{ type }}</span>
        <span class="bg-gray-100 px-2 py-1 rounded">{{ mode }}</span>
      </div>
    </div>
    <img :src="src" :alt="alt" class="w-16 h-16 object-contain" />
  </div>

</template>


<script>
import { Link } from '@inertiajs/vue3';

export default {
  props: {
    href: String,
    title: String,
    company: String,
    type: String,
    experience: String,
    mode: String,
    src: String,
    alt: String,
  },

}
</script>