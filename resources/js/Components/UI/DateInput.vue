<template>
    <div class="mb-4">
      <label :name="name" :for="name" class="block text-sm font-medium text-gray-700 mb-1">
        {{ label }}
      </label>
      <input
        type="date"
        :id="name" 
        :min="min"
        @input="$emit('update:modelValue', $event.target.value)"
        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
      />
      <small v-if="error" class="mt-2 text-sm  text-red-600 ">{{ error }}</small>

    </div>
  </template>
  
  <script>
  export default {
    props: {
      label: String,
      modelValue: String, // in format "YYYY-MM-DD"
      error: String,
      name: String,
      min: String

    },
    // computed: {
    //   min() {
    //     return new Date().toISOString().split('T')[0];
    //   },
    //   max() {
    //     return new Date().toISOString().split('T')[0];
    //   }
    // }
  };
  </script>
  