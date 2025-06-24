<template>
    <div class="max-w-4xl mx-auto px-4 py-10 space-y-6">
      <h1 class="text-2xl font-bold text-blue-800">Edit Company Profile</h1>
  
      <form @submit.prevent="updateCompany" class="bg-white shadow rounded-lg p-6 space-y-6">
        <!-- Company Info -->
        <div>
          <h2 class="text-lg font-semibold text-gray-700 mb-2">Basic Information</h2>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium">Company Name</label>
              <input v-model="form.name" type="text" class="input mt-1" />
            </div>
            <div>
              <label class="block text-sm font-medium">Industry</label>
              <input v-model="form.industry" type="text" class="input mt-1" />
            </div>
            <div>
              <label class="block text-sm font-medium">Company Size</label>
              <select v-model="form.size" class="input mt-1">
                <option value="">Select</option>
                <option>1–10</option>
                <option>11–50</option>
                <option>51–200</option>
                <option>201–1000</option>
                <option>1000+</option>
              </select>
            </div>
            <div>
              <label class="block text-sm font-medium">Website</label>
              <input v-model="form.website" type="url" class="input mt-1" />
            </div>
          </div>
        </div>
  
        <!-- Description -->
        <div>
          <label class="block text-sm font-medium">About Company</label>
          <textarea v-model="form.description" rows="5" class="input mt-1 resize-none" />
        </div>
  
        <!-- Contact Info -->
        <div>
          <h2 class="text-lg font-semibold text-gray-700 mb-2">Contact Info</h2>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium">Phone</label>
              <input v-model="form.phone" type="text" class="input mt-1" />
            </div>
            <div>
              <label class="block text-sm font-medium">Email</label>
              <input v-model="form.email" type="email" class="input mt-1" />
            </div>
            <div class="md:col-span-2">
              <label class="block text-sm font-medium">Location / Address</label>
              <input v-model="form.address" type="text" class="input mt-1" />
            </div>
          </div>
        </div>
  
        <!-- Social Media -->
        <div>
          <h2 class="text-lg font-semibold text-gray-700 mb-2">Social Media</h2>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium">LinkedIn</label>
              <input v-model="form.linkedin" type="url" class="input mt-1" />
            </div>
            <div>
              <label class="block text-sm font-medium">Facebook</label>
              <input v-model="form.facebook" type="url" class="input mt-1" />
            </div>
            <div>
              <label class="block text-sm font-medium">Twitter (X)</label>
              <input v-model="form.twitter" type="url" class="input mt-1" />
            </div>
          </div>
        </div>
  
        <button type="submit" class="btn-primary w-full">Save Company Profile</button>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        form: {
          name: '',
          industry: '',
          size: '',
          website: '',
          description: '',
          phone: '',
          email: '',
          address: '',
          linkedin: '',
          facebook: '',
          twitter: ''
        }
      };
    },
    methods: {
      updateCompany() {
        // Send form data to the backend
        console.log(this.form);
      }
    }
  };
  </script>
  
 
  