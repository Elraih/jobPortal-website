<template>
    <footer class="bg-gray-900 text-gray-300 py-10 ">
      <div v-if="FooterLink" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">   
        <!-- Logo & Description -->
          <Link :href="FooterLink" class="text-xl font-bold text-white">Jobify</Link>
          <p class="mt-4 text-sm text-gray-400">
            Find your dream job or the perfect candidate. Powered by community.
          </p>
          
        <div class="mt-8 border-t border-gray-700 pt-6 text-sm text-center text-gray-500">
          &copy; {{ new Date().getFullYear() }} Jobify. All rights reserved.
        </div>
      </div>
    </footer>
  </template>
  
  <script>
  import { Link } from '@inertiajs/vue3'
  
  export default {
    components: { Link },
    props:{
      FooterLink: {
        type: String,
        default: ''
      },
    }
  }
  </script>
  