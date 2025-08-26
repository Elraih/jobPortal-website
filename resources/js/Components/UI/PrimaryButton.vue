<template>
   <button :type="type" class="text-white cursor-pointer bg-indigo-900 hover:bg-indigo-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2  focus:outline-none ">{{ title }}</button>
</template>

<script>
export default{
    props:{
        type: String,
        title: String,
    }
}
</script>