<template>

  <!-- Hero section  -->
  <heroSection />

  <!-- Job Posts todays show latest 15  -->
  <section class="py-16 bg-gray-100">
    <div class="max-w-7xl mx-auto px-4">
      <!-- Header and Link See All -->
      <div class="flex items-center justify-between mb-8">
        <h2 class="text-2xl font-bold text-gray-800">Jobs Today</h2>
        <Link v-if="todayJobs" :href="route('user.jobs.index')" class="text-blue-600 hover:underline">See All Jobs
        </Link>
      </div>

      <!-- 4x4 Grid Job Posts Card -->
      <div v-if="todayJobs.length <= 0">no data</div>
      <div v-else class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <JobCard v-for="job in todayJobs" :key="job.id" :titleLink="route('user.jobs.show', { slug: job.slug })"
          :title="job.title" :companyLink="route('user.company.show', { user: job.user })"
          :posted_on="job.created_at_human" :company="job.user.company_profile.name" :location="job.governorate.name"
          :category="job.job_category.name" :skills="job.skills" :type="job.job_type.job_type"
          :experience="job.experience" :src="job.logo" :alt="job.company" />
      </div>
    </div>
  </section>


  <!-- jobs by category  -->
  <section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4">
      <!-- Header and Link see Jobs by Category  -->
      <div class="flex items-center justify-between mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-8">Jobs by Category</h2>
        <Link v-if="jobByCategories" :href="route('user.jobs.index')" class="text-blue-600 hover:underline">See All Jobs
        </Link>
      </div>

      <!-- Jobs by Category  -->
      <div v-if="jobByCategories" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div v-for="category in jobByCategories" :key="category.id"
          class="bg-blue-50 hover:bg-blue-100 p-6 rounded-lg shadow transition">
          <h3 class="text-lg font-semibold text-blue-800">{{ category.name }}</h3>
          <p class="text-sm text-blue-700">{{ category.count }} jobs available</p>
          <Link :href="route('user.jobs.index', { jobCategories: [category.id] })"
            class="inline-block mt-4 text-blue-600 hover:underline text-sm">
          Browse Jobs →
          </Link>
        </div>
      </div>
      <!-- if no Category  -->
      <div v-else>
        <p>no data</p>
      </div>
    </div>
  </section>


</template>


<script>
import { route } from 'ziggy-js';
import heroSection from '../Components/Hero/Hero.vue';
import JobCard from '../Components/JobCard.vue';


export default {

  components: {
    heroSection, JobCard
  },

  props: {
    users: Object,
    arr: String,
    todayJobs: Array,
    jobByCategories: Array,
  },
}
</script>