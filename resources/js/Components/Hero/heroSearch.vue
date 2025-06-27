<template>


  <form @submit.prevent="submitSearch" class="flex flex-col md:flex-row gap-4 justify-center text-white">
    <input v-model="form.keyword" type="text" placeholder="Job title, keywords..."
      class="w-full md:w-1/3 px-4 text-black py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" />
    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
      Search
    </button>
  </form>
</template>



<script>
import { router, useForm } from '@inertiajs/vue3';

export default {

  setup() {
    const form = useForm({
      keyword: '',
    });

    const submitSearch = () => {
      if (form.keyword != '') {

        router.get('/user/jobs', { keyword: form.keyword });
      }

    }
    return { form, submitSearch };


    // methods: {
    //     console.log(this.keyword);
    //     form.post()
    //     // this.$emit('search', {
    //     //   keyword: this.keyword,
    //     // })
    //   }


  }
}
</script>