<template>
  <section class="min-h-screen flex items-center">
    <div class="max-w-5xl w-full mx-auto px-4 py-8">
      
      <!-- Header -->
      <div class="text-white flex justify-between items-center pb-7">
        <Link class="text-xl font-bold">Logo</Link>
        <Link class="border border-white px-4 py-2 rounded hover:bg-white hover:text-black transition">For Companies</Link>
      </div>

      <!-- Split Section -->
      <div class="grid lg:grid-cols-2 gap-10">
        
        <!-- Registration Form -->
        <form class="bg-white p-6 rounded-lg shadow-lg">
          <h2 class="text-2xl font-semibold text-gray-800 mb-4">Create an Account</h2>
          
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">First name</label>
              <input type="text" id="first_name" placeholder="John"
                class="w-full p-2.5 rounded-lg border border-gray-300 text-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>
            <div>
              <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Last name</label>
              <input type="text" id="last_name" placeholder="Doe"
                class="w-full p-2.5 rounded-lg border border-gray-300 text-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>
          </div>

          <div class="mt-4">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email address</label>
            <input type="email" id="email" placeholder="john.doe@example.com"
              class="w-full p-2.5 rounded-lg border border-gray-300 text-sm focus:ring-blue-500 focus:border-blue-500" required>
          </div>

          <div class="mt-4">
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <input type="password" id="password" placeholder="••••••••"
              class="w-full p-2.5 rounded-lg border border-gray-300 text-sm focus:ring-blue-500 focus:border-blue-500" required>
          </div>

          <div class="mt-4">
            <label for="confirm_password" class="block text-sm font-medium text-gray-700 mb-1">Confirm password</label>
            <input type="password" id="confirm_password" placeholder="••••••••"
              class="w-full p-2.5 rounded-lg border border-gray-300 text-sm focus:ring-blue-500 focus:border-blue-500" required>
          </div>

          <button type="submit"
            class="w-full mt-6 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 rounded-lg transition">
            Register
          </button>

          <!-- Extra Links -->
          <div class="mt-6 text-sm text-center text-gray-600 space-y-2">
            <p>
              Already have an account? 
              <Link class="text-blue-600 hover:underline ml-1">Login</Link>
            </p>
            <p>
              Are you a company? 
              <Link class="text-blue-600 hover:underline ml-1">Register as a company</Link>
            </p>
            
          </div>
        </form>

        <!-- Info Panel -->
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
  
  export default {
    layout: AuthLayout,

    setup() {
      const form = useForm({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        type: 'jobseeker'
      })
  
      const submit = () => {
        form.post('/register/jobseeker')
      }
  
      return { form, submit }
    }
  }
  </script>
  