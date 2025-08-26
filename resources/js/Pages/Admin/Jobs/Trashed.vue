<template>
    <div class="max-w-6xl mx-auto py-10 px-4">
      <h1 class="text-2xl font-bold mb-6">All Jobs</h1>
  

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


      <div v-if="jobPosts.data.length <=  0 " class="text-gray-500 text-center text-2xl">No Job found.</div>

      <div v-else>
      <Table>
        <template v-slot:tableHead>
          <th class="px-4 py-2">#</th>
          <th class="px-4 py-2">Job Title</th>
          <th class="px-4 py-2">Company Name</th>
          <th class="px-4 py-2">Status</th>
          <th class="px-4 py-2">Type</th>
          <th class="px-4 py-2">Created At</th>
          <th class="px-4 py-2">Number Of Applicants</th>
          <!-- <th class="px-4 py-2">Action</th> -->
          
        </template>
        <template v-slot:tableBody>
          <tr v-for="jobPost, index in jobPosts.data">
            <td class="px-4 py-2">{{ ++index }}</td>
            <td class="px-4 py-2" v-if="jobPost.title"> <Link class="text-blue-600 hover:underline" :href="route('admin.jobs.show', {slug:jobPost.slug})">{{jobPost.title }}</Link></td>
            <td class="px-4 py-2" v-else> --  </td>
            <td class="px-4 py-2" v-if="jobPost.user?.company_profile?.name"> <Link class="text-blue-600 hover:underline" :href="route('admin.company.show', {user:jobPost.user.id})">{{jobPost.user.company_profile.name}}</Link> </td>
            <td class="px-4 py-2" v-else> --  </td>
            <td class="px-4 py-2"> <JobPostStatus :status="jobPost.status" /> </td> 
            <td class="px-4 py-2"> {{ jobPost.job_type.job_type }} </td>
            <td class="px-4 py-2"> {{ jobPost.created_at_human }} </td>
            <td class="px-4 py-2"> {{ jobPost.job_applications_count }} </td>
            <!-- <td></td> -->
          </tr>
        </template>
      </Table>
      <pagination :pagination="jobPosts"  :baseUrl="route('admin.jobs.trashed')" />
       </div>
    </div>
  </template>
  
  <script>
  import Pagination from '@/Components/Pagination.vue';
  import Table from '@/Components/UI/Table.vue';
import JobPostStatus from '@/Components/JobPostStatus.vue';
import { useForm } from '@inertiajs/vue3';

  export default {
    name: 'AdminJobIndex',
    components: {Pagination, Table, JobPostStatus},
    mounted(){
      console.log(this.jobPosts);
      
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
    props: {
    jobPosts: Object,
    jobCategories: Array,
    jobTypes: Array,
    jobTypeParam: String,
    jobCategoryParam: String,
    titleParam: String,
  },
    
    methods: {
      // formatDate(date) {
      //   return new Date(date).toLocaleDateString();
      // },
      deleteJobpost(id){
          this.$inertia.delete(route('admin.jobs.delete', {jobPost: id}))        
      },
      filter(){
    this.form.get(route('admin.jobs.trashed'), {
      preserveState: true,
      preserveScroll: true,
      replace: true,
    });
  },
  clearFilter(){
    if(this.form.title != '' || this.form.job_type != '' || this.form.job_category != '' ){
      console.log('clear');
      
      this.$refs.fil.reset();
      this.$inertia.get(route('admin.jobs.trashed'));
    }
    
  }

      
  },
}
</script>
  