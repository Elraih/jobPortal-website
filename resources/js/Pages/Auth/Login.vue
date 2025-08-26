<template>
  <section class="min-h-screen max-w-md w-full mx-auto px-4 py-8">
    <!-- link to home page  -->
    <div class="text-white text-center mb-6">
      <Link :href="route('home')" class="text-2xl font-bold">JobSite</Link>
    </div>

    <!-- start login form  -->
    <form @submit.prevent="login()" class="bg-white p-6 rounded-lg shadow-lg">
      <h1 class="text-2xl font-semibold text-blue-900 mb-4 text-center">Login to Your Account</h1>

      <div class="space-y-4">
        <div>
          <Input v-model="form.email" :error="form.errors.email" label="Email Address" type="email" name="email"
            placeholder="you@example.com" />
        </div>
        <div>
          <Input v-model="form.password" :error="form.errors.password" label="Password" type="password" name="password"
            placeholder="••••••••" />
        </div>
      </div>

      <button type="submit"
        class="w-full mt-6 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 rounded-lg transition">Login</button>



      <!-- forget pwd , register jobseeker, employeer Link  -->
      <div class="mt-6 text-sm text-center text-gray-600 space-y-1">

        <Link :href="route('password.reset')" class="text-blue-600 hover:underline">Forgot your password?</Link>

        <p>
          Don’t have an account?
          <Link :href="route('registerAsJobSeeker')" class="text-blue-600 hover:underline ml-1">Register</Link>
        </p>

        <p>
          Are you a company?
          <Link :href="route('registerAsCompany')" class="text-blue-600 hover:underline ml-1">Register your
          company</Link>
        </p>

      </div>
      <!--end of forget pwd , register jobseeker, employeer Link  -->

    </form>
    <!-- end login form  -->

  </section>
</template>


<script>
import { useForm } from '@inertiajs/vue3'
import AuthLayout from '../../Layouts/AuthLayout.vue'
import { route } from 'ziggy-js'
import Input from '@/Components/UI/Input.vue'

export default {
  layout: AuthLayout,
  components: { Input },

  setup() {
    const form = useForm({
      email: '',
      password: ''
    })

    function login() {

      form.post(route('login'));
      form.password = '';

    }


    return { form, login }
  }
}
</script>