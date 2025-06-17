<template>  
<div class="max-w-sm mx-auto">
  <label :for="name" class="block mb-2 text-sm font-medium text-gray-900 ">{{label}}</label>
  <select :id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
    <option selected>{{ optionTitle }}</option>
    <option v-for="val in values" :value="val.val">{{ val.title }}</option>
  </select>
</div>

</template>

<script>
export default{
    props:{
        name: String,
        label: String,
        optionTitle: String,
        values: {
            type: Array,
            required: true
        }

    },

}

</script> 



  
  