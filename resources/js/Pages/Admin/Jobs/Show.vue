<template>
  <div class="max-w-5xl mx-auto py-10 px-4 text-gray-800 bg-white">
    
    <!-- Job Title & Metadata -->
    <div class="mb-6">
      <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
        <div>
          <h1 class="text-3xl font-bold text-gray-900">{{ jobPost.title }}</h1>
          <ul class="flex flex-wrap gap-4 mt-2 text-sm text-gray-600">
            <li>{{ jobPost.job_category?.name }}</li>
            <li class="border-l pl-4">{{ jobPost.job_type?.job_type }}</li>
            <li class="border-l pl-4">{{ jobPost.governorate?.name }}</li>
          </ul>
        </div>
        <div>
          <JobPostStatus :status="jobPost.status"/>
            <div class="text-sm text-gray-400 mt-3 text-center">
              Posted on {{ formatDate(jobPost.created_at) }}
            </div>
          
        </div>
      </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8 text-sm">
      <div>
        <p class="text-gray-500 font-medium mb-1">Salary</p>
        <p class="text-gray-900 font-semibold">
          {{ jobPost.salary ? `$${jobPost.salary}` : 'Not specified' }}
        </p>
      </div>

      <div>
        <p class="text-gray-500 font-medium mb-1">Application Deadline</p>
        <p class="text-gray-900 font-semibold">
          {{ formatDate(jobPost.application_deadline) || 'N/A' }}
        </p>
      </div>

      <div>
        <p class="text-gray-500 font-medium mb-1">Applicants</p>
        <p class="text-blue-700 font-semibold">
          {{ jobPost.job_applications_count || 0 }} applied
        </p>
      </div>
    </div>

    <!-- Description -->
    <div class="mb-8">
      <h2 class="text-xl font-semibold mb-2">Job Description</h2>
      <div class="text-gray-700 leading-relaxed prose max-w-none" v-html="jobPost.description || '<p>No description provided.</p>'" />
    </div>

    <!-- Requirements -->
    <div class="mb-8">
      <h2 class="text-xl font-semibold mb-2">Requirements</h2>
      <p class="text-gray-700 whitespace-pre-line">
        {{ jobPost.requirements || 'Not specified.' }}
      </p>
    </div>

    <!-- Skills -->
    <div class="mb-8">
      <h2 class="text-xl font-semibold mb-2">Required Skills</h2>
      <p v-if="jobPost.skills.length <= 0" class="text-gray-400 text-sm">No skills listed.</p>
      <div v-else class="flex flex-wrap gap-2">
        <span
          v-for="(skill, index) in jobPost.skills"
          :key="index"
          class="bg-gray-100 hover:bg-gray-200 text-gray-800 text-xs px-3 py-1 rounded-full font-medium transition"
        >
          {{ skill }}
        </span>
      </div>
    </div>
    <p v-if="jobSeekres.data.length <= 0">No Applications For This Job Yet</p>

    <div v-else>

    <Table>
      <template v-slot:tableHead>
        <th class="px-4 py-2">#</th>
        <th class="px-4 py-2"></th>
        <th class="px-4 py-2">Name</th>
        <th class="px-4 py-2">Email</th>
        <th class="px-4 py-2">Status</th>
        <th class="px-4 py-2">Apply Date</th>
      </template>

      <template v-slot:tableBody>
        <tr v-for="jobSeekre, index in jobSeekres.data">
          <td class="px-4 py-2">{{ ++index }}</td>
          <td class="px-4 py-2"><img class="w-10 h-10 rounded-full" :src="jobSeekre.user?.user_profile?.avatar ? `/storage/${jobSeekre.user.user_profile.avatar}` : '/img/user_default.jpg'" alt=""></td>
          <td class="px-4 py-2"><Link class="text-blue-600 hover:underline" :href="route('admin.user.show', {user: jobSeekre.user_id})">{{ jobSeekre.user?.user_profile?.full_name}}</Link><span v-if="jobSeekre.user.deleted_at" class="text-red-400">(Deleted)</span></td>
          <td class="px-4 py-2">{{ jobSeekre.user?.email }}</td>
          <td class="px-4 py-2"><JobApplicationStatus :status="jobSeekre.status">{{ jobSeekre.status }}</JobApplicationStatus></td>
          <td class="px-4 py-2">{{ jobSeekre.created_at_human }}</td>
        </tr>
      </template>
    </Table>

    <Pagination :pagination="jobSeekres" :baseUrl="route('admin.jobs.show', {slug:jobPost.slug})" />
    </div>

  </div>
</template>

  
<script>
import Table from '@/Components/UI/Table.vue';
import JobApplicationStatus from '@/Components/JobApplicationStatus.vue';
import Pagination from '@/Components/Pagination.vue';
import JobPostStatus from '../../../Components/JobPostStatus.vue';
  export default {
    components: {Table, JobApplicationStatus, Pagination, JobPostStatus},
    name: 'JobShowAdmin',
    props: {
      jobPost: Object,
      jobSeekres: Object,
    },
    mounted(){
      console.log(this.jobSeekres.data);
      
    },
    methods: {
      formatDate(date) {
        return new Date(date).toLocaleDateString();
      },
    },
  };
  </script>
  