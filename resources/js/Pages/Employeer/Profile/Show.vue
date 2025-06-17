<template>
    <div class="grid grid-cols-3 px-4 py-10 space-y-10">
  
    <div class="col-span-3 lg:col-span-2">
      <!-- Header / Hero -->
      <div class="bg-red-100  shadow rounded-lg p-6 flex flex-col md:flex-row items-center md:items-start md:justify-between gap-6">
        <div class="flex items-center gap-4">
          <img src="" alt="Company Logo" class="w-20 h-20 object-contain rounded-lg border" />
          <div>
            <h1 class="text-2xl font-bold text-blue-800">XYZ Corporation</h1>
            <p class="text-gray-600 text-sm">Cairo, Egypt · Software Development</p>
            <a href="https://xyzcorp.com" target="_blank"
               class=" text-gray-800 transition ">Visit Website
            </a>
            <ul class="flex">
                <li><a href="">link</a></li>
                <li><a href="">link</a></li>
                <li><a href="">link</a></li>
            </ul>
          </div>
        </div>
        

      </div>
  
      <!-- About Section -->
      <section class="bg-white shadow rounded-lg p-6 space-y-3">
        <h2 class="text-xl font-semibold text-gray-800">About the Company</h2>
        

        <ul class="text-gray-700 space-y-1">
          <li><strong>Email:</strong> careers@xyzcorp.com</li>
          <li><strong>Phone:</strong> +20 100 123 4567</li>
          <li><strong>Address:</strong> Smart Village, Giza, Egypt</li>
        </ul>

        <p class="text-gray-700 leading-relaxed">
          XYZ Corporation is a global leader in customer service software and AI solutions.
          With offices across 3 continents, XYZ serves over 5 million users and 2,000+ companies.
        </p>
      </section>
  
      <!-- Benefits / Perks -->
      <section class="bg-white shadow rounded-lg p-6 space-y-3">
        <h2 class="text-xl font-semibold text-gray-800">Benefits</h2>
        <ul class="list-disc pl-6 text-gray-700 space-y-1">
          <li>Flexible working hours</li>
          <li>Remote work options</li>
          <li>Annual performance bonuses</li>
          <li>Medical & social insurance</li>
        </ul>
      </section>
  

  
        <!-- Open Jobs -->
        <section class="bg-white shadow rounded-lg p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Open Jobs</h2>
        <div class="grid grid-cols-1   gap-4">
          <div class="border p-4 rounded-lg hover:shadow transition">
            <h3 class="font-semibold text-blue-700 text-lg">Customer Support Agent</h3>
            <p class="text-sm text-gray-600">Full-time · Cairo, Egypt</p>
          </div>
          <div class="border p-4 rounded-lg hover:shadow transition">
            <h3 class="font-semibold text-blue-700 text-lg">Frontend Developer (Vue)</h3>
            <p class="text-sm text-gray-600">Remote · Full-time</p>
          </div>
          <div class="border p-4 rounded-lg hover:shadow transition">
            <h3 class="font-semibold text-blue-700 text-lg">Product Manager</h3>
            <p class="text-sm text-gray-600">Hybrid · Alexandria</p>
          </div>
        </div>
      </section>
    </div>

    </div>
</template>
  


<script>
import Layout from '../../../Layouts/layout.vue';

export default{

    layout: Layout
    
}
</script>