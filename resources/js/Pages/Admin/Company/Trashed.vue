<template>
    <div class="max-w-6xl mx-auto py-10 px-4">
      <h1 class="text-2xl font-bold mb-6">All Companies</h1>
  
      <form ref="fil" @submit.prevent="filter" class="grid grid-cols-1 md:grid-cols-4 gap-2">
      <input type="text" v-model="form.companyName" id="companyName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Ex: Engineer" />
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

      <div v-if="companies.data.length <=  0 " class="text-gray-500 text-center text-2xl">No companies found.</div>

      <div v-else>
      <Table >
        <template v-slot:tableHead>
          <th class="px-4 py-2">#</th>
          <th class="px-4 py-2">Company Name</th>
          <th class="px-4 py-2">Email</th>
          <th class="px-4 py-2">Posted Jobs</th>
          <!-- <th class="px-4 py-2">Action</th> -->
          
        </template>
        <template v-slot:tableBody>
          <tr v-for="company, index in companies.data">
            <td class="px-4 py-2">{{ ++index }}</td>
            <td class="px-4 py-2" v-if="company.company_profile?.name"> <Link class="text-blue-600 hover:underline" :href="route('admin.company.show', {user:company.id})">{{company.company_profile?.name }}</Link> </td>
            <td class="px-4 py-2" v-else> --  </td>
            <td class="px-4 py-2"> {{ company.email }} </td>
            <td class="px-4 py-2"> {{company.job_posts_count}} </td>
            <!-- <td class="px-4 py-2"></td> -->
          </tr>
        </template>
      </Table>
      <pagination :pagination="companies"  :baseUrl="route('admin.company.index')" />
      </div>
    </div>
  </template>
  
  <script>

  import Table from '@/Components/UI/Table.vue';
  import Pagination from '@/Components/Pagination.vue';
import { useForm } from '@inertiajs/vue3';
  export default {
    components: {Table, Pagination},
    props: {
      companies: Object,
    },
    data(){
        return{
            form:useForm({
                companyName: ''
            }),
        }
    },
    methods: {
      formatDate(date) {
        return new Date(date).toLocaleDateString()
      },
      deleteCompany(id){
          this.$inertia.delete(route('admin.company.delete', {user: id}))        
      },
      filter(){
    this.form.get(route('admin.company.trashed'), {
      preserveState: true,
      preserveScroll: true,
      replace: true,
    });
  },
  clearFilter(){
    if(this.form.companyName != ''  ){
      console.log('clear');
      
      this.$refs.fil.reset();
      this.$inertia.get(route('admin.company.trashed'));
    }
    
  },
    },

  }
  </script>
  