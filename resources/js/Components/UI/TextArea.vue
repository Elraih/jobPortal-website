<template>


    
<label v-if="label" :for="name" class="block mb-2 text-sm font-medium text-gray-900 ">{{ label }}</label>
<textarea :id="name" @input="$emit('update:modelValue', $event.target.value)" :rows="rows" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 " :placeholder="placeholder" :required="required"></textarea>
<small v-if="error" class="mt-2 text-sm  text-red-600 ">{{ error }}</small>

</template>

<script>
export default{
    props:{
        modelValue: String,
        label: String,
        name: String,
        type: { type: String, default: 'text' },
        placeholder: String,
        rows:{type: Number, default: 4},
        error: String,
        required: Boolean
    },
   
    emits: ['update:modelValue']
    
}

</script> 

<!-- components/RichTextEditor.vue -->

  

  