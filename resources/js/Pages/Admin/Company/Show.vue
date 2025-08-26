<template>
      <div class="max-w-6xl mx-auto">
    <div class="">
      <!-- Company Info header -->

        <div class="flex flex-col md:flex-row justify-between bg-gray-600 py-6 px-4 rounded-md text-white">
          <div class="order-2 md:order-1 my-3 mx-auto md:mx-0">
              <h1 class="text-3xl font-bold ">{{ company.company_profile?.name }}</h1>
            <ul class="text-center md:text-start space-y-2">
              <li><span class="text-md font-bold me-2">Industry:</span>{{company.company_profile?.industry}}</li>
              <li><span class="text-md font-bold me-2">Website:</span>{{ company.contact_info?.website }}</li>
              <li><span class="text-md font-bold me-2">LinkedIn:</span>{{ company.contact_info?.linkedIn }}</li> 
              <li><span class="text-md font-bold me-2">Location:</span>{{ company.location?.adress }}, {{ company.location?.governorate.name }}</li> 
              <li><span class="text-md font-bold me-2">Phone:</span>{{ company.contact_info?.phone }}</li> 
            </ul>
          </div>
          <div class="w-30 order-1 md:order-2 mx-auto md:mx-0">
            <img src="/public/img/company_default.png" class="w-30" alt=""></img>
          </div>
  
        </div>
      
        <div class="mt-2 px-3 py-5 rounded-md text-gray-700 bg-white whitespace-pre-line">
        <h3 class="text-lg font-bold">About Us</h3>
        <p v-if="company.company_profile?.about_us">{{ company.company_profile?.about_us }}</p>
      </div>
    </div>

    <!-- Job Listings -->
    <div class="my-4">
      <h2 class="text-2xl font-semibold my-5">Open Positions</h2>

      <div v-if="jobPosts.data.length <= 0" class="text-gray-500">This company hasn't posted any jobs yet.</div>

      <div v-else class="space-y-4">
        
        <Table>
          <template v-slot:tableHead>
            <th class="px-4 py-2">Job Title</th>
            <th class="px-4 py-2">Job Type</th>
            <th class="px-4 py-2">Governorate</th>
            <th class="px-4 py-2">Status</th>
            <th class="px-4 py-2">Number Of Applicants</th>
          </template>

          <template v-slot:tableBody>
           <tr v-for="job, index in jobPosts.data">
            <td class="px-4 py-2"><Link class="text-blue-600 hover:underline" :href="route('admin.jobs.show', {slug:job.slug})" >{{ job.title }}</Link></td>
            <td class="px-4 py-2">{{ job.job_type.job_type }}</td>
            <td class="px-4 py-2">{{ job.governorate.name }}</td>
            <td class="px-4 py-2"><JobPostStatus :status="job.status"/></td>
            <td class="px-4 py-2">{{ job.job_applications_count }}</td>
           </tr>
          </template>
        </Table>
                    
      </div>
      <Pagination :pagination="jobPosts" :baseUrl="route('admin.company.show', {user: company.id})" />

    </div> 
  </div>
  </template>
  
<script>
  import Pagination from '@/Components/Pagination.vue';
  import JobPostStatus from '@/Components/JobPostStatus.vue';
  import Table from '@/Components/UI/Table.vue';
  
  export default {
    components:{Pagination, JobPostStatus, Table},
    mounted(){

      console.log(this.company);
      
    },
    props: {
      company: Object,
      jobPosts: Object,
    },
    methods: {
      
    },
  }
  </script>
  