<template>
  <section class=" min-h-screen flex items-center">
    <div class="max-w-4xl w-full mx-auto px-4 py-8">

      <div class="text-white flex justify-between items-center pb-7">
        <!-- home page link  -->
        <Link :href="route('home')" class="text-xl font-bold">Logo</Link>

        <!-- link to register as jobseeker  -->
        <Link :href="route('registerAsJobSeeker')"
          class="border border-white px-4 py-2 rounded hover:bg-white hover:text-black transition">For Job Seekers
        </Link>
      </div>

      <div class="grid lg:grid-cols-2 gap-10">

        <!-- Register Form for Company -->
        <form @submit.prevent="submit()" class="bg-white p-6 rounded-lg shadow-lg w-full">
          <h2 class="text-2xl font-semibold text-blue-900 mb-4">Register Your Company</h2>

          <div class="space-y-4">

            <Input v-model="form.name" label="Company Name" name="name" :error="form.errors.name"/>

            <Input v-model="form.email" type="email" label="Company's Email" name="email" :error="form.errors.email" placeholder="contact@acme.com"/>
            
            <Input v-model="form.phone" type="tel" label="Phone Number" name="phone" :error="form.errors.phone" placeholder="+1234567890"/>
            
            <Input v-model="form.password" type="password" label="Password" name="password" :error="form.errors.password" placeholder="••••••••"/>

            <Input v-model="form.password_confirmation" type="password" label="Confirm Password" name="password_confirmation" :error="form.errors.password_confirmation" placeholder="••••••••"/>
            
          </div>

          <button type="submit"
            class="w-full mt-6 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 rounded-lg transition">Register
            Company</button>

          <!-- Links -->
          <div class="mt-6 text-sm text-center text-gray-600">
            Already have an account?
            <Link :href="route('login')" class="text-blue-600 hover:underline ml-1">Login</Link>
          </div>
        </form>

        <!-- From description -->
        <div class="text-white hidden md:block">
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
import AuthLayout from '@/Layouts/AuthLayout.vue'
import Input from '@/Components/UI/Input.vue'
import { route } from 'ziggy-js'

export default {
  layout: AuthLayout,
  components: {Input},
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