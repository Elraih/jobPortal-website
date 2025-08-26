<template>
  <div class="max-w-6xl mx-auto py-10 px-4">
    <h1 class="text-2xl font-bold mb-6">Your Job Posts</h1>

    <form ref="fil" @submit.prevent="filter" class="grid grid-cols-1 md:grid-cols-4 gap-2">
      <input type="text" v-model="form.title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Ex: Engineer" />
      <select v-model="form.job_category" name="job_category" id="" class="bg-gray-50 border border-gray-300">
        <option value="" >Select Category</option>
        <option v-for="jobCategory in jobCategories" :key="jobCategory.id" :value="jobCategory.id" >{{ jobCategory.name }}</option>
      </select>
      <select v-model="form.job_type" name="job_type" id="" class="bg-gray-50 border border-gray-300">
        <option value="" >Select Job Type</option>
        <option v-for="jobType in jobTypes" :key="jobType.id" :value="jobType.id" >{{ jobType.job_type }}</option>
      </select>

      <div>
        <button type="submit" class="bg-blue-500 text-white p-2 rounded-lg mx-2">Search</button>
        <button @click.prevent="clearFilter" class="bg-gray-500 text-white p-2 rounded-lg">Clear Filter</button>
      </div>
      </form>

    <div  class=" my-10">
    <p v-if="jobs.data.length <= 0 " class="text-gray-500 mt-5 text-2xl">No jobs Listed.</p>
    <div v-else>
      
    <Table>
      <template v-slot:tableHead>
          <th class="px-4 py-2">#</th>
          <th class="px-4 py-2">Job Title</th>
          <th class="px-4 py-2">Posted Date</th>
          <th class="px-4 py-2">Num. Applicants</th>
          <th class="px-4 py-2">status</th>
          <th class="px-4 py-2">Action</th>
        
      </template>

      <template v-slot:tableBody >
         <tr v-for="job, index in jobs.data" >
          <td class="px-4 py-2">{{ ++index }}</td>
          <td class="px-4 py-2"><Link :href="route('company.jobs.show', {slug: job.slug})" class="font-semibold text-lg text-blue-500 ">{{ job.title}}</Link></td>
          <td class="px-4 py-2">{{job.created_at_human}}</td>

          <td class="px-4 py-2"><Link :href="route('company.job-applications.index', {jobPost: job.id})" class="font-semibold text-lg text-blue-500 ">{{ job.job_applications_count}}</Link></td>
          <td class="px-4 py-2"><JobPostStatus :status="job.status"></JobPostStatus></td>
          <td class="px-4 py-2">
            <button class="mx-1 cursor-pointer bg-blue-300 text-white py-1 px-2 rounded-md">View</button>
          </td>
         </tr>
         
      </template>
    </Table>
      <!-- end of jobseeker card  -->
      <Pagination :pagination="jobs" :baseUrl="route('company.jobs.trashed')" />
  
    </div>
  </div>
  </div> 

</template>

<script>
import { Link, router, useForm } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
import JobPostStatus from '@/Components/JobPostStatus.vue';
import Pagination from '@/Components/Pagination.vue';
import Table from '@/Components/UI/Table.vue';

export default {

  components:{Pagination, Table, JobPostStatus},
  mounted(){
    // console.log(this.jobs.data[0].id);
    
  },
  name: 'CompanyJobs',
  props: {
    jobs: Object,
    jobCategories: Array,
    jobTypes: Array,
    jobTypeParam: String,
    jobCategoryParam: String,
    titleParam: String,
  },
  data() {
    return {
      form:useForm({
      job_category: this.jobCategoryParam || '',
      title: this.titleParam || '',
      job_type: this.jobTypeParam || ''

    }), 
    }
  },
  methods: {
  filter(){
    this.form.get(route('company.jobs.trashed'), {
      preserveState: true,
      preserveScroll: true,
      replace: true,
    });
  },
  clearFilter(){
    if(this.form.title != '' || this.form.job_type != '' || this.form.job_category != '' ){
      console.log('clear');
      
      this.$refs.fil.reset();
      this.$inertia.get(route('company.jobs.trashed'));
    }
    
  }

  },

};
</script>