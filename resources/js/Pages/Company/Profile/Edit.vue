<template>
  <div class="max-w-3xl mx-auto py-10 px-4">
    <h1 class="text-2xl font-bold mb-4">Edit Company Profile</h1>

    <form @submit.prevent="submit" class="bg-white shadow p-6 rounded space-y-6">
      <div>
        <label class="block text-sm font-medium text-gray-700">Company Name</label>
        <input v-model="form.name" type="text" class="mt-1 block w-full border-gray-300 rounded" />
        <p v-if="form.errors.name" class="text-sm text-red-500">{{ form.errors.name }}</p>
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700">Website</label>
        <input v-model="form.website" type="url" class="mt-1 block w-full border-gray-300 rounded" />
        <p v-if="form.errors.website" class="text-sm text-red-500">{{ form.errors.website }}</p>
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700">about_us</label>
        <textarea v-model="form.about_us" rows="5" class="mt-1 block w-full border-gray-300 rounded"></textarea>
        <p v-if="form.errors.about_us" class="text-sm text-red-500">{{ form.errors.about_us }}</p>
      </div>

      <div>
        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">
          Save Changes
        </button>
      </div>
    </form>
  </div>
</template>

<script>
import { useForm } from '@inertiajs/vue3';


export default {
  props: {
    company: [Object, Array],
  },
  setup(props) {
    const form = useForm({
      name: props.company.name || '',
      website: props.company.website || '',
      description: props.company.about_us || '',
    })

    const submit = () => {
      // form.put(route('company.profile.update'))
      form.post('/jobs/create');

    }

    return { form, submit }
  },
}
</script>