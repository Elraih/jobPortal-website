<template>
    <div class="max-w-3xl mx-auto py-10 px-4 space-y-6">
      <h1 class="text-2xl font-bold text-blue-800 mb-4">Edit Experience & Education</h1>
  
      <!-- Experience -->
      <div class="bg-white p-6 shadow rounded-lg space-y-4">
        <h2 class="text-lg font-semibold">Experience</h2>
        <div v-for="(exp, index) in experiences" :key="index" class="space-y-2">
          <input v-model="exp.title" placeholder="Job Title" class="input" />
          <input v-model="exp.company" placeholder="Company" class="input" />
          <input v-model="exp.period" placeholder="Period (e.g. 2020–2022)" class="input" />
          <textarea v-model="exp.description" placeholder="Description" class="input h-20" />
          <button @click="removeExperience(index)" class="text-red-500 text-sm">Remove</button>
        </div>
        <button @click="addExperience" class="btn-secondary mt-2">+ Add Experience</button>
      </div>
  
      <!-- Education -->
      <div class="bg-white p-6 shadow rounded-lg space-y-4">
        <h2 class="text-lg font-semibold">Education</h2>
        <div v-for="(edu, index) in education" :key="index" class="space-y-2">
          <input v-model="edu.degree" placeholder="Degree" class="input" />
          <input v-model="edu.school" placeholder="School" class="input" />
          <input v-model="edu.period" placeholder="Period" class="input" />
          <button @click="removeEducation(index)" class="text-red-500 text-sm">Remove</button>
        </div>
        <button @click="addEducation" class="btn-secondary mt-2">+ Add Education</button>
      </div>
  
      <button @click="saveAll" class="btn-primary w-full">Save</button>
    </div>
  </template>
  
  <script>
 import Layout from '../../../Layouts/layout.vue';

export default {

  layout: Layout,
    data() {
      return {
        experiences: [],
        education: []
      };
    },
    methods: {
      addExperience() {
        this.experiences.push({ title: '', company: '', period: '', description: '' });
      },
      removeExperience(i) {
        this.experiences.splice(i, 1);
      },
      addEducation() {
        this.education.push({ degree: '', school: '', period: '' });
      },
      removeEducation(i) {
        this.education.splice(i, 1);
      },
      saveAll() {
        // send to backend
      }
    }
  };
  </script>
  