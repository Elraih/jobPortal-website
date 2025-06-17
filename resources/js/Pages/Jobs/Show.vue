<template>
  <!-- Page Container -->
  <div class="max-w-6xl mx-auto px-4 py-8 flex flex-col lg:flex-row gap-8">

    <!-- Main Job Content -->
    <div class="flex-1 flex flex-col space-y-8 order-1">

      <!-- Job Header -->
      <div class="bg-white shadow rounded-lg p-6 border border-gray-200">
        <h1 class="text-3xl font-bold text-blue-800">Job Title</h1>
        <p class="text-gray-600 mt-1">Company Name</p>
        <div class="flex flex-wrap gap-2 mt-4 text-sm text-gray-500">
          <span class="bg-gray-100 px-2 py-1 rounded">Full Time</span>
          <span>Remote</span>
          <span>Senior</span>
        </div>

        <!-- Desktop Button -->
        <button class="mt-6 bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition ">
          Apply Now
        </button>
      </div>

      <!-- Job Details -->
      <div class="bg-white shadow rounded-lg p-6 border border-gray-200 space-y-4">
        <h2 class="text-xl font-semibold text-gray-800">Job Details</h2>
        <ul class="text-gray-700 space-y-1">
          <li><strong>Experience Needed:</strong> 0 to 5 years</li>
          <li><strong>Career Level:</strong> Entry Level</li>
          <li><strong>Education Level:</strong> High School</li>
          <li><strong>Salary:</strong> 13,500–18,000 EGP + Bonus</li>
          <li><strong>Categories:</strong> Customer Support</li>
        </ul>
      </div>

      <!-- Skills -->
      <div class="bg-white shadow rounded-lg p-6 border border-gray-200">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Skills & Tools</h2>
        <div class="flex flex-wrap gap-2">
          <span v-for="tag in ['Communication', 'CRM Tools', 'Typing']" :key="tag"
                class="bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full">
            {{ tag }}
          </span>
        </div>
      </div>

      <!-- Job Description -->
      <div class="bg-white shadow rounded-lg p-6 border border-gray-200">
        <h2 class="text-xl font-semibold text-gray-800 mb-2">Job Description</h2>
        <p class="text-gray-700 leading-relaxed whitespace-pre-line">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla et euismod nulla. Curabitur feugiat, tortor non consequat finibus.
        </p>
      </div>

      <!-- Requirements + Mobile Button -->
      <div class="bg-white shadow rounded-lg p-6 border border-gray-200">
        <h2 class="text-xl font-semibold text-gray-800 mb-2">Requirements</h2>
        <ul class="list-disc pl-6 space-y-2 text-gray-700">
          <li>Strong communication skills</li>
          <li>Work under pressure</li>
          <li>Team player</li>
        </ul>

      </div>
      <!-- Mobile Button -->
      <div>
        <button class="mt-6 w-full bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition lg:hidden">
        Apply Now
      </button>
      </div>

      <!-- About Company: mobile order before similar jobs -->
      <div class="bg-white shadow rounded-lg p-6 border border-gray-200 lg:hidden">
        <h2 class="text-xl font-semibold text-gray-800 mb-2">About the Company</h2>
        <p class="text-gray-600 text-sm leading-relaxed">
          XYZ Corp is a leading service provider in customer support, operating globally with clients across 20 countries.
        </p>
      </div>

      <!-- Similar Jobs -->
      <div>
        <h2 class="text-xl font-semibold text-gray-800 mt-10 mb-4">Similar Jobs</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div class="bg-white shadow rounded-lg p-4 border">
            <h3 class="font-semibold text-blue-700">Support Agent</h3>
            <p class="text-gray-500 text-sm">XYZ Corp</p>
          </div>
          <div class="bg-white shadow rounded-lg p-4 border">
            <h3 class="font-semibold text-blue-700">Customer Care</h3>
            <p class="text-gray-500 text-sm">ABC Inc</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Sidebar: About Company on large screens -->
    <aside class="w-full lg:w-1/3 order-2 hidden lg:block h-fit bg-white shadow rounded-lg p-6 border border-gray-200">
      <h2 class="text-xl font-semibold text-gray-800 mb-2">About the Company</h2>
      <p class="text-gray-600 text-sm leading-relaxed">
        XYZ Corp is a leading service provider in customer support, operating globally with clients across 20 countries.
      </p>
    </aside>
  </div>
</template>


  
<script>

import layout from '@/Layouts/layout.vue';

export default {
    layout : layout
    

  };
</script>
  