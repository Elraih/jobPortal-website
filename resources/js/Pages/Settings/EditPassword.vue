<template>
    <div class="max-w-xl mx-auto py-10 px-4 space-y-6">
      <h1 class="text-2xl font-bold text-blue-800">Update Password</h1>
  
      <form @submit.prevent="updatePassword" class="bg-white shadow-md rounded-lg p-6 space-y-6">
        <!-- Current Password -->
        <div>
          <label class="block text-sm font-medium text-gray-700">Current Password</label>
          <input
            v-model="form.currentPassword"
            type="password"
            class="input mt-1"
            placeholder="Enter current password"
          />
        </div>
  
        <!-- New Password -->
        <div>
          <label class="block text-sm font-medium text-gray-700">New Password</label>
          <input
            v-model="form.newPassword"
            type="password"
            class="input mt-1"
            placeholder="Enter new password"
          />
        </div>
  
        <!-- Confirm New Password -->
        <div>
          <label class="block text-sm font-medium text-gray-700">Confirm New Password</label>
          <input
            v-model="form.confirmPassword"
            type="password"
            class="input mt-1"
            placeholder="Confirm new password"
          />
        </div>
  
        <!-- Submit -->
        <div class="text-right">
          <button type="submit" class="btn-primary">Save Changes</button>
        </div>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        form: {
          currentPassword: '',
          newPassword: '',
          confirmPassword: ''
        }
      };
    },
    methods: {
      updatePassword() {
        if (this.form.newPassword !== this.form.confirmPassword) {
          alert("New passwords do not match.");
          return;
        }
  
        // Replace with actual API or Inertia call
        console.log("Sending password update:", this.form);
      }
    }
  };
  </script>
  
  