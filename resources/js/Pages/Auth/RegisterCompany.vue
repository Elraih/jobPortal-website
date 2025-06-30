<template>
  <section class=" min-h-screen flex items-center">
    <div class="max-w-4xl w-full mx-auto px-4 py-8">

      <!-- Header -->
      <div class="text-white flex justify-between items-center pb-7">
        <Link :href="route('home')" class="text-xl font-bold">Logo</Link>
        <Link :href="route('auth.registerAsJobSeeker')"
          class="border border-white px-4 py-2 rounded hover:bg-white hover:text-black transition">For Job Seekers
        </Link>
      </div>

      <div class="grid lg:grid-cols-2 gap-10">

        <!-- Form -->
        <form @submit.prevent="submit()" class="bg-white p-6 rounded-lg shadow-lg w-full">
          <h2 class="text-2xl font-semibold text-gray-800 mb-4">Register Your Company</h2>

          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Company Name</label>
              <input type="text" placeholder="Acme Corp" v-model="form.name"
                class="w-full p-2.5 border rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
              <input type="email" placeholder="contact@acme.com" v-model="form.email"
                class="w-full p-2.5 border rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
              <input type="tel" placeholder="+1234567890" v-model="form.phone"
                class="w-full p-2.5 border rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
              <input type="password" placeholder="••••••••" v-model="form.password"
                class="w-full p-2.5 border rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
              <input type="password" placeholder="••••••••" v-model="form.password_confirmation"
                class="w-full p-2.5 border rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>
          </div>

          <button type="submit"
            class="w-full mt-6 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 rounded-lg transition">Register
            Company</button>

          <!-- Links -->
          <div class="mt-6 text-sm text-center text-gray-600">
            Already have an account?
            <Link :href="route('auth.login')" class="text-blue-600 hover:underline ml-1">Login</Link>
          </div>
        </form>

        <!-- Info Panel -->
        <div class="text-white md:hidden lg:block">
          <h2 class="text-3xl font-bold mb-4">Post Jobs, Hire Talent</h2>
          <p class="mb-2">Join hundreds of companies finding top talent.</p>
          <p class="mb-2">Manage applications, post openings, and more.</p>
        </div>
      </div>
    </div>
  </section>
</template>


<script>
import { useForm } from '@inertiajs/vue3'
import AuthLayout from '../../Layouts/AuthLayout.vue'
import { route } from 'ziggy-js'

export default {
  layout: AuthLayout,

  data() {
    return {
      backgroundImage: '/img/company.jpg',
    }
  },
  setup() {
    const form = useForm({
      name: '',
      email: '',
      phone: '',
      password: '',
      password_confirmation: '',
      type: 'company'
    })

    const submit = () => {
      form.post('/auth/register-as-company')
    }

    return { form, submit }
  }
}
</script>