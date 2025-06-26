<template>
  <heroSection />


  <!-- latest jobs  -->
  <section class="py-16 bg-gray-100">
    <div class="max-w-7xl mx-auto px-4">
      <!-- Title + See All -->
      <div class="flex items-center justify-between mb-8">
        <h2 class="text-2xl font-bold text-gray-800">Jobs Today</h2>
        <Link v-if="todayJobs" href="/jobs" class="text-blue-600 hover:underline">See All Jobs</Link>
      </div>

      <!-- 4x4 Grid -->
      <div v-if="todayJobs" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div v-for="job in todayJobs" :key="job.id" class="bg-white rounded-lg shadow p-4 hover:shadow-md transition">
          <h3 class="text-lg font-semibold text-gray-900">{{ job.title }}</h3>
          <p class="text-sm text-gray-600">{{ job.company }}</p>
          <p class="text-xs text-gray-500 mt-2">{{ job.location }}</p>
          <Link :href="`/jobs/${job.id}`" class="inline-block mt-4 text-blue-600 hover:underline text-sm">
          View Job →
          </Link>
        </div>

      </div>
      <div v-else>no data</div>
    </div>
  </section>


  <!-- jobs by category  -->
  <section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4">

      <div class="flex items-center justify-between mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-8">Jobs by Category</h2>
        <Link v-if="categories" href="/jobs" class="text-blue-600 hover:underline">See All Jobs</Link>
      </div>

      <div v-if="categories" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        <div v-for="category in categories" :key="category.id"
          class="bg-blue-50 hover:bg-blue-100 p-6 rounded-lg shadow transition">
          <h3 class="text-lg font-semibold text-blue-800">{{ category.name }}</h3>
          <p class="text-sm text-blue-700">{{ category.count }} jobs available</p>
          <Link :href="`/jobs/category/${category.slug}`"
            class="inline-block mt-4 text-blue-600 hover:underline text-sm">
          Browse Jobs →
          </Link>
        </div>
      </div>
      <div v-else>
        <p>no data</p>
      </div>
    </div>
  </section>





  <Footer />

</template>


<script>

// import layout from '../Layouts/layout.vue';
import heroSection from '../Components/Hero/hero.vue';
// import Footer from '../Components/footer.vue';

export default {

  // layout : layout,
  components: {
    heroSection,
  },
  props: {
    users: Object,
    arr: String
  },


  setup() {



  },
  data() {
    return {

    }
  },

  methods: {



  },
  watch: {

  },


}
</script>