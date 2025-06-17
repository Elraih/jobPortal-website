<template>
    <div class="max-w-4xl mx-auto p-6 bg-white shadow rounded-2xl">
      <h1 class="text-2xl font-semibold mb-6">Create New Job</h1>
  
      <form @submit.prevent="submitJob" class="space-y-6">
        <!-- Job Title -->
        <div>
            <Input label="Title" placeholder="Job Title" name="title" required error="name"/>
        </div>
  
        <!-- Job Category + Type + Level -->
        <div class="grid md:grid-cols-3 gap-4">
            <div>
                <Select name="Category" label="Select Category" optionTitle="choose a category"
            :values="categories" 
            />
            </div>
          <div>
            <Select name="Category" label="Select Category" optionTitle="choose a category"
            :values="categories" 
            />
          </div>
  
          <div>
            <Select name="Category" label="Select Category" optionTitle="choose a category"
            :values="categories" 
            />
          </div>
  
          <div>
            <Select name="Category" label="Select Category" optionTitle="choose a category"
            :values="categories" 
            />
          </div>
        </div>
  
        <!-- Location + Remote Toggle -->
        <div>
            <h3 class="mb-4 text-lg font-semibold text-gray-900">Technologies</h3>

            <ul class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                <li v-for="tech in technologies" :key="tech.id" class="bg-white border border-gray-200 rounded-lg p-3">
                <label class="flex items-center space-x-2 cursor-pointer">
                    <input
                    type="checkbox"
                    :id="tech.id"
                    :value="tech.value"
                    v-model="selectedTechnologies"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 focus:ring-2"
                    />
                    <span class="text-sm font-medium text-gray-900">{{ tech.label }}</span>
                </label>
                </li>
            </ul>
        </div>


        <div class="grid grid-cols-2">

            <div>
                <date-input
                    name="deadline"
                    label="Application Deadline"
                    v-model="form.deadline"
                    />

            </div>
        </div>
  
        <!-- Salary Range -->
        <div class="grid grid-cols-2 gap-4">
          <div>
            <Input label="Title" placeholder="Job Title" name="title" required error="name"/>
          </div>
          <div>
            <Input label="Title" placeholder="Job Title" name="title" required error="name"/>
          </div>
        </div>
  
        <!-- Experience -->
        <div>
            <Input label="Title" placeholder="Job Title" name="title" required error="name"/>
        </div>
  
        <!-- Description -->
         <div>
            <text-area 
            :modelValue="form.description"
            label="Description"
            name="description"
            placeholder="Job Description"
            error="description"
            required />
        </div> 
  
        <!-- Requirements -->
        <div>
            <text-area 
            :modelValue="form.requirements"
            label="Requirements"
            name="requirements"
            placeholder="Job Requirements"
            error="requirements"
            required />
    
        </div>

        <!-- skills  -->
        <div>
            <Tags label="Enter Skills"/>
        </div>
  
        <!-- Submit Button -->
        <div class="text-right">
          <button type="submit"
                  class="bg-blue-600 text-white px-6 py-2 rounded-xl hover:bg-blue-700 transition">
            Publish Job
          </button>
        </div>
      </form>
    </div>
  </template>
  
  <script>
import CheckBox from '../../Components/UI/CheckBox.vue';
import DateInput from '../../Components/UI/DateInput.vue';
import Input from '../../Components/UI/Input.vue';
import Select from '../../Components/UI/Select.vue';
import Tags from '../../Components/UI/Tags.vue';
import TextArea from '../../Components/UI/TextArea.vue';
import Layout from '../../Layouts/layout.vue';

  export default {

    components:{Tags,Input, Select, TextArea, CheckBox, DateInput},
    layout: Layout,
    data() {
      return {
        form: {
          title: '',
          category: '',
          type: 'Full-time',
          level: 'Entry',
          location: '',
          remote: false,
          salary_min: '',
          salary_max: '',
          experience: '',
          description: '',
          requirements: '',
          logo: null,
          logoPreview: null,
        },
        categories: [
        { val: 'soft', title: 'Engineering' },
        { val: 'data', title: 'Data Science' },
        { val: 'play', title: 'Game Dev' },
        ], 
        technologies: [
      { id: 'vue', value: 'vue', label: 'Vue JS' },
      { id: 'react', value: 'react', label: 'React' },
      { id: 'angular', value: 'angular', label: 'Angular' },
      { id: 'laravel', value: 'laravel', label: 'Laravel' },
      { id: 'node', value: 'node', label: 'Node.js' },
      { id: 'django', value: 'django', label: 'Django' },
      { id: 'flutter', value: 'flutter', label: 'Flutter' },
      
    ]

    
      };
    },
    methods: {
      handleLogoUpload(e) {
        const file = e.target.files[0];
        this.form.logo = file;
        if (file) {
          this.form.logoPreview = URL.createObjectURL(file);
        }
      },
      submitJob() {
        // Validation (simplified)
        if (!this.form.title || !this.form.category || !this.form.description) {
          alert("Please fill all required fields.");
          return;
        }
  
        // Submit logic (e.g. Inertia.post or axios)
        console.log("Submitting job:", this.form);
      }
    }
  };
  </script>
  
 
  