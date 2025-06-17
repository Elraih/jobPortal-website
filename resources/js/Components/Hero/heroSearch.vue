<template>


<form @submit.prevent="submitSearch" class="flex flex-col md:flex-row gap-4 justify-center text-white">
          <input
            v-model="keyword"
            type="text"
            placeholder="Job title, keywords..."
            class="w-full md:w-1/3 px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
          <input
            v-model="location"
            type="text"
            placeholder="Location (optional)"
            class="w-full md:w-1/4 px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
          <button
            type="submit"
            class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition"
          >
            Search
          </button>
        </form>
</template>



<script>
export default{

data(){
    return{

         keyword :'',
         location: ''
         
    }
},
  methods:{
    submitSearch() {
    this.$emit('search', {
        keyword: this.keyword,
        location: this.location,
    })
  }
  
  
}
}
</script>