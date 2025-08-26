<template>
  <section class="max-w-7xl mx-auto px-4 py-6">
  
    <!-- =====  Search bar ===== -->
    <!-- <div> -->
      <form @submit.prevent="submitSearch" class="flex flex-col md:flex-row mb-10 gap-4 justify-center ">

        <Input v-model="form.keyword" placeholder="Job title, keywords..." name="keyword" :required="false"/>

        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
          Search
        </button>
      </form>
    <!-- </div> -->


    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

      <!-- //mobile sidbar filter  -->
      <div class="md:hidden">
        <!-- Toggle Button -->
        <div class="md:hidden p-4">
          <button @click="open = true" class="bg-blue-700 text-white p-2 cursor-pointer hover:bg-blue-800">Show Filter</button>
        </div>

        <!-- //mobile sidbar filter -->
        <div :class="[
          'fixed inset-0 z-40 bg-white md:static md:w-64 md:shadow-none md:p-0 md:rounded-none overflow-y-auto transition-transform duration-300',
          open ? 'translate-x-0' : '-translate-x-full',
          'md:translate-x-0 md:relative md:block'
        ]">

          <!-- toggle mobile filter  -->
          <div class="flex justify-between items-center p-4 border-b md:hidden">
            <h2 class="text-lg font-bold">Filters</h2>
            <button @click="open = false" class="text-gray-500 cursor-pointer hover:text-gray-700 text-xl">&times;</button>
          </div>

          <!-- Filter Body -->
          <aside class="p-4 space-y-4 md:space-y-6 overflow-y-auto h-[calc(100vh-150px)]">
            <h3 class="hidden md:block text-2xl">Filter Jobs</h3>

            <Dropdown label="Job Type">
              <label v-for="jobType in jobTypes" class="flex items-center gap-2 cursor-pointer">
                <input v-model="form.jobTypes" type="checkbox" class=" text-blue-600" :value="jobType.id"
                  name="job_type" />
                {{ jobType.job_type }}
              </label>
            </Dropdown>
            <Dropdown label="Job Category">
              <label v-for="jobCategory in jobCategories" class="flex items-center gap-2 cursor-pointer">
                <input v-model="form.jobCategories" @change="uncheck" type="checkbox" class=" text-blue-600"
                  :value="jobCategory.id" />
                {{ jobCategory.name }}
              </label>
            </Dropdown>
            <Dropdown label="Job Location">
              <label v-for="governorate in governorates" class="flex items-center gap-2 cursor-pointer">
                <input v-model="form.governorates" @change="uncheck" type="checkbox" class=" text-blue-600"
                  :value="governorate.id" />
                {{ governorate.name }}
              </label>
            </Dropdown>
          </aside>

          <!-- Mobile Footer Button -->
          <div class="md:hidden p-4 border-t">
            <button @click="applyFilters" class="bg-blue-700 text-white cursor-pointer p-2 rounded-lg hover:bg-blue-800 w-full">Show Jobs</button>
          </div>
        </div>
      </div>
      <!-- // end mobile sidbar filter  -->



      <!-- //desktop sidebar filter  -->
      <div class="hidden md:block bg-white rounded-lg ">

        <!-- Filter Body -->
        <aside class="p-4 pb-14 space-y-4 md:space-y-6 overflow-y-auto h-[calc(100vh-150px)]">
          <h3 class="hidden md:block text-2xl">Filter Jobs</h3>

          <Dropdown label="Job Type">
            <label v-for="jobType in jobTypes" class="flex items-center gap-2 cursor-pointer">
              <input @change="applyFiltersFromSidebar" v-model="form.jobTypes" type="checkbox"
                class="form-checkbox text-blue-600" :value="jobType.id" />
              {{ jobType.job_type }}
            </label>
          </Dropdown>
          <Dropdown label="Job Category">
            <label v-for="jobCategory in jobCategories" class="flex items-center gap-2 cursor-pointer">
              <input v-model="form.jobCategories" @change="uncheck" type="checkbox" class="form-checkbox text-blue-600"
                :value="jobCategory.id" />
              {{ jobCategory.name }}
            </label>
          </Dropdown>
          <Dropdown label="Job Location">
            <label v-for="governorate in governorates" class="flex items-center gap-2 cursor-pointer">
              <input v-model="form.governorates" @change="uncheck" type="checkbox" class="form-checkbox text-blue-600"
                :value="governorate.id" />
              {{ governorate.name }}
            </label>
          </Dropdown>
        </aside>
      </div>
      <!-- //end desktop sidebar filter  -->

      <!-- Job Posts card -->
      <div v-if="jobs.data.length > 0" class="md:col-span-3 ">
        <JobCard v-for="job in jobs.data" 
        :key="job.id" :titleLink="route('user.jobs.show', { slug: job.slug })"
          :title="job.title" 
          :company="job.user.company_profile.name"
          :companyLink="route('user.company.show', { user: job.user.id })" 
          :location="job.governorate.name"
          :category="job.job_category.name" 
          :skills="job.skills" 
          :type="job.job_type.job_type"
          :experience="job.experience" 
          :src="job.logo" :alt="job.company" 
          :posted_on="job.created_at_human" />

          <!-- pagination component  -->
        <Pagination :pagination="jobs"  :filters="form" :baseUrl="route('user.jobs.index')" />
      </div>

      <!-- just show if there's no job post  -->
      <div v-else>
        <p class="text-2xl text-center  ">No Jobs</p>
      </div>
    </div>
  </section>
</template>

<script>
import { useForm } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
import HeroSearch from '@/Components/Hero/HeroSearch.vue';
import FilterSidebar from '@/Components/FilterSidebar.vue';
import JobCard from '@/Components/JobCard.vue';
import Pagination from '@/Components/Pagination.vue';
import Dropdown from '@/Components/UI/Dropdown.vue';
import Input from '@/Components/UI/Input.vue';

export default {
  components: {
    HeroSearch,
    FilterSidebar,
    JobCard,
    Pagination,
    Dropdown,
    Input
  },
  props: {
    jobs: Object,
    jobTypes: Array,
    jobCategories: Array,
    governorates: Array,
    filters: Object,
    titleParam: String,
    jobTypesParam: Array,
    governoratesParam: Array,
    jobCategoriesParam: Array,
  },
  data() {
    return {
      // sidebar: this.$refs.sidebar,
      open: false,
      desktopScreen: true,
      form: useForm({
        keyword: this.titleParam || '',
        jobTypes: this.jobTypesParam || [],
        jobCategories: this.jobCategoriesParam || [],
        governorates: this.governoratesParam || [],
      }),
    };
  },
  mounted() {
    // console.log(this.jobTypesParam);

  },
  methods: {
    applyFiltersFromSidebar() {


      this.submitSearch();
    },

    updateKeyword(value) {
      this.form.keyword = value;
      this.submitSearch();
    },

    uncheck() {
      if (this.form.jobCategories.length > 5) {
        this.form.jobCategories.pop();
      }
      if (this.form.governorates.length > 5) {
        this.form.governorates.pop();
      }

    },
    applyFilters() {
      this.open = false;

      this.submitSearch();
    },

    submitSearch() {
      console.log(this.form);

      this.form.get(route('user.jobs.index'), {
        preserveState: true,
        preserveScroll: true,
        replace: true,
      });
    }
  },

  watch: {
    sidebar(oldv, newv) {
      console.log(oldv, newv);

    }
  },



}


</script>
