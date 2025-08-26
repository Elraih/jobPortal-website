<template>
  <div class="max-w-6xl mx-auto px-4 space-y-2">
  
      <!-- Header / Basic Info -->
      <div class="bg-white shadow rounded-lg p-6 flex flex-col sm:flex-row items-center sm:items-start justify-between gap-6">
        <div class="flex items-center gap-4">
          <img :src="user.user_profile?.avatar ? `/storage/${user.user_profile?.avatar}` : '/img/user_default.jpg'" alt="User Avatar"
               class="w-24 h-24 object-cover rounded-full border" />
          <div>
            <h1 class="text-2xl font-bold text-gray-800">{{user.user_profile.full_name}}</h1>
          
            <p class="text-gray-500 text-sm">{{user.location?.governorate?.name}}</p>
          </div>
        </div>
      </div>
  
      <!-- Main Content -->
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
  
        <!-- Left Column -->
        <div class="space-y-6 lg:col-span-1">
          <!-- Skills -->
          <div class="bg-white shadow rounded-lg p-6 group relative">
            <div class="flex justify-between  ">
              <h2 class="text-lg font-semibold text-gray-800 mb-3">Skills</h2>
           
            </div>
            <div class="flex flex-wrap gap-2">
              <span v-for="skill in user.skill?.skills" :id="skill.id" class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">{{ skill}}</span> 
              
            </div>
          </div>
  
          <!-- Contact Info -->
          <div class="bg-white shadow rounded-lg p-6 group relative">
            <div class="flex justify-between">
              <h2 class="text-lg font-semibold text-gray-800 mb-3">Contact</h2>
             
            </div>
            <ul class="text-sm text-gray-700 space-y-1">
              <li><strong>Email: </strong> {{ user.email }}</li>
              <li><strong>Phone: </strong> {{ user.contact_info?.phone }}</li>
              <li><strong>Website: </strong> {{ user.contact_info?.website }}</li>
              <li><strong>LinkedIn: </strong> {{ user.contact_info?.linkedIn }}</li>
            </ul>
          </div>
        </div>
  
        <!-- Right Column -->
        <div class="space-y-6 lg:col-span-2">
          <!-- About -->
          <div class="bg-white shadow rounded-lg p-6 group ">
            <div class="flex justify-between">
              <h2 class="text-lg font-semibold text-gray-800 mb-2">About Me</h2>
             
            </div>
            <p class="text-gray-700 leading-relaxed">
              {{ user.user_profile?.about_me }}
            </p>
          </div>
  
          <!-- Experience -->
          <div class="bg-white shadow rounded-lg p-6 group ">
            <div class="flex justify-between">
              <h2 class="text-lg font-semibold text-gray-800 mb-2">Experience</h2>
            
            </div>
            <ul v-if="user.experiences" class="space-y-4 text-gray-700">
              <li v-for="experience in user.experiences">
                <div class="flex justify-between">
                  <h3><span class="text-lg text-blue-800 font-bold">{{experience.job_title}}</span> at {{ experience.employeer }}</h3>
                  <p class="text-sm text-gray-500">{{new Date(experience.start_date).getFullYear()}} - {{new Date(experience.end_date).getFullYear()}}</p>
                </div>
                <p class="text-sm text-gray-500">{{experience.city}} - {{experience.country}}</p>
                <p class="mt-1">{{ experience.description }}</p>
              </li>
              
            </ul>
          </div>
  
          <!-- Education -->
          <div class="bg-white shadow rounded-lg p-6 group ">
            <div class="flex justify-between">
              <h2 class="text-lg font-semibold text-gray-800 mb-2">Education</h2>
             
            </div>
            <ul v-if="user.educations" class="text-gray-700 space-y-2">
              <li v-for="education in user.educations">
                <h3><span class="text-blue-800">{{ education.degree }}</span> in {{ education.major }}</h3>
               <div class="flex justify-between">
                 <p>{{ education.school_name }}</p>
                <p>{{ getFullYear(education.start_date) }} -- {{ getFullYear(education.completion_date) }}</p>
               </div>
              </li>
            </ul>
          </div>
  
         
        </div>
      </div>
    </div>
    <div class="max-w-4xl mx-auto py-10 px-4">
  
      <h2 class="text-xl font-semibold mb-2">Applications</h2>
      <div v-if="jobApplications.length <= 0" class="text-gray-500">No applications yet.</div>
  
      <Table v-else>
        <template v-slot:tableHead>
          <th class="px-4 py-2">#</th>
          <th class="px-4 py-2">Job Title</th>
          <th class="px-4 py-2">Company</th>
          <th class="px-4 py-2">status</th>
          <th class="px-4 py-2">Apply Date</th>
        </template>
        <template v-slot:tableBody>
          <tr v-for="jobApplication, index in jobApplications.data">
            <td class="px-4 py-2">{{ ++index }}</td>
            <td class="px-4 py-2"><Link class="text-blue-600 hover:underline" :href="route('admin.jobs.show', {slug: jobApplication.job_post.slug})">{{ jobApplication.job_post.title }}</Link><span v-if="jobApplication.job_post.deleted_at" class="text-red-300">(Deleted)</span></td>
            <td class="px-4 py-2"><Link class="text-blue-600 hover:underline" :href="route('admin.company.show', {user: jobApplication.job_post?.user_id})">{{ jobApplication.job_post.user?.company_profile?.name }}</Link></td>
            <td class="px-4 py-2"><jobApplicationStatus :status="jobApplication.status">{{ jobApplication.status }}</jobApplicationStatus></td>
            <td class="px-4 py-2">{{ jobApplication.created_at_human }}</td>
          </tr>
        </template>
      </Table>
      <Pagination :pagination="jobApplications" :baseUrl="route('admin.user.show', {user: user.id})"/>
    </div>
  </template>
  
  <script>
 import Table from '@/Components/UI/Table.vue';
import jobApplicationStatus from '@/Components/jobApplicationStatus.vue';
import Pagination from '@/Components/Pagination.vue';
  export default {
    components: {Table, jobApplicationStatus, Pagination},
    props: {
      user: Object,
      jobApplications: Object,
    },
    methods: {
      
    },
    mounted(){
      console.log(this.user);
      
    }
  }
  </script>
  