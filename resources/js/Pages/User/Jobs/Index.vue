<template>
    <section class="max-w-7xl mx-auto px-4 py-6">
        <!-- Top: Search bar -->
        <hero-search :textColor="'text-black'"></hero-search>

        <!-- Main layout -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

            <!-- Sidebar filters -->
            <!-- <filter-sidebar :jobTypes="jobTypes" /> -->

            <!-- Job Listings -->
            <div class="md:col-span-3 space-y-6">

                <JobCard v-for="job in jobs" :key="job.id" :href="route('user.jobs.show', 4)" :title="job.title"
                    :company="job.company" :type="job.type" :experience="job.experience" :mode="job.mode"
                    :src="job.logo" :alt="job.company" />
            </div>
        </div>
    </section>
</template>

<script>
import FilterSidebar from '@/Components/filterSidebar.vue';
import JobCard from '@/Components/JobCard.vue';
import layout from '@/Layouts/layout.vue';
import HeroSearch from '@/Components/Hero/HeroSearch.vue';
import { route } from 'ziggy-js';

export default {

    components: {
        FilterSidebar, JobCard, HeroSearch,
    },
    layout: layout,

    props: {
        jobs: Array,
    },
    data() {
        return {
            search: '',
            showFilter: false,


        };
    },
    computed: {
        isDesktop() {
            return window.innerWidth >= 768;
        },

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