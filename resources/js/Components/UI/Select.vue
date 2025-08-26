<template>  
<div class="">
  <label :for="name" class="block mb-2 text-sm font-medium text-gray-900 ">{{label}}</label>
  <select :id="name" :value="modelValue"
      @change="$emit('update:modelValue', $event.target.value)"
  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
    <option value=""  selected>{{ optionTitle }}</option>
    <option v-for="(val, index) in values" 
    :key="index" 
    :value="val[valueKey]"
    >
    {{ val[labelKey] }}
  </option>
  </select>
  <small v-if="error" class="mt-2 text-sm  text-red-600 ">{{ error }}</small>

</div>

</template>

<script>
export default{
    props:{
        name: String,
        label: String,
        optionTitle: String,
        error: String,
        values: {
            type: Array,
            required: true
        }, 
        labelKey: {
            type: String,
            default: 'name',
        },
        valueKey: {
            type: String,
            default: 'id',
        },
        modelValue:[String, Number],

    },
   
  

}

</script> 



  
  