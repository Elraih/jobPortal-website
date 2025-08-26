<template>
  <div class="grid grid-cols-2 md:grid-cols-4 gap-7 max-w-7xl mx-auto">

    <!-- job post page start  -->
    <div class="col-span-3 py-10 px-4">
      <!-- show if user application status for this job  -->
      <div v-if="hasApplied" class="bg-green-200 p-5 mb-5 rounded-md text-green-400 text-center">
        <p class="text-xl font-bold">You Already Applied For This Job</p>
        <p v-if="status == 'pending'">Your Application has not been seen yet</p>
        <p v-if="status == 'reviewed'">Your Application has been reviewed</p>
        <p v-if="status == 'in consideration'">Your Application is in consideration</p>
        <p v-if="status == 'rejected'">Your Application is rejected by the company</p>
      </div>
      <!-- end show if user application status for this job  -->

      <!-- job post title and  header -->
      <div class="flex flex-col md:flex-row justify-between bg-gray-600 py-6 px-4 rounded-md text-white">
        <div class="order-2 md:order-1 my-3 mx-auto md:mx-0">
          <h1 class="text-3xl font-bold ">{{ jobPost.title }}</h1>
          <ul class="text-center md:text-start my-6">
            <li><span class="text-md font-bold my-2">Company Name: </span> {{ jobPost.user.company_profile.name }}</li>
            <li class="text-md  my-2"><span class="text-md font-bold my-2">Job Location: </span>
              {{ jobPost.governorate.name }}
            </li>
            <li class="text-md  my-2"> <span class="text-md font-bold my-2">Job Shared:</span>
              {{ jobPost.created_at_human }}
            </li>
          </ul>
        </div>
        <div class="order-1 md:order-2 mx-auto md:mx-0">
          <job-status :job-status="jobPost.status" />
          <img class="w-30 my-5"
            :src="jobPost.user.company_profile?.logo ? `/storage/${jobPost.user.company_profile?.logo}` : '/img/company_default.png'"
            alt="">
        </div>
      </div>
      <!-- end job post title and  header -->


      <!-- job post apply button applicaiton infos start  -->
      <div class="my-5 grid grid-cols-1 md:grid-cols-4 gap-4 p-3 bg-white rounded-lg">

        <button v-if="jobPost.status === 'open' && !hasApplied" @click="applyForJob"
          class="bg-blue-400 col-span-1 text-white rounded-lg ">Apply</button>
        <ul class="flex justify-around col-span-3">
          <li class="text-center">applied <p>{{ jobPost.job_applications_count }}</p>
          </li>
          <li class="text-center">viewed <p>{{ reviewedCount }}</p>
          </li>
          <li class="text-center">in consideration <p>{{ inConsiderationCount }}</p>
          </li>
          <li class="text-center">rejected <p>{{ rejectedCount }}</p>
          </li>
        </ul>
      </div>
      <!-- end job post apply button applicaiton infos start  -->


      <!-- job post details  -->
      <div class="my-5 p-3 bg-white rounded-lg">
        <h3 class="text-xl font-bold text-blue-900">Job Details</h3>
        <ul>
          <li class="my-2 text-gray-500">Experience Needed: <span class="text-black"></span></li>
          <li class="my-2 text-gray-500">Career Level: <span class="text-black"></span></li>
          <li class="my-2 text-gray-500">Education Level: <span class="text-black"></span></li>
          <li class="my-2 text-gray-500">Salary: <span class="text-black">{{ jobPost.salary }}</span></li>
          <li class="my-2 text-gray-500">Job Categories: <span class="text-black">{{ jobPost.job_category.name }}</span>
          </li>
        </ul>
        <div class="my-6 mx-5 p-2 bg-gray-200 border border-gray-300 rounded-lg">
          <h4 class="">Skills And Tools</h4>
          <ul class="flex gap-2 p-5">
            <li v-for="skill in jobPost.skills" class="bg-blue-400 text-white px-2 py-1 rounded-lg s">{{ skill }}</li>
          </ul>
        </div>
      </div>
      <!--end  job post details  -->

      <!-- job post requirments  -->
      <div class="my-5 p-3 bg-white rounded-lg">
        <h3 class="text-xl font-bold text-blue-900">Requirements</h3>
        <p>{{ jobPost.requirements }}</p>
      </div>
      <!--end job post requirments  -->

      <!-- job post description  -->
      <div class="my-5 p-3 bg-white rounded-lg">
        <h3 class="text-xl font-bold text-blue-900">Description</h3>
        <p>{{ jobPost.description }}</p>
      </div>
      <!--end  job post description  -->
    </div>
    <!-- end job post page start  -->

    <!-- related jobs based list  -->
    <div class="mt-10 p-3 bg-white rounded-lg self-start ">
      <h2 class="text-xl text-blue-900 font-bold">related jobs</h2>
      <p v-if="similarJobs.length <= 0">No Related Jobs</p>
      <ul v-else>
        <li v-for="similarJob in similarJobs" :key="similarJob.id" class="py-3  border-b border-slate-500  ">
          <Link :href="route('user.jobs.show', { slug: similarJob.slug })"
            class="block mt-4 text-blue-600 hover:underline text-sm">
          {{ similarJob.title }}
          </Link>
          <div class="flex justify-between">
            <div>
              <p>{{ similarJob.user.company_profile.name }}</p>
              <p class="text-gray-500 text-sm">{{ similarJob.created_at_human }}</p>
            </div>
            <img class="w-15 "
              :src="similarJob.user.company_profile?.logo ? `/storage/${similarJob.user.company_profile.logo}` : '/img/company_default.png'"
              alt="">
          </div>


        </li>
      </ul>


    </div>
    <!--end related jobs based list  -->
  </div>

</template>

<script>
import { Link, router } from '@inertiajs/vue3';
import JobStatus from '@/Components/UI/JobStatus.vue';
import JobApplicationStatus from '@/Components/JobApplicationStatus.vue';
import JobPostStatus from '@/Components/JobPostStatus.vue';
import { route } from 'ziggy-js';

export default {

  components: { Link, JobStatus, JobApplicationStatus, JobPostStatus },

  mounted() {
    console.log(this.jobPost);

  },
  props: {
    jobPost: Object,
    similarJobs: Object,
    pendingCount: Number,
    reviewedCount: Number,
    inConsiderationCount: Number,
    rejectedCount: Number,
    hasApplied: Boolean,
    status: String
  },
  methods: {
    applyForJob() {
      this.$inertia.post(route('user.jobs.apply', { jobPost: this.jobPost.id }));

    }

  }
}
</script>