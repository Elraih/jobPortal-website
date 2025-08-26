<template>

  <!-- <EditTab />  -->
  <div class="max-w-3xl mx-auto py-10 px-4 space-y-6">
    <h1 class="text-2xl font-bold text-blue-800 mb-4">Edit Experience & Education</h1>

    <!-- Experience -->
    <div class="bg-white p-6 shadow rounded-lg space-y-4">
      <h2 class="text-lg font-semibold">Experience</h2>
      <div v-for="(exp, index) in form.experiences" :key="index">
        <div class="grid md:grid-cols-3 grid-cols-1 gap-3">

          <!-- job title input  -->
          <div>
            <label class="text-blue-900 font-bold" :for="`title-${index}`">Job Title</label>
            <input class="border  my-2 rounded-md p-2 border-gray-400" v-model="exp.job_title" placeholder="Job Title"
              name="title" :id="`title-${index}`" />
          </div>
          <!-- end job title input  -->

          <!-- employeer input  -->
          <div>
            <label class="text-blue-900 font-bold" :for="`employeer-${index}`">Employeer</label>
            <input class="border  my-2 rounded-md p-2 border-gray-400" v-model="exp.employeer" placeholder="Company"
              :id="`employeer-${index}`" />
          </div>
          <!-- end employeer input  -->

          <!-- city input  -->
          <div>
            <label class="text-blue-900 font-bold" :for="`city-${index}`">City</label>
            <input class="border  my-2 rounded-md p-2 border-gray-400" v-model="exp.city" placeholder="city"
              :id="`city-${index}`" />
          </div>
          <!-- end city input  -->

          <!-- country input  -->
          <div>
            <label class="text-blue-900 font-bold" :for="`country-${index}`">country</label>
            <input class="border  my-2 rounded-md p-2 border-gray-400" v-model="exp.country" placeholder="Company"
              :id="`country-${index}`" />
          </div>
          <!-- city input  -->

          <!-- start date input  -->
          <div>
            <label class="text-blue-900 font-bold" :for="`started_date-${index}`">started date</label>
            <input type="date" class="border  my-2 rounded-md p-2 border-gray-400" :max="exp.end_date"
              v-model="exp.start_date" :id="`started_date-${index}`" />
          </div>
          <!-- end start input  -->


          <!-- end date input  -->
          <div>
            <label class="text-blue-900 font-bold" :for="`end_date-${index}`">ended date</label>
            <input type="date" class="border  my-2 rounded-md p-2 border-gray-400" :min="exp.start_date"
              v-model="exp.end_date" :id="`end_date-${index}`" />
          </div>
          <!-- end end date input  -->
        </div>

        <!-- description input  -->
        <div>
          <label class="text-blue-900 font-bold" :for="`description-${index}`">description</label>
          <textarea class="border my-2 rounded-md p-2 border-gray-400 w-full h-20" v-model="exp.description"
            placeholder="Description" :id="`description-${index}`" />
        </div>
        <!--end description input  -->


        <!-- show errors fill the form  -->
        <p v-if="flash[`experiences.${index}.job_title`] || flash[`experiences.${index}.employeer`] || flash[`experiences.${index}.country`] || flash[`experiences.${index}.city`] || flash[`experiences.${index}.start_date`] || flash[`experiences.${index}.end_date`] || flash[`experiences.${index}.descroption`]"
          class="bg-red-300 text-red-700 p-2 rounded-md">Fill All Inputs</p>

        <!-- bottun remove selected experience form  -->
        <button @click="removeExperience(index)"
          class="text-yellow-500 text-sm cursor-pointer  transition-shadow hover:shadow-[0_35px_35px_rgba(0,0,0,0.25)] hover:underline">-
          Remove Experience</button>
      </div>

      <!-- show errors of inputs  -->
      <p v-if="experienceError" class=" text-red-500 p-1 rounded-xl">Please fill in all fields before adding a new
        experience entry</p>

      <!-- bottun add new experience form  -->
      <button @click="addExperience"
        class="text-blue-500 text-sm cursor-pointer  transition-shadow hover:shadow-[0_35px_35px_rgba(0,0,0,0.25)] hover:underline">+
        Add Experience</button>
    </div>

    <!-- submit button  -->
    <button @click="saveAll"
      class="bg-blue-500 cursor-pointer hover:bg-blue-700 transition text-white p-2 rounded-xl mx-auto">Save</button>
  </div>
</template>

<script>
import EditTab from '@/Components/EditTab.vue';
import Input from '@/Components/UI/Input.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import { route } from 'ziggy-js';



export default {

  components: { EditTab, Input },
  props: {
    user: Object,
    experiences: Array,

  },
  data() {
    return {
      //  is_current: 0,
      err: this.$page.props,
      form: useForm({
        experiences: this.experiences.length ?
          this.experiences.map(exp => ({
            id: exp.id || null,
            job_title: exp.job_title || '',
            employeer: exp.employeer || '',
            city: exp.city || '',
            country: exp.country || '',
            start_date: exp.start_date || '',
            end_date: exp.end_date || '',
            description: exp.description || '',
            // is_current: Boolean(exp.is_current),

          })) :
          [
            {
              id: null,
              job_title: '',
              employeer: '',
              city: '',
              country: '',
              start_date: '',
              end_date: '',
              description: '',
              // is_current:  false,
            }],
      }),
      experienceError: false,
    };
  },
  methods: {
    // add new form and push new one if last is filled
    addExperience() {
      const last = this.form.experiences[this.form.experiences.length - 1];
      // check if the inputs is empty 
      if (last &&
        (last.job_title.trim() === '' || last.employeer.trim() === '' || last.city.trim() === '' || last.country.trim() === '' || last.start_date.trim() === '' || last.end_date.trim() === '' || last.description.trim() === '')
      ) {
        this.experienceError = true;
        return;
      }
      this.experienceError = false;
      // push new form inputs to the experience array if last is filled 
      this.form.experiences.push({
        id: null,
        job_title: '',
        employeer: '',
        city: '',
        country: '',
        start_date: '',
        end_date: '',
        description: '',
        // is_current:  false,
      });
    },

    // remove selected form and deleted 
    removeExperience(i) {

      // check if the form is not empty of fields 
      if (this.form.experiences[i] && this.form.experiences.length > 1) {

        // if form has already came from backend and has id remove it
        if (this.form.experiences[i].id) {
          this.$inertia.delete(route('user.profile.deleteExperience', this.form.experiences[i].id));
        }
        // splice the experience array
        this.form.experiences.splice(i, 1);
      }
      this.experienceError = false;
    },



    saveAll() {
      // send to backend
      this.$inertia.post(route('user.profile.editExperience', this.user), this.form);
    },

  },


  computed: {
    flash() {
      return this.$page.props.errors;
    }

  }
};
</script>