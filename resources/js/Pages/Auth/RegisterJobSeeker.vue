<template>
  <section class="min-h-screen flex items-center">
    <div class="max-w-5xl w-full mx-auto px-4 py-8">

      <!-- Header -->
      <div class="text-white flex justify-between items-center pb-7">

        <!-- home page link  -->
        <Link :href="route('home')" class="text-xl font-bold">Logo</Link>

        <!-- register as company link  -->
        <Link :href="route('registerAsCompany')"
          class="border border-white px-4 py-2 rounded hover:bg-white hover:text-black transition">For Companies</Link>
      </div>


      <div class="grid lg:grid-cols-2 gap-10">
        <!-- Registration Form -->
        <form @submit.prevent="submit()" class="bg-white p-6 rounded-lg shadow-lg">
          <h2 class="text-2xl font-semibold text-gray-800 mb-4">Create an Account</h2>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            
            <Input v-model="form.first_name" name="first_name" label="First Name" :error="form.errors.first_name" placeholder="First Name" />
            
            <Input v-model="form.last_name" name="last_name" label="Last Name" :error="form.errors.last_name" placeholder="Last Name" />
          </div>

          <Input v-model="form.email" :error="form.errors.email" type="email" label="Email Address" name="email" placeholder="john.doe@example.com" />
          
          <Input v-model="form.phone" :error="form.errors.phone" type="tel" label="Phone Number" name="phone" placeholder="+201222244444" />
          
          <Input v-model="form.password" :error="form.errors.password" type="password" label="Password" name="password" placeholder="••••••••" />
          
          <Input v-model="form.confirm_password" :error="form.errors.confirm_password" type="password" label="Confirm Password" name="confirm_password" placeholder="••••••••" />

          <button type="submit"
            class="w-full mt-6 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 rounded-lg transition">
            Register
          </button>

          <!-- Extra Links -->
          <div class="mt-6 text-sm text-center text-gray-600 space-y-2">
            <p>
              Already have an account?
              <Link :href="route('login')" class="text-blue-600 hover:underline ml-1">Login</Link>
            </p>
            <p>
              Are you a company?
              <Link :href="route('registerAsCompany')" class="text-blue-600 hover:underline ml-1">Register as a
              company</Link>
            </p>

          </div>
        </form>

        <!-- form description -->
        <div class="text-white hidden lg:block">
          <h2 class="text-3xl font-bold mb-4">Welcome to JobSite</h2>
          <p class="mb-2">Find thousands of jobs from companies across the country.</p>
          <p class="mb-2">Easily apply with your profile and get hired faster.</p>
          <p class="mb-2">We support both job seekers and employers.</p>
        </div>

      </div>
    </div>
  </section>
</template>




<script>
import { useForm } from '@inertiajs/vue3'
import AuthLayout from '../../Layouts/AuthLayout.vue'
import Input from '@/Components/UI/Input.vue';
import { route } from 'ziggy-js';


export default {
  layout: AuthLayout,
  components:{Input, },
  data() {
    return{

     form:useForm({
        first_name: '',
        last_name: '',
        password: '',
        email: '',
        phone: '',
        password_confirmation: '',
        type: 'jobseeker'
      })
      }
    },
    methods:{
      submit(){
        this.form.post(route('storeAsJobSeeker'));
      }
    },

}
</script>