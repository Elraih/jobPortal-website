<template>
  <div class="max-w-6xl mx-auto">
    <div class="">
      <!-- Company Info header  and logo-->
      <div class="flex flex-col md:flex-row justify-between bg-gray-600 py-6 px-4 rounded-md text-white">
        <div class="order-2 md:order-1 my-3 mx-auto md:mx-0">
          <h1 class="text-3xl font-bold ">{{ company.company_profile?.name }}</h1>
          <ul class="text-center md:text-start space-y-2">
            <li><span class="text-md font-bold me-2">Industry:</span>{{ company.company_profile?.industry }}</li>
            <li><span class="text-md font-bold me-2">Website:</span>{{ company.contact_info?.website }}</li>
            <li><span class="text-md font-bold me-2">LinkedIn:</span>{{ company.contact_info?.linkedIn }}</li>
            <li><span class="text-md font-bold me-2">Location:</span>{{ company.location?.address }}, {{
              company.location?.governorate?.name }}</li>
            <li><span class="text-md font-bold me-2">Phone:</span>{{ company.contact_info?.phone }}</li>
          </ul>
        </div>
        <div class="w-30 order-1 md:order-2 mx-auto md:mx-0">
          <img
            :src="company.company_profile?.logo ? `/storage/${company.company_profile?.logo}` : '/img/company_default.png'"
            class="w-30" alt=""></img>
        </div>

      </div>
      <!--end Company Info header  and logo-->


      <div class="mt-2 px-3 py-5 rounded-md text-gray-700 bg-white whitespace-pre-line">
        <h3 class="text-lg text-blue-900 font-bold">About Us</h3>
        <p v-if="company.company_profile?.about_us">{{ company.company_profile?.about_us }}</p>
      </div>
    </div>


    <!-- Job posts list -->
    <div class="my-4">
      <h2 class="text-xl text-blue-900 font-bold mt-5 mb-1 bg-blue-50 p-3">Open Positions</h2>

      <div v-if="jobPosts.data <= 0" class="text-gray-500">This company hasn't posted any jobs yet.</div>

      <div v-else class="space-y-4">

        <!-- job card  -->
        <JobCard v-for="job in jobPosts.data" :key="job.id" :titleLink="route('user.jobs.show', { slug: job.slug })"
          :title="job.title" :location="job.governorate.name" :company="company.company_profile.name"
          :posted_on="job.created_at_human" :category="job.job_category.name" :skills="job.skills"
          :type="job.job_type.job_type"
          :src="company.company_profile?.logo ? `/storage/${company.company_profile?.logo}` : '/img/company_default.png'"
          :alt="'job.company'" />
        <!-- end job card      -->

      </div>
      <Pagination :pagination="jobPosts" :baseUrl="route('user.company.show', { user: company.id })" />

    </div>
    <!--end Job posts list -->

  </div>
</template>

<script>
import JobCard from '@/Components/JobCard.vue';
import Pagination from '@/Components/Pagination.vue';


export default {
  components: { JobCard, Pagination },
  props: {
    company: Object,
    jobPosts: Object
  },
}
</script>
