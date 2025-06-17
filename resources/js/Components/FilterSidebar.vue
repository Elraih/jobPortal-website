<template>
  <div>
    <!-- Toggle Button (only on small screens) -->
    <div class="md:hidden p-4">
      <button @click="open = true" class="btn-primary w-full">Filter Jobs</button>
    </div>

    <!-- Filter Panel -->
    <div
      :class="[
        'fixed inset-0 z-40 bg-white md:static md:w-64 md:shadow-none md:p-0 md:rounded-none overflow-y-auto transition-transform duration-300',
        open ? 'translate-x-0' : '-translate-x-full',
        'md:translate-x-0 md:relative md:block'
      ]"
    >
      <!-- Header (Mobile only) -->
      <div class="flex justify-between items-center p-4 border-b md:hidden">
        <h2 class="text-lg font-bold">Filters</h2>
        <button @click="open = false" class="text-gray-500 hover:text-gray-700 text-xl">&times;</button>
      </div>

      <!-- Filter Body -->
      <aside class="p-4 space-y-4 md:space-y-6">
        <Dropdown label="Workplace">
          <a href="#" class="filter-item">Remote</a>
          <a href="#" class="filter-item">Hybrid</a>
          <a href="#" class="filter-item">Onsite</a>
        </Dropdown>

        <Dropdown label="Country">
          <a href="#" class="filter-item">Egypt</a>
          <a href="#" class="filter-item">KSA</a>
          <a href="#" class="filter-item">UAE</a>
        </Dropdown>

        <Dropdown label="Job Type">
          <a href="#" class="filter-item">Full Time</a>
          <a href="#" class="filter-item">Part Time</a>
          <a href="#" class="filter-item">Internship</a>
        </Dropdown>
      </aside>

      <!-- Show Jobs Button (Mobile only) -->
      <div class="md:hidden p-4 border-t">
        <button @click="applyFilters" class="btn-primary w-full">Show Jobs</button>
      </div>
    </div>
  </div>
</template>

<script>
import Dropdown from '@/Components/UI/Dropdown.vue';

export default {
  components: { Dropdown },
  data() {
    return {
      open: false,
    };
  },
  methods: {
    applyFilters() {
      // Handle filtering logic
      this.open = false;
      console.log("Filters applied");
    },
  },
};
</script>


