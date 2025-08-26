<template>


  <form @submit.prevent="submitSearch" class="flex flex-col md:flex-row mb-10 gap-4 justify-center text-white">
    <input v-model="form.keyword" type="text" placeholder="Job title, keywords..." name="keywords"
      :class="['w-full md:w-1/3 px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500', textColor]" />
    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
      Search
    </button>
  </form>

</template>


<script>
import { useForm } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

export default {
  props: {
    textColor: {
      type: String,
      default: 'text-white',
    },
  },
  emits: ['update-keyword'], // Declare event
  setup(props, { emit }) {
    const form = useForm({
      keyword: '',
    });

    const submitSearch = () => {
      form.keyword = form.keyword.trim();
      form.get(route('user.jobs.index'));
      emit('update-keyword', form.keyword); // Emit the keyword to parent

    };

    return { form, submitSearch };
  },
};
</script>
