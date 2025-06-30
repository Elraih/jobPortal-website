<template>
  <div>
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
        <Dropdown label="Job Type">
          <CheckBox label="Job Type" :options="jobTypes" v-model="filters.jobTypes" label-key="type" value-key="id" />
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

  data() {
    return {

      open: false,
      filters: {
        jobTypes: [],
      },
    };
  },
  methods: {
    applyFilters() {
      this.open = false;
      console.log("Applied Filters:", this.filters);
      // send to backend or Inertia, etc.
    },
  },
};
</script>
