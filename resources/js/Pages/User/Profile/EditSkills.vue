<template>
    <div class="max-w-3xl mx-auto py-10 px-4 space-y-6">
      <h1 class="text-2xl font-bold text-blue-800 mb-4">Edit Skills</h1>
      <div class="bg-white shadow rounded-lg p-6">
        <div class="flex flex-wrap gap-2 mb-4">
          <span v-for="(skill, index) in skills" :key="index" class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">
            {{ skill }}
            <button @click="removeSkill(index)" class="ml-2 text-red-500 hover:text-red-700 text-xs">x</button>
          </span>
        </div>
        <div class="flex gap-2">
          <input v-model="newSkill" class="input" placeholder="Add skill..." />
          <button @click="addSkill" class="btn-primary">Add</button>
        </div>
      </div>
    </div>
  </template>
  
  <script>
import Layout from '../../../Layouts/layout.vue';

  export default {

    layout: Layout,
    data() {
      return {
        skills: ['Vue.js', 'Laravel'],
        newSkill: ''
      };
    },
    methods: {
      addSkill() {
        if (this.newSkill && !this.skills.includes(this.newSkill)) {
          this.skills.push(this.newSkill);
          this.newSkill = '';
        }
      },
      removeSkill(i) {
        this.skills.splice(i, 1);
      }
    }
  };
  </script>
  