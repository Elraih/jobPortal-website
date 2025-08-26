<template>
  <div class="min-h-screen flex flex-col bg-white items-center justify-center px-4 py-12 space-y-12">
    <h1 class="text-xl font-semibold text-gray-800 mb-4">Edit Your Account</h1>
    <div class="max-w-md w-full p-8 shadow rounded-xl">


      <p class="text-gray-600 mb-4">
           reset your password.
      </p>

      <form @submit.prevent="resetPassword">
        <Input  v-model="formPassword.password" label="Your Current Password" name="passwrord" :error="formPassword.errors.password"  type="password"/>
        <Input  v-model="formPassword.newPassword" label="Your New Password" name="newPassword" :error="formPassword.errors.newPassword"  type="password"/>
        <Input  v-model="formPassword.newPassword_confirmation" label="Confirm Your New Password" name="newPassword_confirmation" :error="formPassword.errors.newPassword_confirmation"  type="password"/>
        <button
          type="submit"
          :disabled="isPasswordEmpty"
          class=" text-white py-2 px-4 rounded  my-3"
          :class="isPasswordEmpty ?  'bg-gray-600' : 'bg-blue-600 hover:bg-blue-700 transition cursor-pointer'"
        >Submit</button>
      </form>
    </div>
    <div class="max-w-md w-full  p-8 shadow rounded-xl">

      <p class="text-gray-600 mb-4">
           Change your Email.
      </p>

      <form @submit.prevent="changeEmail">
        <Input  v-model="formEmail.newEmail" name="newEmail" label="Your New Email" :error="formEmail.errors.newEmail"  type="email"/>
        <Input  v-model="formEmail.newEmail_confirmation" name="newEmail_confirmation" label="Confirm Your New Email" :error="formEmail.errors.newEmail_confirmation"  type="email"/>
        <button
          type="submit"
          :disabled="isEmailEmpty"
          class=" text-white py-2 px-4 rounded my-3"
          :class="isEmailEmpty ? 'bg-gray-600' : 'bg-blue-600 hover:bg-blue-700 transition cursor-pointer'"
        >Submit</button>
      </form>
    </div>
    
  </div>
</template>

<script>
import Input from '@/Components/UI/Input.vue';
import { useForm } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

export default {
  components: { Input },
  props: {
    user: Object,
  },

  data() {
    return {
      sending: false,
      formPassword:useForm({
        password: '',
        newPassword: '',
        newPassword_confirmation: '',
      }),
      formEmail:useForm({
        newEmail: '',
        newEmail_confirmation: '',
        
      }),
      formDelete:useForm({
      }),
    }
  },

  methods:{
    resetPassword(){
      this.formPassword.patch(route('admin.profile.update.password', {user: this.user}));
      this.formPassword.reset();
    },
    changeEmail(){
      this.formEmail.patch(route('admin.profile.update.email', {user: this.user}));
      this.formEmail.reset();

    },
  },
  computed:{
    isPasswordEmpty(){
      return this.formPassword.password.trim() === '' 
      || this.formPassword.newPassword.trim() === ''
      || this.formPassword.newPassword_confirmation.trim() === ''
    },
    isEmailEmpty(){
      return  this.formEmail.newEmail.trim() === ''
      || this.formEmail.newEmail_confirmation.trim() === ''
    }
  }

}
</script>
