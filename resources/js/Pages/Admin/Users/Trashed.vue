<template>
   <div class="max-w-6xl mx-auto py-10 px-4">
      <h1 class="text-2xl font-bold mb-6">All jobSeekers</h1>
  

      <form ref="fil" @submit.prevent="filter" class="grid grid-cols-1 md:grid-cols-4 gap-2">
      <input type="text" v-model="form.jobSeekerName" id="companyName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Ex: Engineer" />
      <!-- <select v-model="form.job_category" name="job_category" id="" class="bg-gray-50 border border-gray-300">
        <option value="" >Select Category</option>
        <option v-for="jobCategory in jobCategories" :key="jobCategory.id" :value="jobCategory.id" >{{ jobCategory.name }}</option>
      </select> -->
      <!-- <select v-model="form.job_type" name="job_type" id="" class="bg-gray-50 border border-gray-300">
        <option value="" >Select Job Type</option>
        <option v-for="jobType in jobTypes" :key="jobType.id" :value="jobType.id" >{{ jobType.job_type }}</option>
      </select> -->

      <div>
        <button type="submit" class="bg-blue-500 text-white p-2 rounded-lg mx-2">Search</button>
        <button @click.prevent="clearFilter" class="bg-gray-500 text-white p-2 rounded-lg">Clear Filter</button>
      </div>
      </form>


      <div v-if="jobSeekers.data.length <=  0 " class="text-gray-500 text-center text-2xl">No jobSeekers found.</div>

      <div v-else>

      <Table>
        <template v-slot:tableHead>
          <th class="px-4 py-2">#</th>
          <th class="px-4 py-2"></th>
          <th class="px-4 py-2">Name</th>
          <th class="px-4 py-2">Email</th>
          <th class="px-4 py-2">Jobs Applied For</th>
          <th class="px-4 py-2">Created At</th>
          <!-- <th class="px-4 py-2">Action</th> -->
          
        </template>
        <template v-slot:tableBody>
          <tr v-for="jobSeeker, index in jobSeekers.data">
            <td class="px-4 py-2">{{ ++index }}</td>
            <td class="px-4 py-2"><img class="w-10 rounded-lg" :src="jobSeeker.user_profile.avatar ? `/storage/${jobSeeker.user_profile.avatar}` : '/img/user_default.jpg'" alt=""></td>
            <td class="px-4 py-2" v-if="jobSeeker.user_profile.full_name"> <Link class="text-blue-600 hover:underline" :href="route('admin.user.show', {user:jobSeeker.id})">{{jobSeeker.user_profile.full_name }}</Link><span v-if="jobSeeker.deleted_at" class="text-red-400">(Deleted)</span></td>
            <td class="px-4 py-2" v-else> --  </td>
            <td class="px-4 py-2"> {{ jobSeeker.email }} </td>
            <td class="px-4 py-2"> {{ jobSeeker.job_applications_count }} </td>
            <td class="px-4 py-2"> {{ jobSeeker.created_at_human }} </td>
            <!-- <td></td> -->
          </tr>
        </template>
      </Table>
      <pagination :pagination="jobSeekers"  :baseUrl="route('admin.user.index')" />
      </div>
    </div> 
</template>
  
<script>
  import Pagination from '@/Components/Pagination.vue';
  import Table from '@/Components/UI/Table.vue';
import { useForm } from '@inertiajs/vue3';

  export default {
    name: 'AdminJobIndex',
    components: {Pagination, Table},
    props: {
      jobSeekers: Object
    },
    data(){
      return {
        form:useForm({
          jobSeekerName: '',
        }),
      }
    },
    methods: {
      
      deleteJobseeker(id){
          this.$inertia.delete(route('admin.user.delete', {user: id}))        
      },
       filter(){
    this.form.get(route('admin.user.trashed'), {
      preserveState: true,
      preserveScroll: true,
      replace: true,
    });
  },
  clearFilter(){
    if(this.form.jobSeekerName != ''  ){
      console.log('clear');
      
      this.$refs.fil.reset();
      this.$inertia.get(route('admin.user.trashed'));
    }
    },
    },
    mounted(){
      console.log(this.jobSeekers.data);
    }
  }
  </script>
  