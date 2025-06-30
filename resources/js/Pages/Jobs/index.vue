<template>
  <section class="max-w-7xl mx-auto px-4 py-6">
    <!-- Top: Search bar -->
    <hero-search :textColor="'text-black'"></hero-search>

    <!-- Main layout -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

      <!-- Sidebar filters -->
      <filter-sidebar />

      <!-- Job Listings -->
      <div class="md:col-span-3 space-y-6">
        <!-- <div v-for="job in filteredJobs" :key="job.id" class="bg-white shadow rounded-lg p-5 flex items-start justify-between">
            <div>
              <h3 class="text-xl font-bold text-blue-700">{{ job.title }}</h3>
              <p class="text-sm text-gray-600">{{ job.company }} - {{ job.location }}</p>
              <div class="text-sm mt-2 flex flex-wrap gap-2">
                <span class="bg-gray-100 px-2 py-1 rounded">Experience: {{ job.experience }}</span>
                <span class="bg-gray-100 px-2 py-1 rounded">{{ job.type }}</span>
                <span class="bg-gray-100 px-2 py-1 rounded">{{ job.mode }}</span>
              </div>
            </div>
            <img :src="job.logo" alt="Logo" class="w-16 h-16 object-contain" />
          </div> -->

        <JobCard v-for="job in jobs" :key="job.id" :title="job.title" :company="job.company" :type="job.type"
          :experience="job.experience" :mode="job.mode" :src="job.logo" :alt="job.company" />
      </div>
    </div>
  </section>
</template>

<script>
import FilterSidebar from '@/Components/filterSidebar.vue';
import JobCard from '@/Components/JobCard.vue';
import layout from '@/Layouts/layout.vue';
import HeroSearch from '@/Components/Hero/HeroSearch.vue';
export default {

  components: {
    FilterSidebar, JobCard, HeroSearch,
  },
  layout: layout,
  data() {
    return {
      search: '',
      showFilter: false,
      filters: {
        location: [
          { label: 'Cairo', value: 'Cairo' },
          { label: 'Alexandria', value: 'Alexandria' }
        ],
        level: [
          { label: 'Entry', value: 'Entry' },
          { label: 'Senior', value: 'Senior' }
        ],
        type: [
          { label: 'Full Time', value: 'Full Time' },
          { label: 'Part Time', value: 'Part Time' }
        ]
      },
      selectedFilters: {
        location: [],
        level: [],
        type: []
      },
      jobs: [
        {
          id: 1,
          title: 'Software Tester (QA Engineer)',
          company: 'LoadServ',
          location: 'Cairo, Egypt',
          experience: '2-4 Yrs',
          type: 'Full Time',
          mode: 'On-site',
          logo: '/img/company1.png'
        },
        {
          id: 2,
          title: 'Printing Engineer',
          company: 'Diamond Alliance Services',
          location: 'Kano, Nigeria',
          experience: '5+ Yrs',
          type: 'Full Time',
          mode: 'On-site',
          logo: '/img/company2.png'
        }
      ]
    };
  },
  computed: {
    isDesktop() {
      return window.innerWidth >= 768;
    },
    filteredJobs() {
      return this.jobs.filter(job => {
        const matchSearch = job.title.toLowerCase().includes(this.search.toLowerCase());
        const matchLocation = !this.selectedFilters.location.length || this.selectedFilters.location.includes(job.location);
        const matchLevel = !this.selectedFilters.level.length || this.selectedFilters.level.includes(job.experience.split(' ')[0]);
        const matchType = !this.selectedFilters.type.length || this.selectedFilters.type.includes(job.type);
        return matchSearch && matchLocation && matchLevel && matchType;
      });
    }
  },
  methods: {
    searchJobs() {
      // Placeholder if using backend
      console.log('Searching:', this.search);
    },
    toggleMobileFilter() {
      this.showFilter = !this.showFilter;
    }
  }
};
</script>








<!-- <script>
import layout from '../../Layouts/layout.vue';
export default {


    layout : layout,
  name: 'AllJobs',
  data() {
    return {
      searchQuery: '',
      selectedCategories: [],
      selectedLocation: '',
      categories: ['Engineering', 'Design', 'Marketing', 'Sales'],
      locations: ['Remote', 'New York', 'Berlin', 'Dubai'],
      jobs: [
        {
          id: 1,
          title: 'Frontend Developer',
          company: 'TechSoft',
          location: 'Remote',
          type: 'Full Time',
          description: 'Work with Vue and Tailwind on cool UI projects.',
          category: 'Engineering',
          logo: '/img/logos/techsoft.png'
        },
        {
          id: 2,
          title: 'UX Designer',
          company: 'DesignPro',
          location: 'Berlin',
          type: 'Part Time',
          description: 'Create user-friendly designs for mobile apps.',
          category: 'Design',
          logo: '/img/logos/designpro.png'
        },
        // Add more jobs as needed...
      ]
    };
  },
  computed: {
    filteredJobs() {
      return this.jobs.filter(job => {
        const matchesSearch = job.title.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                              job.company.toLowerCase().includes(this.searchQuery.toLowerCase());

        const matchesCategory = this.selectedCategories.length === 0 || this.selectedCategories.includes(job.category);
        const matchesLocation = !this.selectedLocation || job.location === this.selectedLocation;

        return matchesSearch && matchesCategory && matchesLocation;
      });
    }
  }
};
</script> -->
