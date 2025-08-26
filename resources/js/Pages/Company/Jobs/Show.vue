<template>
  <div class="max-w-5xl mx-auto space-y-5">

    <!-- Header -->
    <header class=" bg-white p-5 rounded-md flex flex-col md:flex-row justify-between">
      <div class="items-center text-sm text-gray-500 gap-2 ">
        <h1 class="text-3xl font-bold text-gray-900 tracking-tight">{{ jobPost.title }}</h1>
        <ul class="flex gap-3 my-4">
          <li class="border-e-2 pe-2">{{ jobPost.job_category?.name }}</li>
          <li class="border-e-2 pe-2">{{ jobPost.job_type?.job_type }}</li>
          <li class="border-e-2 pe-2">{{ jobPost.governorate?.name }}</li>
        </ul>
      </div>
      <div class="">
        <JobPostStatus :status="jobPost.status">
        {{ jobPost.status }}
      </JobPostStatus>
      <ul class="flex gap-3 mt-4 items-center">

        <li v-if="!jobPost.deleted_at"><Link :href="route('company.jobs.edit', {jobPost: jobPost.id})" class="text-md bg-yellow-200 hover:text-white hover:bg-yellow-400 text-yellow-900 px-2 py-1 rounded-md">Edit Job Post</Link></li>
        <li v-if="!jobPost.deleted_at"><button @click.prevent="deleteJobPost(jobPost.id)" class="text-md bg-red-200 text-red-900 px-2 py-1 hover:text-white hover:bg-red-400 rounded-md cursor-pointer">Archive Job Post</button></li>
      </ul>
      </div>
    </header>

    <!-- Quick Stats -->
    <section class="bg-white p-5 rounded-md grid grid-cols-1 sm:grid-cols-3 gap-6">
      <div>
        <p class="text-xs text-gray-500 font-medium ">Salary</p>
        <p class="text-base text-gray-900">
          {{ jobPost.salary ? `$${jobPost.salary}` : 'Not specified' }}
        </p>
      </div>

      <div>
        <p class="text-xs text-gray-500 font-medium mb-1">Application Deadline</p>
        <p class="text-base text-gray-900">
          {{ formatDate(jobPost.application_deadline) || 'N/A' }}
        </p>
      </div>

      <div>
        <p class="text-xs text-gray-500 font-medium mb-1">Applicants</p>
        <p class="text-base text-blue-700 font-semibold">
          {{ jobPost.job_applications_count || 0 }} applied
        </p>
      </div>
    </section>

    <!-- Description -->
    <section class="space-y-3 bg-white p-5 rounded-md">
      <div class="">
        <h2 class="text-xl font-semibold text-gray-800">Job Description</h2>
      <div class="prose max-w-none text-gray-700" v-html="jobPost.description || '<p>No description provided.</p>'" />
      </div>
      <div class="my-10">
        <h2 class="text-xl font-semibold text-gray-800">Requirements</h2>
        <p class="text-gray-700 whitespace-pre-line">
          {{ jobPost.requirements || 'Not specified.' }}
        </p>
      </div>
    
      <h2 class="text-xl font-semibold text-gray-800">Required Skills</h2>
      <div v-if="jobPost.skills.length > 0" class="flex flex-wrap gap-2">
        <span
          v-for="(skill, index) in jobPost.skills"
          :key="index"
          class="bg-gray-100 text-gray-800 text-xs px-3 py-1 rounded-full font-medium"
        >
          {{ skill }}
        </span>
      </div>
      <p v-else class="text-gray-400 text-sm">No skills listed.</p>
    </section>

    <!-- Footer Meta -->
    <footer class="pt-6 border-t border-gray-100 text-sm text-gray-400 text-center">
      Posted on {{ formatDate(jobPost.created_at) }}
    </footer>

  </div>
</template>



<script>
import JobPostStatus from '@/Components/JobPostStatus.vue';
import { route } from 'ziggy-js';
export default {
  components: {JobPostStatus},
  name: 'JobShowCompany',
  props: {
    jobPost: {
      type: Object,
      required: true,
    },
  },
  methods: {
    formatDate(date) {
      if (!date) return null;
      return new Date(date).toLocaleDateString(undefined, {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
      });
    },

    deleteJobPost(id){
      this.$inertia.delete(route('company.jobs.softDelete', {jobPost: id}));
    }
  },
  mounted(){
    console.log(this.jobPost);
    
  }
};
</script>
