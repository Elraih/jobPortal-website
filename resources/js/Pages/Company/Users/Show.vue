<template>
    <div class="max-w-6xl mx-auto px-4 py-10 space-y-10">
  
      <!-- Header / Basic Info -->
      <div class="bg-white shadow rounded-lg p-6 flex flex-col sm:flex-row items-center sm:items-start justify-between gap-6">
        <div class="flex items-center gap-4">
          <img src="" alt="User Avatar"
               class="w-24 h-24 object-cover rounded-full border" />
          <div>
            <h1 class="text-2xl font-bold text-gray-800">{{user.user_profile.full_name}}</h1>
            <p class="text-gray-600 text-sm">Frontend Developer</p>
            <p class="text-gray-500 text-sm">Cairo, Egypt {{ user.location?.governorate?.name }}</p>
          </div>
        </div>
      </div>
  
      <!-- Main Content -->
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
  
        <!-- Left Column -->
        <div class="space-y-6 lg:col-span-1">
          <!-- Skills -->
          <div class="bg-white shadow rounded-lg p-6 group relative">
            <div class="flex justify-between  ">
              <h2 class="text-lg font-semibold text-gray-800 mb-3">Skills</h2>
            
            </div>
            <ul class="flex flex-wrap gap-2">
                <li v-for="skill in user.skills" class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm"></li>
              <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">Vue.js</span>
              <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">Tailwind CSS</span>
              <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">Laravel</span>
              <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">Inertia.js</span>
            </ul>
          </div>
  
          <!-- Contact Info -->
          <div class="bg-white shadow rounded-lg p-6 group relative">
            <div class="flex justify-between">
              <h2 class="text-lg font-semibold text-gray-800 mb-3">Contact</h2>
            </div>
            <ul class="text-sm text-gray-700 space-y-1">
              <li><strong>Email:</strong> {{user.email}}</li>
              <li><strong>Phone:</strong> +20 100 123 4567</li>
              <li><strong>Website:</strong> www.ahmedali.dev</li>
              <li><strong>LinkedIn:</strong> linkedin.com/in/ahmedali</li>
            </ul>
          </div>
        </div>
  
        <!-- Right Column -->
        <div class="space-y-6 lg:col-span-2">
          <!-- About -->
          <div class="bg-white shadow rounded-lg p-6 group ">
            <div class="flex justify-between">
              <h2 class="text-lg font-semibold text-gray-800 mb-2">About Me</h2>
            </div>
            <p class="text-gray-700 leading-relaxed">
              Passionate frontend developer with 4+ years experience in building fast, accessible and user-friendly web apps.
              I enjoy working with Vue, Laravel, and exploring modern UI/UX techniques.
            </p>
          </div>
  
          <!-- Experience -->
          <div class="bg-white shadow rounded-lg p-6 group ">
            <div class="flex justify-between">
              <h2 class="text-lg font-semibold text-gray-800 mb-2">Experience</h2>
           
            </div>
            <ul class="space-y-4 text-gray-700">
              <li>
                <strong class="text-blue-800">Frontend Developer</strong> at XYZ Software
                <div class="text-sm text-gray-500">2021 - Present</div>
                <p class="mt-1">Built and maintained Vue.js applications, integrated with REST APIs, and worked closely with designers and backend team.</p>
              </li>
              <li>
                <strong class="text-blue-800">Intern Developer</strong> at ABC Agency
                <div class="text-sm text-gray-500">2020 - 2021</div>
                <p class="mt-1">Assisted with bug fixes and small features in Laravel-based projects.</p>
              </li>
            </ul>
          </div>
  
          <!-- Education -->
          <div class="bg-white shadow rounded-lg p-6 group ">
            <div class="flex justify-between">
              <h2 class="text-lg font-semibold text-gray-800 mb-2">Education</h2>
              
            </div>
            <ul class="text-gray-700 space-y-2">
              <li>
                <strong class="text-blue-800">B.Sc. in Computer Science</strong><br />
                Cairo University — 2016–2020
              </li>
            </ul>
          </div>
  
          <!-- Resume / Portfolio -->
          <div class="bg-white shadow rounded-lg p-6 group">
            <div class="flex justify-between">
              <h2 class="text-lg font-semibold text-gray-800 mb-2">Portfolio / Resume</h2>
            
            </div>
            <a href="/cv.pdf" target="_blank"
               class="inline-block bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded text-sm text-blue-700 border">
              Download Resume
            </a>
          </div>
        </div>
      </div>
    </div>
</template>

<script>
export default {
    mounted(){
        console.log(this.user);
        
    },
    props: {
        user: Object,
    },
    methods: {
        formatDate(date) {
            return new Date(date).toLocaleDateString()
        },
    },
}
</script>



  


