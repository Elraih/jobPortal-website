<template>

    <div class="max-w-3xl mx-auto py-10 px-4 space-y-6">
      <h1 class="text-2xl font-bold text-blue-900 mb-4">Edit Skills</h1>
      <form @submit.prevent="submitSkills" class="bg-white shadow rounded-lg p-6">
        
        <!-- tags input componet  -->

        <Tags label="Type The Name Of The Skill And Press 'Enter' Or 'Tab', Then Submit To Save The Skills" v-model="form.skills" :error="form.errors.skills" name="skills" placeholder="Enter skills"  />
        
        <div class="mt-10 mb-5 ">
          <button type="submit" class="bg-blue-400 text-white p-3 rounded-lg ">Submit</button>
        </div>
      </form>
    </div>
</template>
  
<script>
import Tags from '@/Components/UI/Tags.vue';
import { router, useForm } from '@inertiajs/vue3';
import { route } from 'ziggy-js';


  export default {


    components: {Tags},
    props:{
      user: Object,
      
    },
    data() {
      return {
        form:useForm({
          skills: this.user.skill?.skills ? this.user.skill?.skills : [],
        }),
       
      };
    },
    methods: {

      submitSkills(){
        this.form.post(route('user.profile.editSkills', this.user.id));
      }
    },
    mounted(){
      
      
    }
  };
</script>
  