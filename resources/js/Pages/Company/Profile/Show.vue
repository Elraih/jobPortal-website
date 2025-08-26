<template>
  <div class="max-w-6xl mx-auto">
    <!-- company contnet info  -->
    <div class="">
      <!-- Company Info header and logo -->
      <div class="flex flex-col md:flex-row justify-between bg-gray-600 py-6 px-4 rounded-md text-white">

        <div class="order-2 md:order-1 my-3 mx-auto md:mx-0">
          <h1 class="text-3xl font-bold ">{{ user.company_profile?.name }}</h1>
          <ul class="text-center md:text-start space-y-2">
            <li><span class="text-md font-bold me-2">Industry:</span>{{ user.company_profile?.industry }}</li>
            <li><span class="text-md font-bold me-2">Website:</span>{{ user.contact_info?.website }}</li>
            <li><span class="text-md font-bold me-2">LinkedIn:</span>{{ user.contact_info?.linkedIn }}</li>
            <li><span class="text-md font-bold me-2">Location:</span>{{ user.location?.address }}, {{
              user.location?.governorate?.name }}</li>
            <li><span class="text-md font-bold me-2">Phone:</span>{{ user.contact_info?.phone }}</li>
          </ul>
        </div>
        <div class="w-30 order-1 md:order-2 mx-auto md:mx-0">
          <Link class="bg-yellow-600 block mb-4 text-center text-white p-2 rounded-lg"
            :href="route('company.profile.edit', { user: $page.props.auth.company.id })">Edit Profile</Link>
          <img :src="user.company_profile?.logo ? `/storage/${user.company_profile?.logo}` : '/img/company_default.png'"
            class="w-30" alt=""></img>
        </div>

      </div>
      <!--end Company Info header and logo -->

      <!-- Company about -->
      <div class="mt-2 px-3 py-5 rounded-md text-gray-700 bg-white whitespace-pre-line">
        <h3 class="text-lg font-bold">About Us</h3>
        <p v-if="user.company_profile?.about_us">{{ user.company_profile?.about_us }}</p>
      </div>
      <!-- Company about  -->
    </div>
    <!--end company contnet info  -->


    <!-- company's Jobposts Listings -->
    <div class="my-4">
      <h2 class="text-2xl font-semibold my-5">Open Positions</h2>

      <div v-if="user.p" class="text-gray-500">This company hasn't posted any jobs yet.</div>

      <div v-else class="space-y-4">

        <!-- job posts card  -->
        <JobCard v-for="job in jobPosts.data" :key="job.id" :titleLink="route('company.jobs.show', { slug: job.slug })"
          :title="job.title" :location="job.governorate.name" :mode="job.status" :posted_on="job.created_at_human"
          :category="job.job_category.name" :skills="job.skills" :type="job.job_type.job_type"
          :logo="user.company_profile?.logo ? `/storage/${user.company_profile?.logo}` : '/img/company_default.png'"
          :alt="'job.company'" />
        <!-- end job posts cards     -->

      </div>
      <Pagination :pagination="jobPosts" :baseUrl="route('company.profile.show', { user: user.id })" />

    </div>
    <!--end  company's Jobposts Listings -->

  </div>
</template>

<script>
import { Link } from '@inertiajs/vue3';
import JobCard from '@/Components/JobCard.vue';
import Pagination from '@/Components/Pagination.vue';


export default {
  components: { JobCard, Pagination },
  props: {
    user: Object,
    jobPosts: Object
  },
}
</script>
