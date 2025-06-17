<template>
    <div class="mb-4">
      <label :for="name" class="block text-sm font-medium text-gray-700 mb-1">
        {{ label }}
      </label>
      <input
        type="date"
        :id="name"
        :name="name"
        :value="modelValue"
        :min="minDate"
        @input="$emit('update:modelValue', $event.target.value)"
        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
      />
    </div>
  </template>
  
  <script>
  export default {
    props: {
      name: String,
      label: String,
      modelValue: String, // in format "YYYY-MM-DD"
    },
    computed: {
      minDate() {
        const today = new Date();
        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, '0');
        const day = String(today.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`; // YYYY-MM-DD
      }
    }
  };
  </script>
  