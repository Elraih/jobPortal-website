<template>
  <div class="flex justify-between items-center pt-4 text-sm">
    <!-- Prev/First -->
    <div class="flex gap-2">
      <Link
        v-if="pagination.current_page > 1"
        :href="pagination.first_page_url || `${baseUrl}?page=1`"
        class="px-3 py-1 border rounded hover:bg-gray-100"
      >
        First
      </Link>
      <Link
        v-if="pagination.prev_page_url"
        :href="pagination.prev_page_url"
        class="px-3 py-1 border rounded hover:bg-gray-100"
      >
        Prev
      </Link>
    </div>

    <!-- Page Info -->
    <div>
      Page <strong>{{ pagination.current_page }}</strong> of <strong>{{ pagination.last_page }}</strong>
    </div>

    <!-- Next/Last -->
    <div class="flex gap-2">
      <Link
        v-if="pagination.next_page_url"
        :href="pagination.next_page_url"
        class="px-3 py-1 border rounded hover:bg-gray-100"
      >
        Next
      </Link>
      <Link
        v-if="pagination.current_page < pagination.last_page"
        :href="pagination.last_page_url ||`${baseUrl}?page=${pagination.last_page}`"
        class="px-3 py-1 border rounded hover:bg-gray-100"
      >
        Last
      </Link>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
  pagination: {
    type: Object,
    required: true,
  },
  baseUrl: {
    type: String,
    default: '', // optional if you want to pass route manually
  },
});
</script>
