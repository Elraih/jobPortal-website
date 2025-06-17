<template>
    <footer class="bg-gray-900 text-gray-300 py-10 mt-12">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
          
          <!-- Logo & Description -->
          <div>
            <Link href="/" class="text-xl font-bold text-white">Jobify</Link>
            <p class="mt-4 text-sm text-gray-400">
              Find your dream job or the perfect candidate. Powered by community.
            </p>
          </div>
  
          <!-- Navigation Links -->
          <div>
            <h3 class="text-sm font-semibold text-white mb-4">Navigation</h3>
            <ul class="space-y-2 text-sm">
              <li><Link href="/" class="hover:text-white">Home</Link></li>
              <li><Link href="/jobs" class="hover:text-white">Jobs</Link></li>
              <li><Link href="/share-job" class="hover:text-white">Share a Job</Link></li>
              <li><Link href="/contact" class="hover:text-white">Contact</Link></li>
            </ul>
          </div>
  
          <!-- For Job Seekers -->
          <div>
            <h3 class="text-sm font-semibold text-white mb-4">Job Seekers</h3>
            <ul class="space-y-2 text-sm">
              <li><Link href="/register" class="hover:text-white">Create Account</Link></li>
              <li><Link href="/login" class="hover:text-white">Login</Link></li>
              <li><Link href="/categories" class="hover:text-white">Browse Categories</Link></li>
            </ul>
          </div>
  
          <!-- Social Media -->
          <div>
            <h3 class="text-sm font-semibold text-white mb-4">Follow Us</h3>
            <div class="flex space-x-4">
              <a href="#" class="hover:text-white">Facebook</a>
              <a href="#" class="hover:text-white">Twitter</a>
              <a href="#" class="hover:text-white">LinkedIn</a>
            </div>
          </div>
  
        </div>
  
        <div class="mt-8 border-t border-gray-700 pt-6 text-sm text-center text-gray-500">
          &copy; {{ new Date().getFullYear() }} Jobify. All rights reserved.
        </div>
      </div>
    </footer>
  </template>
  
  <script>
  import { Link } from '@inertiajs/vue3'
  
  export default {
    components: { Link }
  }
  </script>
  