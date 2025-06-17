<template>
  <section class="min-h-screen flex items-center">
    <div class="max-w-md w-full mx-auto px-4 py-8">
      
      <div class="text-white text-center mb-6">
        <Link class="text-2xl font-bold">JobSite</Link>
      </div>

      <form class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4 text-center">Login to Your Account</h2>

        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
            <input type="email" placeholder="you@example.com" class="w-full p-2.5 border rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500" required>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <input type="password" placeholder="••••••••" class="w-full p-2.5 border rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500" required>
          </div>
        </div>

        <button type="submit" class="w-full mt-6 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 rounded-lg transition">Login</button>

        <div class="mt-6 text-sm text-center text-gray-600 space-y-1">
          <p>
            <Link class="text-blue-600 hover:underline">Forgot your password?</Link>
          </p>
          <p>
            Don’t have an account?
            <Link class="text-blue-600 hover:underline ml-1">Register</Link>
          </p>
          <p>
            Are you a company?
            <Link class="text-blue-600 hover:underline ml-1">Register your company</Link>
          </p>
        </div>
      </form>
    </div>
  </section>
</template>

  
  <script>
  import { reactive } from 'vue'
  import { useForm } from '@inertiajs/vue3'
import AuthLayout from '../../Layouts/AuthLayout.vue'
  
  export default {
    layout: AuthLayout,
    setup() {
      const form = useForm({
        email: '',
        password: ''
      })
  
      function submit() {
        form.post('/login')
      }
  
      return { form, submit }
    }
  }
  </script>
  
  
  