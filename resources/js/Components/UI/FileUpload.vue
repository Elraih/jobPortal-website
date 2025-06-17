<template>

    <label v-if="lable" class="block mb-2 text-sm font-medium text-gray-900 " for="file_input">{{ lable }}</label>
    <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none" :id="lable" :type="type">
</template>


<script>
export default{

    props:{
        lable: String,
        type: String,

    }
}
</script>
