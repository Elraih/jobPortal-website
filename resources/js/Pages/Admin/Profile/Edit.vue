<template>
    <div class="max-w-4xl mx-auto py-10 px-4 space-y-6">
      <h1 class="text-2xl font-bold text-blue-800">Edit Admin Profile</h1>
  
      <form @submit.prevent="submitForm" class="bg-white shadow rounded-lg p-6 space-y-6">
        <!-- Admin Info -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">Full Name</label>
            <input v-model="form.name" type="text" class="input mt-1" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input v-model="form.email" type="email" class="input mt-1" />
          </div>
        </div>
  
        <!-- Role and Status -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">Role</label>
            <select v-model="form.role" class="input mt-1">
              <option value="">Select Role</option>
              <option>Super Admin</option>
              <option>Moderator</option>
              <option>HR</option>
              <option>Recruiter</option>
            </select>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Status</label>
            <select v-model="form.status" class="input mt-1">
              <option value="active">Active</option>
              <option value="suspended">Suspended</option>
              <option value="deactivated">Deactivated</option>
            </select>
          </div>
        </div>
  
        <!-- Password Reset -->
        <div>
          <label class="block text-sm font-medium text-gray-700">New Password (optional)</label>
          <input v-model="form.password" type="password" class="input mt-1" />
        </div>
  
        <!-- Submit -->
        <div class="text-right">
          <button type="submit" class="btn-primary">Update Admin</button>
        </div>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        form: {
          name: '',
          email: '',
          role: '',
          status: '',
          password: '',
        },
      };
    },
    methods: {
      submitForm() {
        // Replace this with actual API or Inertia call
        console.log('Submitted admin data:', this.form);
      },
    },
  };
  </script>
  
  
  