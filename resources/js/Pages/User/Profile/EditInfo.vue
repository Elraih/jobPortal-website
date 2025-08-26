<template>
  <div class="bg-gray-100 min-h-screen py-10 px-4">

    <!-- start form  -->

    <form class="max-w-5xl mx-auto space-y-8" @submit.prevent="updateProfile">

      <!-- Header -->
      <div>
        <h1 class="text-3xl font-bold text-blue-900">Edit Personal Info</h1>
        <p class="text-sm text-gray-500">Update your profile information to keep your account up to date.</p>
      </div>
      <!--end Header -->


      <!-- Profile avatar Section -->
      <div class="bg-white shadow-sm rounded-lg p-6 space-y-4">
        <h2 class="text-lg font-bold text-blue-900 border-b pb-2">Profile Photo</h2>
        <div class=" mt-6 contain-content flex flex-col items-center space-y-2">
            
            <img v-if="imagePreview || this.user.user_profile?.avatar"
            :src="imagePreview || `/storage/${this.user.user_profile?.avatar}`"
            alt="Preview"
            class="w-16 h-16 rounded-full object-cover border"
            />
            
            <div class="flex items-center mb-2 gap-2">
              <input
              type="file"
              name="avatar"
              @change="handleFileChange"
              class="block text-sm text-gray-500 file:mr-4 max-w-fit rounded-full  bg-gray-50 file:py-2 file:px-4
              file:rounded-full file:border-0
              file:text-sm file:font-semibold
              file:bg-blue-50 file:text-blue-700
              hover:file:bg-blue-100"
              />
              <button v-if="imagePreview || this.user.user_profile?.avatar" @click.prevent="removeAvatar" class="bg-red-500 text-white py-1 px-2 cursor-pointer rounded-full hover:bg-red-700">Remove image</button>
          
           <small v-if="form.errors.avatar" class="mt-2 text-sm  text-red-600 ">{{ form.errors.avatar }}</small>

        </div>
            
          
          </div>
      </div>
      <!--end Profile avatar Section -->

      <!-- Personal Info -->
      <div class="bg-white shadow-sm rounded-lg p-6 space-y-6">
        <h2 class="text-lg font-bold text-blue-900 border-b pb-2">Personal Information</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <Input v-model="form.first_name" name="first_name" label="First Name" :error="form.errors.first_name"/>
          <Input v-model="form.last_name" name="last_name" label="Last Name" :error="form.errors.last_name"/>
          
          <div class="flex flex-col">
            <label for="date_of_birth">Date Of Birth</label>
            <input class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" type="date" v-model="form.date_of_birth" id="date_of_birth" name="date_of_birth"></input>
            <p v-if="form.errors.date_of_birth">{{ form.errors.date_of_birth }}</p>
          </div>
          <div class="">
            <label for="gender">Gender</label>
            <select v-model="form.gender" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" id="gender" name="gender">
            <option disabled value="">select gender</option>
            <option value="male">male</option>
            <option value="female">female</option>
          </select>
          <p>{{ form.errors.gender }}</p>
          </div>
        </div>
      </div>

      <!-- Contact Section -->
      <div class="bg-white shadow-sm rounded-lg p-6 space-y-6">
        <h2 class="text-lg font-bold text-blue-900 border-b pb-2">Contact Information</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <Input v-model="form.phone" type="tel" label="Phone Number" :error="form.errors.phone" name="phone"/>
          <Select
            name="governorate"
            label="Governorate"
            optionTitle="Choose a location"
            :values="governorates"
            labelKey="name"
            v-model="form.governorate_id"
            :error="form.errors.governorate_id"
          />
          
          <Input v-model="form.address" name="address" label="Address" :error="form.errors.address"/>

          <Input type="url" v-model="form.website" name="website" label="Website" :error="form.errors.website"/>
          <Input type="url" v-model="form.linkedin" name="linkedIn" label="LinkedIn" :error="form.errors.linkedin"/>
        </div>
      </div>


      <!-- About Me & Resume -->
      <div class="bg-white shadow-sm rounded-lg p-6 space-y-4">
        <h2 class="text-lg font-bold text-blue-900 border-b pb-2">More About You</h2>
        <TextArea v-model="form.about_me" label="About Me" :error="form.errors.about_me" name="about_me"/>
        <div>
          <label class="text-lg font-bold text-blue-900">Upload Resume</label>
          <input type="file" @change="handleCvUpload" 
          name="resume"
          class="block text-sm text-gray-500 
          file:mr-4 file:py-2 file:px-4
          file:rounded-full file:border-0
          file:text-sm file:font-semibold
          file:bg-blue-50 file:text-blue-700
          hover:file:bg-blue-100" />
              <p v-if="form.errors.resume">{{ form.errors.resume }}</p>
              <div v-if="user.resume?.resume" class="my-5">
                <a :href="route('user.resume.downloadResume', {resume:user.resume})" target="_blank"
               class="inline-block bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded text-sm text-blue-700 border">
                Your Resume
                </a>
              </div>
        </div>
      </div>
      <!--end About Me & Resume -->

      <!-- Submit Button -->
      <div class="flex justify-end">
        <button
          type="submit"
          class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-md transition"  
        >
          Save Changes
        </button>
      </div>
      <!--end Submit Button -->

    </form>
    <!-- end form  -->
  </div>
</template>


  <script>
import EditTab from '@/Components/EditTab.vue';
import Input from '@/Components/UI/Input.vue';
import Select from '@/Components/UI/Select.vue';
import TextArea from '@/Components/UI/TextArea.vue';
import DateInput from '@/Components/UI/DateInput.vue';
import { useForm } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

export default {

  components:{EditTab, Input, Select, TextArea, DateInput},
  props:{
    user: Object,
    governorates: Array,
  },
    data() {
      return {
        imagePreview: null,
        form: useForm({
          first_name: this.user.user_profile.first_name || '',
          last_name: this.user.user_profile.last_name || '',
          date_of_birth: this.user.user_profile?.date_of_birth || '',
          website: this.user.contact_info?.website || '',
          linkedin: this.user.contact_info?.linkedIn || '',
          address: this.user.location?.address || '',
          gender: this.user.user_profile?.gender || '',
          about_me: this.user.user_profile?.about_me || '',
          phone: this.user.contact_info?.phone || '',
          governorate_id: this.user.location?.governorate.id || '',
          avatar:  null,
          resume:  null,
        })
      };
    },
    methods: {
      updateProfile() {
        this.form.post(route('user.profile.editInfo', this.user), {
          forceFormData: true,
        });
      },

      // preview avatar iamge 
      handleFileChange(event) {
        const file = event.target.files[0];
        if (file) {
          this.form.avatar = file;
          // For preview
          this.imagePreview = URL.createObjectURL(file);
        }
      },
      // preview resume file 
      handleCvUpload(event){
        const file = event.target.files[0];
        if(file){
          this.form.resume = file;
        } 
      },

      // remove avatar image or preview 
      removeAvatar() {
      if (this.imagePreview) {
        this.imagePreview = null;
        
      } else if (this.user.user_profile.avatar) {
        this.$inertia.delete(route('user.profile.deleteAvatar', { user: this.user }));
      }
    }
    },
    
   
    
  };
  </script>
  
  