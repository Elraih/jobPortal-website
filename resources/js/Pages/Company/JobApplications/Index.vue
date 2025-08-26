<template>
  <div class="max-w-5xl mx-auto py-10 px-4">
    <h1 class="text-2xl font-bold mb-6">
      Applications for: <span class="text-indigo-700">{{ jobPost.title }}</span>
    </h1>
     
     <form ref="fil" @submit.prevent="filter" class="grid grid-cols-1 md:grid-cols-4 gap-2">
      <input type="text" v-model="form.name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Ex: Engineer" />
      <select v-model="form.status" name="status" id="" class="bg-gray-50 border border-gray-300">
        <option value="" >Select Status</option>
        <option v-for="status in jobApplicationStatus" :key="status.id" :value="status.id" >{{ status.name }}</option>
      </select>

      <div>
        <button type="submit" class="bg-blue-500 text-white p-2 rounded-lg mx-2">Search</button>
        <button @click.prevent="clearFilter" class="bg-gray-500 text-white p-2 rounded-lg">Clear Filter</button>
      </div>
      </form>

    <div  class=" my-10">
    <p v-if="applications.data.length <= 0">No applications yet.</p>
    <div v-else>
      
    <Table>
      <template v-slot:tableHead>
          <th class="px-4 py-2">#</th>
          <th class="px-4 py-2">name</th>
          <th class="px-4 py-2">applied on</th>
          <th class="px-4 py-2">Resume</th>
          <th class="px-4 py-2">status</th>
          <th class="px-4 py-2">Action</th>
        
      </template>

      <template v-slot:tableBody >
         <tr v-for="application, index in applications.data" >
          <td class="px-4 py-2">{{ ++index }}</td>
          <td class="px-4 py-2">{{ application.user.user_profile.first_name + ' ' + application.user.user_profile.last_name}}</td>
          <td class="px-4 py-2">{{application.created_at_human}}</td>
          <td class="px-4 py-2">
            <button v-if="application.resume_path" @click="downloadResume(application.id)" class="bg-blue-400 cursor-pointer text-white py-1 px-2 rounded-md">Download Resume</button>
            <p v-else>---</p>
          </td>
          <td class="px-4 py-2"><JobApplicationStatus :status="application.status"></JobApplicationStatus></td>
          <td class="px-4 py-2">
              <button @click="reviewApplication(application.user_id, application.id)" class="mx-1 cursor-pointer bg-blue-300 text-white py-1 px-2 rounded-md">Review</button>
              <button @click="inConsiderApplication" v-if="application.status != 'in consideration'" class="mx-1 cursor-pointer bg-green-300 text-white py-1 px-2 rounded-md">in consider</button>
              <button @click="rejectApplication" v-if="application.status != 'rejected'" class="mx-1 cursor-pointer bg-yellow-300 text-white py-1 px-2 rounded-md">reject</button>    
          </td>
         </tr>
         
      </template>
    </Table>
      <!-- end of jobseeker card  -->
      <Pagination :pagination="applications" :baseUrl="route('company.job-applications.index', {jobPost: jobPost})" />
  
    </div>
  </div>
  </div>
</template>

<script>
import Pagination from '@/Components/Pagination.vue';
import Table from '@/Components/UI/Table.vue';
import JobApplicationStatus from '@/Components/JobApplicationStatus.vue';
import { route } from 'ziggy-js';
import Index from '../../Admin/Jobs/Index.vue';
import { useForm } from '@inertiajs/vue3';


export default {
  components: {Pagination, Table, JobApplicationStatus},
  props: {
    applications: Object,
    jobPost: Object,
    jobApplicationStatus: Array,
  },
  mounted(){
    // console.log(this.applications.data[0].status);
    
  },
  data(){
    return{
      form:useForm({
      status: this.statusParam || '',
      name: this.nameParam || '',

    }), 
    };
  },
  methods: {
    formatDate(date) {
      return new Date(date).toLocaleDateString();
    },
    downloadResume(id){
      window.open(route('company.job-applications.downloadResume', id), '__blank');
    },
    filter(){
    this.form.get(route('company.job-applications.index', {jobPost: this.jobPost}), {
      preserveState: true,
      preserveScroll: true,
      replace: true,
    });
  },
  clearFilter(){
    
    if(this.form.name != '' || this.form.status != '' ){
      console.log('clear');
      
      this.$refs.fil.reset();
      this.$inertia.get(route('company.job-applications.index', {jobPost: this.jobPost.id}));
    } 
  }, 
  reviewApplication(user_id, application_id){
    window.open(route('company.user.show',{user: user_id}), {blank:true});

    this.$inertia.patch(route('company.job-applications.reviewApplication',{jobApplication: application_id}),
  {
    preserveScroll: true,
  });
  },
  inConsiderApplication(){

  },
  rejectApplication(){

  }
  },
}
</script>