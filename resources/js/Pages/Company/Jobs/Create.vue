<template>
  <div class="mx-auto p-6 bg-white shadow rounded-2xl">
    <h1 class="text-2xl text-blue-900 font-semibold mb-6">Create New Job</h1>

    <!-- start create job post form  -->
    <form @submit.prevent="submitJob()" class="space-y-6">
      <!-- Job Title -->
    
        <Input label="Title" v-model="form.title" placeholder="Job Title" name="title" :error="form.errors.title" />
      

      <!-- Job Category + Type + Level -->
      <div class="grid md:grid-cols-3 gap-4">
        
          <Select name="category" label="Select Job Category"  optionTitle="choose a category" :values="jobCategories"
            labelKey="name" v-model="form.job_category_id" :error="form.errors.job_category_id" />
        
          <Select name="type" label="Select Job Type" optionTitle="choose a Type" :values="jobTypes" labelKey="job_type"
            v-model="form.job_type_id" :error="form.errors.job_type_id" />
       
          <Select name="governorate" label="Select Location" optionTitle="choose a Location" :values="governorates"
            labelKey="name" v-model="form.governorate_id" :error="form.errors.governorate_id" />
        

      </div>


      <!-- dateline input -->
      <div class="grid grid-cols-2">
          <date-input name="deadline" :min="new Date().toISOString().split('T')[0]" label="Application Deadline" v-model="form.application_deadline"
            :error="form.errors.application_deadline" />
      </div>
      <!-- end dateline input -->


      <!-- Salary Range -->
      <div class="grid grid-cols-2 gap-4">
          <Input label="Salary" placeholder="Job Salary" v-model="form.salary" name="salary" type="number"
            :error="form.errors.salary" />
      </div>
      <!-- end Salary Range -->

      <!-- Description -->
      
        <text-area v-model="form.description" label="Description" name="description" placeholder="Job Description"
          :error="form.errors.description" />
     

      <!-- Requirements -->
        <text-area v-model="form.requirements" label="Requirements" name="requirements" placeholder="Job Requirements"
          :error="form.errors.requirements" />
      <!-- end Requirements -->


      <!-- skills  -->
      <div>
        <Tags label="Add Skills" v-model="form.skills" placeholder="Enter skills" name="skills" :error="form.errors.skills" />
      </div>
      <!--end  skills  -->

      

      <!-- Submit Button -->
      <div class="text-right">
        <primary-button :type="'submit'" :title="'Publish Job'" />
      </div>
    </form>
    <!-- end create job post form  -->

  </div>
</template>

<script>
import CheckBox from '@/Components/UI/CheckBox.vue';
import DateInput from '@/Components/UI/DateInput.vue';
import Input from '@/Components/UI/Input.vue';
import Select from '@/Components/UI/Select.vue';
import Tags from '@/Components/UI/Tags.vue';
import TextArea from '@/Components/UI/TextArea.vue';

import { router, useForm } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/UI/PrimaryButton.vue';

export default {

  props: {
    jobCategories: Array,
    jobTypes: Array,
    governorates: Array,

  },
  components: { Tags, Input, Select, TextArea, CheckBox, DateInput, PrimaryButton },

  setup() {
    const form = useForm({
      title: '',
      job_category_id: '',
      job_type_id: '',
      application_deadline: null,
      governorate_id: null,
      skills: [],
      salary: null,
      description: '',
      requirements: '',
    });

    const submitJob = () => {
      form.post('/company/jobs/store');
      // console.log(form);
      
    };

    return { form, submitJob };
  },

};
</script>