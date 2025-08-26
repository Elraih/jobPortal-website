<template>
  <div class="bg-white shadow rounded-lg p-3 mb-5">
    <div class="flex justify-between">
      <div>
        <Link :href="titleLink" class="text-xl font-bold text-blue-700">{{ title }}</Link>
        <Link :href="companyLink" class="block text-sm text-gray-600 hover:underline hover:text-blue-500">{{ company }}</Link>
        <!-- <p class="text-sm text-gray-600">{{ company }}</p> -->
       <p class="text-sm text-gray-600">{{ category }}</p>
      </div>
      <div>
        <img :src="logo" :alt="alt" class="w-20" />
      </div>
    </div>
    <div class="text-sm  flex flex-wrap gap-2">
      <span class="bg-gray-100 px-2 py-1 rounded">{{ location }}</span>
      <span class="bg-gray-100 px-2 py-1 rounded">{{ type }}</span>
    </div>
    <ul class="flex gap-2 mt-4 flex-wrap  contain-content">
      <li v-for="skill in skills" class=" bg-blue-400 text-white px-2 py-1 rounded">{{ skill }}</li>
    </ul>
    
    <p class=" text-gray-600">{{ posted_on }}</p>
  </div>

</template>


<script>
import { Link } from '@inertiajs/vue3';

export default {
  props: {
    titleLink: String,
    title: String,
    skills: Array,
    category: {
      type: String,
      default: '',
    },
    company: String,
    companyLink: { type: String, default: ''},
    type: String,
    location: String,
    posted_on: String,
    logo: {
      type: String,
      default: '/img/company_default.png'
    },
    alt: String,
  },

}
</script>