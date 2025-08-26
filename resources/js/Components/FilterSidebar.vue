<template>
  <div class="">
    <!-- Toggle Button -->
    <div class="md:hidden p-4">
      <button @click="open = true" class="btn-primary w-full">Filter Jobs</button>
    </div>

    
    <!-- Filter Panel -->
    <div :class="[
      'fixed inset-0 z-40 bg-white md:static md:w-64 md:shadow-none md:p-0 md:rounded-none overflow-y-auto transition-transform duration-300',
      open ? 'translate-x-0' : '-translate-x-full',
      'md:translate-x-0 md:relative md:block'
    ]">
      <!-- Header -->
      <div class="flex justify-between items-center p-4 border-b md:hidden">
        <h2 class="text-lg font-bold">Filters</h2>
        <button @click="open = false" class="text-gray-500 hover:text-gray-700 text-xl">&times;</button>
      </div>

      <!-- Filter Body -->
      <aside class="p-4 space-y-4 md:space-y-6 overflow-y-auto h-[calc(100vh-150px)]">
    <h3 class="hidden md:block text-2xl">Filter Jobs</h3>

        <Dropdown label="Job Type">
          hvgfcgfcghc
          <!-- <CheckBox v-for="jobType in jobTypes" @filter-change="onFilterChange" :filterKey="'jobTypes'" :key="jobType.id" :label="jobType.job_type" :value="jobType.id" /> -->
        </Dropdown>
        <Dropdown label="Job Category">
          <!-- <CheckBox v-for="jobCategory in jobCategories" @filter-change="onFilterChange" :filterKey="'jobCategories'"  :key="jobCategory.id" :label="jobCategory.name" :value="jobCategory.id"  /> -->
        </Dropdown>
        <Dropdown label="Job Location">
          <!-- <CheckBox v-for="governorate in governorates" @filter-change="onFilterChange" :filterKey="'governorates'"  :key="governorate.id" :label="governorate.name" :value="governorate.id"  /> -->
        </Dropdown>
      </aside>

      <!-- Mobile Footer Button -->
      <div class="md:hidden p-4 border-t">
        <button @click="applyFilters" class="btn-primary w-full">Show Jobs</button>
      </div>
    </div>
  </div>
</template>

<script>

import Dropdown from '@/Components/UI/Dropdown.vue';
import CheckBox from '@/Components/UI/CheckBox.vue';
export default {
  components: {
    Dropdown, CheckBox,
  },
  props:{
    jobCategories: Array,
    jobTypes: Array,
    governorates: Array,
  },

  data() {
    return {

      open: false,
      filter: {
        jobCategories: [],
        jobTypes: [],
        governorates: [],
      },
      filters: Array,
    };
  },
  methods: {
    
    onFilterChange({event, value, checked, key}) {
      
    if (!Array.isArray(this.filters[key])) {
      this.filters[key] = [];
    }

    if (checked) {
      if (!this.filters[key].includes(value)) {
        this.filters[key].push(value);
      }
    } else {
      this.filters[key] = this.filters[key].filter(v => v !== value);
    }

    this.$emit('update-filters', { key, values: this.filters[key] });
  },
    applyFilters(){
      
      this.$emit('mobile-filter', { key, values: this.filters[key] })
    }
  },
  // watch:{
  //   'filters.governorates'(){
  //     return filters.governorates
  //   }
  // }
};
</script>
