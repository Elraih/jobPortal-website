<template>
    <div class="max-w-3xl mx-auto py-10 px-4 space-y-6">
      <h1 class="text-2xl font-bold text-blue-800 mb-4">Edit Personal Info</h1>
      <form @submit.prevent="updateProfile" class="bg-white shadow rounded-lg p-6 space-y-4">
        <div>
          <label class="block text-sm font-medium">Full Name</label>
          <input type="text" v-model="form.name" class="mt-1 input" />
        </div>
  
        <div>
          <label class="block text-sm font-medium">Job Title</label>
          <input type="text" v-model="form.title" class="mt-1 input" />
        </div>
  
        <div>
          <label class="block text-sm font-medium">Bio</label>
          <textarea v-model="form.bio" class="mt-1 input h-28 resize-none" />
        </div>
  
        <div>
          <label class="block text-sm font-medium">Location</label>
          <input type="text" v-model="form.location" class="mt-1 input" />
        </div>
  
        <div>
          <label class="block text-sm font-medium">Phone</label>
          <input type="text" v-model="form.phone" class="mt-1 input" />
        </div>
  
        <div>
          <label class="block text-sm font-medium">Email</label>
          <input type="email" v-model="form.email" class="mt-1 input" />
        </div>
  
        <button type="submit" class="btn-primary w-full">Save</button>
      </form>
    </div>
  </template>
  
  <script>
import Layout from '../../../Layouts/layout.vue';

export default {

  layout: Layout,
    data() {
      return {
        form: {
          name: '',
          title: '',
          bio: '',
          location: '',
          phone: '',
          email: ''
        }
      };
    },
    methods: {
      updateProfile() {
        // send data to backend
      }
    }
  };
  </script>
  
  