<!-- <template>

<div class="flex items-center mb-4">
    <input :id="name" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 focus:ring-2 ">
    <label :for="name" class="ms-2 text-sm font-medium text-gray-900 ">{{ label }}</label>
</div>
</template>


<script>
export default{
    props:{
        name: String,
        label: String,
        
    }
} 

</script> -->

<template>
    <div class="mb-2 flex items-center space-x-2">
      <input
        type="checkbox"
        :id="name"
        :name="name"
        :value="value"
        v-bind="modelValue"
        @change="$emit('update:modelValue', modelValue)"
        class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
      />
      <label :for="name" class="text-sm text-gray-700">{{ label }}</label>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      name: String,
      label: String,
      value: [String, Boolean],
      modelValue: [Array, Boolean] // array for multiple, boolean for single
    }
  };
  </script>
  