<template>
  <div class="max-w-4xl mx-auto px-4 py-10 space-y-6">
    <h1 class="text-2xl font-bold text-blue-800">Edit Company Profile</h1>

    <!-- start profile edit form  -->
    <form @submit.prevent="updateCompany" enctype="multipart/form-data"
      class="bg-white shadow rounded-lg p-6 space-y-6">
      <!-- Company Info -->
      <div>
        <h2 class="text-lg font-semibold text-gray-700 mb-2">Basic Information</h2>

        <!--  company logo preview and input  -->
        <div class=" mt-6 contain-content flex flex-col items-center space-y-2">

          <!-- company logo previw  -->
          <img v-if="logoPreview || this.user.company_profile?.logo"
            :src="logoPreview || `/storage/${this.user.company_profile?.logo}`" alt="Preview"
            class="w-16 h-16 rounded-full object-cover border" />
          <!--end company logo previw  -->

          <!-- company logo input   -->
          <div class="flex items-center mb-2 gap-2">
            <input type="file" @change="handleFileChange" name="logo" class="block text-sm text-gray-500 file:mr-4 max-w-fit rounded-full  bg-gray-50 file:py-2 file:px-4
              file:rounded-full file:border-0
              file:text-sm file:font-semibold
              file:bg-blue-50 file:text-blue-700
              hover:file:bg-blue-100" />
            <button v-if="logoPreview || this.user.company_profile?.logo" @click.prevent="removeLogo"
              class="bg-red-500 text-white py-1 px-2 cursor-pointer rounded-full hover:bg-red-700">Remove image</button>

            <small v-if="form.errors.logo" class="mt-2 text-sm  text-red-600 ">{{ form.errors.logo }}</small>

          </div>
          <!-- end company logo input   -->

        </div>
        <!-- end company logo preview and input  -->

        <div class="grid grid-cols-1 md:grid-cols-2 items-center gap-4">
          

            <Input label="Name" v-model="form.name" placeholder="Company Name" name="name" :error="form.errors.name" />
          
            <Input label="Industry" v-model="form.industry" placeholder="Job Industry" name="industry"
              :error="form.errors.industry" />
          
            <Select label="Company's Size" :values="companySize" optionTitle="Select Compony's Size"
              v-model="form.company_size" :error="form.errors.company_size" name="company_size"></Select>
        </div>
      </div>
      <!-- end Company Info -->

      <!-- Description -->
      <div>
        <text-area v-model="form.about_us" label="About the Company" name="about_us" placeholder="About the Company"
          :error="form.errors.about_us" />
      </div>
      <!--end Description -->

      <!-- Contact Info -->
      <div>
        <h2 class="text-lg font-semibold text-gray-700 mb-2">Contact Info</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          
            <Input label="Phone" type="tel" v-model="form.phone" name="phone" :error="form.errors.phone" placeholder="+2012222222"/>
          
          
            <Select name="Governorate" label="Select Location" optionTitle="choose a Location" :values="governorates"
              labelKey="name" v-model="form.governorate_id" :error="form.errors.governorate_id" />
          
            <Input label="Address" v-model="form.address" name="address" :error="form.errors.address" placeholder="address"/>
          
        </div>
      </div>
      <!--end Contact Info -->

      <!-- Social Media -->
      <div>
        <h2 class="text-lg font-semibold text-gray-700 mb-2">Social Media</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
         
            <Input label="LinkedIn" type="url" v-model="form.linkedin" name="linkedin" :error="form.errors.linkedin" placeholder="ex: www.website.com/in."/>
          
            <Input label="Website" type="url" v-model="form.website" name="website" :error="form.errors.website" placeholder="ex: www.website.com/in."/>

        </div>
      </div>
        <!--end Social Media -->


      <button type="submit"
        class="bg-blue-500 text-white hover:bg-blue-600 cursor-pointer mx-3 py-1 px-2 rounded-lg">Save Company
        Profile</button>
      <button type="button" class="bg-red-500 text-white hover:bg-red-600 cursor-pointer mx-3 py-1 px-2 rounded-lg"
        @click="cancelSubmit">Cancel</button>
    </form>
    <!-- end profile edit form  -->
  </div>
</template>

<script>

import Input from '@/Components/UI/Input.vue';
import TextArea from '@/Components/UI/Textarea.vue';
import Select from '@/Components/UI/Select.vue'
import { useForm } from '@inertiajs/vue3';
import { route } from 'ziggy-js';


export default {

  components: { Input, TextArea, Select },
  props: {
    user: Object,
    governorates: Array,
    companySize: Object,
  },
  data() {
    return {
      logoPreview: null,
      form: useForm({
        name: this.user.company_profile?.name || '',
        industry: this.user.company_profile?.industry || '',
        website: this.user.contact_info?.website || '',
        about_us: this.user.company_profile?.about_us || '',
        phone: this.user.contact_info?.phone || '',
        governorate_id: this.user.location?.governorate.id || '',
        address: this.user.location?.address || '',
        linkedin: this.user.contact_info?.linkedIn || '',
        company_size: this.user.company_profile?.company_size || '',
        logo: null,
      }),
    }
  },
  methods: {

    updateCompany() {
      // Send form data to the backend
      console.log(this.form.company_size);
      this.form.post(route('company.profile.update', this.user), { forceFormData: true, });
    },

    handleFileChange(event) {
      const file = event.target.files[0];
      if (file) {
        this.form.logo = file;
        // For preview
        this.logoPreview = URL.createObjectURL(file);
      }
    },

    cancelSubmit() {
      this.$inertia.get(route('company.profile.show', { user: this.user }));
    },

    removeLogo() {
      if (this.logoPreview) {
        this.logoPreview = null;

      } else if (this.user.company_profile.logo) {
        this.$inertia.delete(route('company.profile.deleteLogo', { user: this.user }));
      }
    }

  }
};
</script>