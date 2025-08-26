<template>
  <div class="max-w-4xl mx-auto p-6 bg-white shadow rounded-2xl">
    <h1 class="text-2xl font-semibold mb-6">Create New Job</h1>


    <form @submit.prevent="submitJob" class="space-y-6">
      <!-- Job Title -->
      <div>
        <Input label="Title" v-model="form.title" placeholder="Job Title" name="title" :error="form.errors.title" />
      </div>

      <!-- Job Category + Type + Level -->
      <div class="grid md:grid-cols-3 gap-4">
        <div>
          <Select name="Category" label="Select Job Category" optionTitle="choose a category" :values="jobCategories"
            labelKey="name"  v-model="form.job_category_id" :error="form.errors.job_category_id" />
        </div>
        <div>
          <Select name="Type" label="Select Job Type" optionTitle="choose a Type" :values="jobTypes" labelKey="job_type"
            v-model="form.job_type_id" :error="form.errors.job_type_id" />
        </div>
        <div>
          <Select name="Governorate" label="Select Location" optionTitle="choose a Location" :values="governorates"
            labelKey="name" v-model="form.governorate_id" :error="form.errors.governorate_id" />
        </div>

      </div>


      <div class="grid grid-cols-2">

        <div>
          <date-input name="deadline" label="Application Deadline" v-model="form.application_deadline"
            :error="form.errors.application_deadline" />
        </div>
      </div>

      <!-- Salary Range -->
      <div class="grid grid-cols-2 gap-4">
        <div>
          <Input label="Salary" placeholder="Job Salary" v-model="form.salary" name="salary" type="number"
            :error="form.errors.salary" />

        </div>
      </div>

      <!-- Description -->
      <div>
        <text-area v-model="form.description" label="Description" name="description" placeholder="Job Description"
          :error="form.errors.description" />
      </div>

      <!-- Requirements -->
      <div>
        <text-area v-model="form.requirements" label="Requirements" name="requirements" placeholder="Job Requirements"
          :error="form.errors.requirements" />

      </div>

      <!-- skills  -->
      <div>
        <Tags label="Add Skills" v-model="form.skills" placeholder="Enter skills" :error="form.errors.skills" />
      </div>

      <!-- Submit Button -->
      <div class="text-right">
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-xl hover:bg-blue-700 transition">
          Publish Job
        </button>
      </div>
    </form>
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

export default {


  mounted(){
    console.log(this.job);
    
  },
  props: {
    jobCategories: Array,
    jobTypes: Array,
    governorates: Array,
    job: Object,

  },
  components: { Tags, Input, Select, TextArea, CheckBox, DateInput },

  setup(props) {
    const form = useForm({
      title: props.job.title,
      job_category_id: props.job.job_category_id,
      job_type_id: props.job.job_type_id,
      application_deadline: props.job.application_deadline,
      governorate_id: props.job.governorate_id,
      skills: props.job.skills,
      salary: props.job.salary,
      description: props.job.description,
      requirements: props.job.requirements,
    });

    const submitJob = () => {
      form.put(`/company/jobs/${props.job.id}/update`);
    };

    return { form, submitJob };
  },

};
</script>