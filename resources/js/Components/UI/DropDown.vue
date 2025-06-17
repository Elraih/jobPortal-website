<template>
    <div>
      <button
        @click="toggle"
        class="bg-blue-100 hover:bg-blue-200 w-full flex items-center justify-between px-4 py-2 text-sm font-medium text-left text-gray-700 rounded"
      >
        <span class="flex items-center gap-2">{{ label }}</span>
        <svg
          class="w-4 h-4 transform transition-transform duration-200"
          :class="{ 'rotate-180': open }"
          fill="none"
          stroke="currentColor"
          viewBox="0 0 24 24"
        >
          <path d="M6 9l6 6 6-6" />
        </svg>
      </button>
  
      <transition name="fade">
        <div v-if="open" class="ml-4 mt-2 space-y-1">
          <slot />
        </div>
      </transition>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      label: String,
    },
    data() {
      return {
        open: false,
      };
    },
    methods: {
      toggle() {
        this.open = !this.open;
      },
    },
  };
  </script>
  
  