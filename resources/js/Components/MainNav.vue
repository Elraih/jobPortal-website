<template>
  <!-- <nav class=" bg-transparent text-white"> -->
  <nav>
    <div class="max-w-screen-xl flex items-center justify-between mx-auto p-4">
      <Link :href="route('home')" class="text-xl font-bold">Logo</Link>

      <!-- Hamburger Button -->
      <button @click="toggleNav" type="button"
        class="inline-flex items-center p-2 rounded-lg md:hidden focus:outline-none">
        <svg :class="{ 'text-white': isTransparent }" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
          viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>

      <!-- Desktop Menu -->
      <ul class="hidden md:flex space-x-6 font-medium">
        <li>
          <Link :href="route('user.jobs.index')" class="hover:text-blue-400">Vacancies</Link>
        </li>
        <li>
          <Link :href="route('auth.login')" class="hover:text-blue-400">Login</Link>
        </li>
        <li>
          <Link :href="route('auth.registerAsCompany')" class="hover:text-blue-400 px-2 py-1 border-1 border-solid">
          Share A
          Job</Link>
        </li>
        <li>
          <Link :href="route('auth.registerAsJobSeeker')" class="hover:text-blue-400 px-2 py-1 border-1 border-solid">
          Looking
          For a Job</Link>
        </li>
      </ul>
    </div>

    <!-- Overlay -->
    <div v-if="isActive" @click="toggleNav" class="fixed inset-0 bg-black/50 z-40 md:hidden"></div>

    <!-- Mobile Menu (Right Drawer) -->
    <div
      class="fixed top-0 right-0 w-64 h-full bg-white text-black z-50 transform transition-transform duration-300 ease-in-out md:hidden"
      :class="{ 'translate-x-0': isActive, 'translate-x-full': !isActive }">
      <div class="p-4 flex justify-between items-center border-b">
        <span class="text-lg font-semibold">Menu</span>
        <button @click="toggleNav" class="text-gray-500 hover:text-gray-700">
          ✕
        </button>
      </div>
      <ul class="flex flex-col gap-4 p-4 font-medium">
        <li>
          <Link :href="route('home')" class="hover:text-blue-600">Vacancies</Link>
        </li>
        <li>
          <Link :href="route('auth.login')" class="hover:text-blue-600">Login</Link>
        </li>
        <li>
          <Link :href="route('auth.registerAsCompany')" class="hover:text-blue-600">Share A Job</Link>
        </li>
        <li>
          <Link :href="route('auth.registerAsJobSeeker')" class="hover:text-blue-600">Looking For a Job</Link>
        </li>
      </ul>
    </div>
  </nav>
</template>

<script>
import { Link } from '@inertiajs/vue3'

export default {
  components: { Link },

  props: {

  },

  data() {
    return {
      isActive: false,
    }
  },
  methods: {
    toggleNav() {
      this.isActive = !this.isActive
    },
  },
}
</script>
