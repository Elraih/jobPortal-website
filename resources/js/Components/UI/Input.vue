<template>
    <div>
        <label v-if="label" :for="name" class="block mb-2 text-sm font-medium text-gray-900 ">{{ label }}</label>
        <input :type="type" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" :id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" :placeholder="placeholder" :autocomplete="autocomplete" :required="required"/>

        <small v-if="error" class="mt-2 text-sm  text-red-600 ">{{ error }}</small>
    </div>
</template>

<script>
export default{
    props:{
        modelValue: [String, Number],
        label: {type: String, default: ''},
        name: {type: String, default: ''},
        type: {type: String, default: 'text' },
        placeholder: String,
        error: String,
        required: {type: Boolean, default: true},
        autocomplete: {type: String, default: 'off'},
    },
    
}

</script>