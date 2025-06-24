<template>
    <div class="max-w-3xl mx-auto py-10 px-4">
      <h1 class="text-2xl font-bold mb-6">Create a New Job</h1>
  
      <form @submit.prevent="submit" class="space-y-6">
        <div>
          <label class="block text-sm font-medium text-gray-700">Title</label>
          <input v-model="form.title" type="text" class="mt-1 block w-full border-gray-300 rounded" />
          <p v-if="form.errors.title" class="text-sm text-red-500">{{ form.errors.title }}</p>
        </div>
  
        <div>
          <label class="block text-sm font-medium text-gray-700">Location</label>
          <input v-model="form.location" type="text" class="mt-1 block w-full border-gray-300 rounded" />
          <p v-if="form.errors.location" class="text-sm text-red-500">{{ form.errors.location }}</p>
        </div>
  
        <div>
          <label class="block text-sm font-medium text-gray-700">Type</label>
          <select v-model="form.type" class="mt-1 block w-full border-gray-300 rounded">
            <option disabled value="">Select type</option>
            <option value="full-time">Full-Time</option>
            <option value="part-time">Part-Time</option>
            <option value="contract">Contract</option>
          </select>
          <p v-if="form.errors.type" class="text-sm text-red-500">{{ form.errors.type }}</p>
        </div>
  
        <div>
          <label class="block text-sm font-medium text-gray-700">Status</label>
          <select v-model="form.status" class="mt-1 block w-full border-gray-300 rounded">
            <option value="draft">Draft</option>
            <option value="open">Open</option>
            <option value="closed">Closed</option>
          </select>
          <p v-if="form.errors.status" class="text-sm text-red-500">{{ form.errors.status }}</p>
        </div>
  
        <div>
          <label class="block text-sm font-medium text-gray-700">Description</label>
          <textarea v-model="form.description" rows="5" class="mt-1 block w-full border-gray-300 rounded"></textarea>
          <p v-if="form.errors.description" class="text-sm text-red-500">{{ form.errors.description }}</p>
        </div>
  
        <div>
          <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded">
            Create Job
          </button>
        </div>
      </form>
    </div>
  </template>
  
  <script>
  import { useForm } from '@inertiajs/vue3';
  
  export default {
    setup() {
      const form = useForm({
        title: '',
        location: '',
        type: '',
        status: 'draft',
        description: '',
      })
  
      const submit = () => {
        form.post(route('company.jobs.store'))
      }
  
      return { form, submit }
    }
  }
  </script>
  