<template>

  <!-- <EditTab />  -->
  <div class="max-w-3xl mx-auto py-10 px-4 space-y-6">
    <h1 class="text-2xl font-bold text-blue-900 mb-4">Edit Education</h1>

    <!-- Experience -->
    <div class="bg-white p-6 shadow rounded-lg space-y-4">
      <h2 class="text-lg font-semibold ">Education</h2>
      <div v-for="(edu, index) in form.educations" :key="index">
        <div class="grid md:grid-cols-3 grid-cols-1 gap-3">
          <div>
            <label class="text-blue-900 font-bold" :for="`major-${index}`">Major</label>
            <input class="border my-2 rounded-md p-2 border-gray-400" v-model="edu.major" placeholder="major"
              :id="`major-${index}`" />
          </div>
          <!-- degree input  -->
          <div>
            <label class="text-blue-900 font-bold" :for="`degree-${index}`">Degree</label>
            <select class="border my-2 rounded-md p-2 border-gray-400" v-model="edu.degree" name="degree" :id="`degree-${index}`">
              <option disabled value=''>Select Your Degree</option>
              <option value='bachelors degree'>bachelors degree</option>
              <option value='high school diploma'>high school diploma</option>
              <option value='associates degree'>associates degree</option>
              <option value='masters degree'>masters degree</option>
              <option value='doctoral degree'>doctoral degree</option>
            </select>
          </div>
          <!-- end degree input  -->

          <!-- school name input  -->
          <div>
            <label class="text-blue-900 font-bold" :for="`school_name-${index}`">school Name</label>
            <input class="border  my-2 rounded-md p-2 border-gray-400" v-model="edu.school_name"
              placeholder="schoole name" :id="`school_name-${index}`" />
          </div>
          <!-- end school input  -->

          <!-- start date input  -->
          <div>
            <label class="text-blue-900 font-bold" :for="`start_date-${index}`">Started Date</label>
            <input type="date" :max="edu.completion_date" class="border  my-2 rounded-md p-2 border-gray-400"
              v-model="edu.start_date" :id="`start_date-${index}`" />
          </div>
          <!-- end start date input  -->

          <!-- start completion date input  -->
          <div>
            <label class="text-blue-900 font-bold" :for="`completion_date-${index}`">completion date</label>
            <input type="date" :min="edu.start_date" class="border  my-2 rounded-md p-2 border-gray-400"
              v-model="edu.completion_date" :id="`completion_date-${index}`" />
          </div>
          <!-- end completion date input  -->
        </div>


        <!-- show errors fill the form  -->
        <p v-if="flash[`educations.${index}.degree`] || flash[`educations.${index}.major`] || flash[`educations.${index}.school_name`] || flash[`educations.${index}.start_date`] || flash[`educations.${index}.completion_date`]"
          class="bg-red-300 text-red-700 p-2 rounded-md">Fill All Inputs</p>

        <!-- bottun remove selected education form  -->
        <button @click="removeEducation(index)" class="text-yellow-500 text-sm cursor-pointer  transition-shadow hover:shadow-[0_35px_35px_rgba(0,0,0,0.25)] hover:underline">- Remove Experience</button>
      </div>

      <!-- show errors of inputs  -->
      <p v-if="educationError" class=" text-red-500 p-1 rounded-xl">Please fill in all fields before adding a new
        education entry</p>

      <!-- bottun add new education form  -->
      <button @click="addEducation" class="text-blue-500 text-sm cursor-pointer  transition-shadow hover:shadow-[0_35px_35px_rgba(0,0,0,0.10)] hover:underline">+ Add Education</button>
    </div>

    <!-- submit button  -->
    <button @click="saveAll" class="bg-blue-500 cursor-pointer hover:bg-blue-700 transition text-white p-2 rounded-xl mx-auto">Save</button>
  </div>
</template>

<script>
import EditTab from '@/Components/EditTab.vue';
import Input from '@/Components/UI/Input.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { route } from 'ziggy-js';



export default {

  components: { EditTab, Input },
  props: {
    user: Object,
    educations: Array,

  },
  data() {
    return {
      err: this.$page.props,
      form: useForm({
        educations: this.educations.length ?
          this.educations.map(edu => ({
            degree: edu.degree,
            major: edu.major,
            school_name: edu.school_name,
            start_date: edu.start_date,
            completion_date: edu.completion_date,
            id: edu.id
          })) :
          [
            {
              degree: '',
              major: '',
              school_name: '',
              start_date: '',
              completion_date: '',
              id: null,
            }
          ]

      }),
      educationError: false,
    };
  },
  methods: {
    // add new form and push new one if last is filled
    addEducation() {
      const last = this.form.educations[this.form.educations.length - 1];
      // check if the inputs is empty 
      if (last &&
        (last.degree.trim() === '' || last.major.trim() === '' || last.school_name.trim() === '' || last.start_date.trim() === '' || last.completion_date.trim() === '')
      ) {
        this.educationError = true;
        return;
      }
      this.educationError = false;
      // push new form inputs to the educattion array if last is filled 
      this.form.educations.push({
        degree: '',
        major: '',
        school_name: '',
        start_date: '',
        completion_date: '',
        id: null,
      });
    },

    // remove selected form and deleted 
    removeEducation(i) {
      
      // check if the form is not empty of fields 
      if (this.form.educations[i] && this.form.educations.length > 1) {

        // if form has already came from backend and has id remove it
        if(this.form.educations[i].id){
          this.$inertia.delete(route('user.profile.deleteEducation', this.form.educations[i].id));
        }
        // splice the educations array
        this.form.educations.splice(i, 1);
      }
      this.educationError = false;
    },



    saveAll() {
      // send to backend
      this.$inertia.post(route('user.profile.editEducation', this.user), this.form);
    }
  },

  computed: {
    flash() {
      return this.$page.props.errors;
    }

  }
};
</script>