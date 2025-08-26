<template>
  <nav>
    <div class="max-w-screen-xl flex items-center justify-between mx-auto p-4">
      <!-- Logo -->
      <Link :href="route('home')" class="text-xl font-bold">Logo</Link>

      <!-- Hamburger and avatar (Mobile) -->
      <button @click="toggleNav" type="button"
        class="flex text-sm relative rounded-full focus:ring-4 items-center md:hidden focus:outline-none cursor-pointer ring-4 ring-blue-100 hover:ring-blue-300"
        aria-expanded="false" id="user-menu-button">
        <img :src="$page.props.auth.avatar ? `/storage/${$page.props.auth.avatar}` : '/img/user_default.jpg'"
          class="size-10 rounded-full  " alt="">
        <svg class="w-3 absolute bottom-0 -right-3" fill="none" stroke="currentColor" stroke-width="2"
          viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>
      <!-- end Hamburger and avatar (Mobile) -->


      <!-- Desktop Menu -->
      <ul class="hidden md:flex items-center gap-4 font-medium">
        <li>
          <Link :href="route('user.jobs.index')" class="hover:text-blue-400">Vacancies</Link>
        </li>
        <li v-if="authUser">
          <Link :href="route('user.profile.show', $page.props.auth.user)" class="hover:text-blue-400">Your Profile
          </Link>
        </li>
        <li v-if="authUser">
          <Link :href="route('user.job-applications.index')" class="hover:text-blue-400">Your Application</Link>
        </li>
        <li v-if="!authUser">
          <Link :href="route('login')" class="hover:text-blue-400">Login</Link>
        </li>
        <li v-if="!authUser">
          <Link :href="route('registerAsCompany')" class="hover:text-blue-400 px-2 py-1 border border-solid">Share A Job
          </Link>
        </li>
        <li v-if="!authUser">
          <Link :href="route('registerAsJobSeeker')" class="hover:text-blue-400 px-2 py-1 border border-solid">Looking
          For a Job</Link>
        </li>

        <!-- User Avatar Dropdown -->
        <div v-if="authUser" class="relative flex items-center space-x-3">
          <button @click="toggleAvatarList" type="button"
            class="flex text-sm bg-gray-800 rounded-full focus:ring-4 cursor-pointer focus:ring-gray-300"
            aria-expanded="false" id="user-menu-button">
            <img :src="$page.props.auth.avatar ? `/storage/${$page.props.auth.avatar}` : '/img/user_default.jpg'"
              class="size-10 rounded-full ring-4 ring-blue-100 hover:ring-blue-300 " alt="">
          </button>

          <!-- Dropdown -->
          <div v-show="showUserDropdown"
            class="absolute top-full right-0 mt-2 w-48 bg-white rounded-lg shadow divide-y divide-gray-100 z-50"
            id="user-dropdown">
            <!-- start of avatar dropdown list  -->
            <ul class="py-2 text-sm text-gray-700">
              <li class="px-4 py-3">
                <span class="block text-sm text-gray-900">Hello</span>
                <span class="block text-sm text-gray-500 truncate">{{ authUser.email }}</span>
              </li>
              <li>
                <Link :href="route('user.profile.show', $page.props.auth.user)"
                  class="block px-4 py-2 hover:bg-gray-100">profile</Link>
              </li>
              <li>
                <Link :href="route('user.profile.editInfo', $page.props.auth.user)"
                  class="block px-4 py-2 hover:bg-gray-100">Edit Info</Link>
              </li>
              <li>
                <Link :href="route('user.profile.editSkills', $page.props.auth.user)"
                  class="block px-4 py-2 hover:bg-gray-100">Edit Skills</Link>
              </li>
              <li>
                <Link :href="route('user.profile.editEducation', $page.props.auth.user)"
                  class="block px-4 py-2 hover:bg-gray-100">Edit Education</Link>
              </li>
              <li>
                <Link :href="route('user.profile.editExperience', $page.props.auth.user)"
                  class="block px-4 py-2 hover:bg-gray-100">Edit Experience</Link>
              </li>
              <li>
                <Link :href="route('user.account.edit', $page.props.auth.user)"
                  class="block px-4 py-2 hover:bg-gray-100">Account</Link>
              </li>

              <!-- logout button form  -->
              <li class="py-2 text-sm text-gray-700">
                <form @submit.prevent="logout">
                  <button type="submit"
                    class="block px-4 py-2 mx-auto outline-1 transition cursor-pointer text-red-400 hover:bg-red-700 hover:text-white">Sign
                    out</button>
                </form>
              </li>
              <!--end  logout button form  -->

            </ul>
            <!-- end of avatar dropdown list  -->
          </div>
        </div>
        <!--end User Avatar Dropdown -->
      </ul>
      <!--end Desktop Menu -->
    </div>

    <!-- Overlay for Mobile -->
    <div v-if="isActive" @click="toggleNav" class="fixed inset-0 bg-black/50 z-40 md:hidden"></div>
    <!--start Mobile Menu  navbar -->
    <div
      class="fixed top-0 right-0 w-64 h-full bg-white text-black z-50 transform transition-transform duration-300 ease-in-out md:hidden"
      :class="{ 'translate-x-0': isActive, 'translate-x-full': !isActive }">
      <!-- toggle mobile menue bottun -->
      <div class="p-4 flex justify-between items-center border-b">
        <span class="text-lg font-semibold">Menu</span>
        <button @click="toggleNav" class="text-gray-500 hover:text-gray-700">✕</button>
      </div>
      <!-- end toggle mobile menue bottun -->

      <!--  mobile menue list -->
      <ul class="flex flex-col gap-4 p-4 font-medium">
        <li v-if="authUser">
          <Link :href="route('user.profile.show', $page.props.auth.user)" class="hover:text-blue-400">Your Profile
          </Link>
        </li>
        <li v-if="authUser">
          <Link :href="route('user.job-applications.index')" class="hover:text-blue-400">Your Application</Link>
        </li>
        <li v-if="authUser">
          <Link :href="route('user.jobs.index')" class="hover:text-blue-400">Vacancies</Link>
        </li>
        <li v-if="authUser">
          <Link :href="route('user.profile.show', $page.props.auth.user)" class="block px-4 py-2 hover:bg-gray-100">
          profile</Link>
        </li>
        <li v-if="authUser">
          <Link :href="route('user.profile.editInfo', $page.props.auth.user)" class="block px-4 py-2 hover:bg-gray-100">
          Edit Info</Link>
        </li>
        <li v-if="authUser">
          <Link :href="route('user.profile.editSkills', $page.props.auth.user)"
            class="block px-4 py-2 hover:bg-gray-100">Edit Skills</Link>
        </li>
        <li v-if="authUser">
          <Link :href="route('user.profile.editEducation', $page.props.auth.user)"
            class="block px-4 py-2 hover:bg-gray-100">Edit Education</Link>
        </li>
        <li v-if="authUser">
          <Link :href="route('user.profile.editExperience', $page.props.auth.user)"
            class="block px-4 py-2 hover:bg-gray-100">Edit Experience</Link>
        </li>
        <li v-if="authUser">
          <Link :href="route('user.account.edit', $page.props.auth.user)" class="block px-4 py-2 hover:bg-gray-100">
          Account</Link>
        </li>

        <li v-if="authUser" class="py-2 text-sm text-gray-700">
          <form @submit.prevent="logout">
            <button type="submit" class="block px-4 py-2 w-full hover:bg-gray-100">Sign out</button>
          </form>
        </li>

        <li v-if="!authUser">
          <Link :href="route('login')" class="hover:text-blue-600">Login</Link>
        </li>
        <li v-if="!authUser">
          <Link :href="route('registerAsCompany')" class="hover:text-blue-600">Share A Job</Link>
        </li>
        <li v-if="!authUser">
          <Link :href="route('registerAsJobSeeker')" class="hover:text-blue-600">Looking For a Job</Link>
        </li>
      </ul>
      <!-- end mobile menue list -->
    </div>
    <!--end Mobile Menu  navbar -->

  </nav>
</template>

<script>
import { Link, router, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import { route } from 'ziggy-js';

export default {
  components: { Link },

  data() {
    return {
      isActive: false,
      showUserDropdown: false,
      isTransparent: false,
    };
  },

  methods: {
    // toggle mobile nav bar 
    toggleNav() {
      this.isActive = !this.isActive;
    },
    // toggle avatar dropdown list 
    toggleAvatarList() {
      this.showUserDropdown = !this.showUserDropdown;
    },
    // logout form 
    logout() {
      this.$inertia.post(route('logout'), {}, {
        replace: true,
      });

    }
  },
  setup() {
    const authUser = computed(() => usePage().props.auth.user);

    return { authUser }
  },

};
</script>
