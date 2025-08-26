<template>
  <div class="max-w-6xl mx-auto px-4 py-10 space-y-10">

    <!-- Header profile avatar  -->
    <div
      class="bg-white shadow rounded-lg p-6 flex flex-col sm:flex-row items-center sm:items-start justify-between gap-6">
      <div class="flex items-center gap-4">
        <img :src="user.user_profile?.avatar ? `/storage/${user.user_profile?.avatar}` : '/img/user_default.jpg'"
          alt="User Avatar" class="w-24 h-24 object-cover rounded-full border" />
        <div>
          <h1 class="text-2xl font-bold text-gray-800">{{ user.user_profile.full_name }}</h1>
        </div>
      </div>
      <Link :href="route('user.profile.editInfo', { user: user })"
        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition mt-4 sm:mt-0">
      Edit Profile
      </Link>
    </div>
    <!-- end  profile avatar  -->


    <!-- Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

      <!-- Left Column -->
      <div class="space-y-6 lg:col-span-1">
        <!-- Skills -->
        <div class="bg-white shadow rounded-lg p-6 group relative">
          <div class="flex justify-between  ">
            <h2 class="text-xl font-bold text-blue-900 mb-3">Skills</h2>
            <Link :href="route('user.profile.editSkills', { user: user })" class="hidden group-hover:block">Edit Skills
            </Link>
          </div>
          <div v-if="user.skill?.skills.length > 0" class="flex flex-wrap gap-2">
            <span v-for="skill in user.skill.skills" :id="skill.id"
              class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">{{ skill }}</span>
          </div>
          <!--end Skills -->
        </div>

        <!-- Contact Info -->
        <div class="bg-white shadow rounded-lg p-6 group relative">
          <div class="flex justify-between">
            <h2 class="text-xl font-bold text-blue-900 mb-3">Contact</h2>
          </div>
          <ul class="text-sm text-gray-700 space-y-1">
            <li><strong>location: </strong>{{ user.location?.address }}, {{ user.location?.governorate.name }}</li>
            <li><strong>Email: </strong> {{ user.email }}</li>
            <li><strong>Phone: </strong> {{ user.contact_info?.phone }}</li>
            <li><strong>Website: </strong> {{ user.contact_info?.website }}</li>
            <li><strong>LinkedIn: </strong> {{ user.contact_info?.linkedIn }}</li>
          </ul>
        </div>
        <!--end Contact Info -->
      </div>
      <!-- end left column -->


      <!-- Right Column -->
      <div class="space-y-6 lg:col-span-2">
        <!-- About me-->
        <div class="bg-white shadow rounded-lg p-6 group ">
          <div class="flex justify-between">
            <h2 class="text-xl font-bold text-blue-900 mb-3">About Me</h2>
          </div>
          <p class="text-gray-700 leading-relaxed">
            {{ user.user_profile.about_me }}
          </p>
        </div>
        <!-- end About me-->


        <!-- Experience -->
        <div class="bg-white shadow rounded-lg p-6 group ">
          <div class="flex justify-between">
            <h2 class="text-xl font-bold text-blue-900 mb-3">Experience</h2>
            <Link :href="route('user.profile.editExperience', { user: user })" class="hidden group-hover:block">Edit
            Experience</Link>
          </div>
          <ul v-if="user.experiences" class="space-y-4 text-gray-700">
            <li v-for="experience in user.experiences">
              <div class="flex justify-between">
                <h3><span class="text-lg text-blue-800 font-bold">{{ experience.job_title }}</span> at {{
                  experience.employeer }}</h3>
                <p class="text-sm text-gray-500">{{ new Date(experience.start_date).getFullYear() }} - {{ new
                  Date(experience.end_date).getFullYear()}}</p>
              </div>
              <p class="text-sm text-gray-500">{{ experience.city }} - {{ experience.country }}</p>
              <p class="mt-1">{{ experience.description }}</p>
            </li>

          </ul>
        </div>
        <!--end  Experience -->

        <!-- Education -->
        <div class="bg-white shadow rounded-lg p-6 group ">
          <div class="flex justify-between">
            <h2 class="text-xl font-bold text-blue-900 mb-3">Education</h2>
            <Link :href="route('user.profile.editEducation', { user: user })" class="hidden group-hover:block">Edit
            Education</Link>
          </div>
          <ul v-if="user.educations" class="text-gray-700 space-y-2">
            <li v-for="education in user.educations">
              <h3><span class="text-blue-800">{{ education.degree }}</span> in {{ education.major }}</h3>
              <div class="flex justify-between">
                <p>{{ education.school_name }}</p>
                <p>{{ getFullYear(education.start_date) }} -- {{ getFullYear(education.completion_date) }}</p>
              </div>
            </li>
          </ul>
        </div>
        <!--end Education -->

        <!-- Resume / Portfolio -->
        <div class="bg-white shadow rounded-lg p-6 group">
          <div class="flex justify-between">
            <h2 class="text-xl font-bold text-blue-900 mb-3">Portfolio / Resume</h2>
          </div>
          <a v-if="user.resume?.resume" href="/cv.pdf" target="_blank"
            class="inline-block bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded text-sm text-blue-700 border">
            Download Resume
          </a>
          <p v-else>No Resume Uploaded</p>
        </div>
        <!--end Resume / Portfolio -->

      </div>
      <!--end Right Column -->

    </div>
    <!--end Main Content -->

  </div>
</template>



<script>

export default {
  props: {
    user: Object,

  },

  mounted() {
    console.log(this.user);

  },
  methods: {
    getFullYear(date) {
      return new Date(date).getFullYear();
    }
  }



}
</script>