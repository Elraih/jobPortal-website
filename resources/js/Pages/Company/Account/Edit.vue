<template>
  <div class="min-h-screen flex flex-col bg-white items-center justify-center px-4 py-12 space-y-12">
    <h1 class="text-2xl font-semibold text-blue-900 mb-4">Edit Your Account</h1>

    <!-- reset password form  -->
    <div class="max-w-md w-full p-8 shadow rounded-xl">
      <h3 class="text-blue-900  text-lg font-bold mb-4">
        reset your password.
      </h3>

      <form @submit.prevent="resetPassword">
        <Input v-model="formPassword.password" label="Your Current Password" :error="formPassword.errors.password"
          name="password" type="password" />
        <Input v-model="formPassword.newPassword" label="Your New Password" :error="formPassword.errors.newPassword"
          name="newPassword" type="password" />
        <Input v-model="formPassword.newPassword_confirmation" label="Confirm Your New Password"
          :error="formPassword.errors.newPassword_confirmation" name="newPassword_confirmation" type="password" />
        <button type="submit" :disabled="isPasswordEmpty" class=" text-white py-2 px-4 rounded  my-3"
          :class="isPasswordEmpty ? 'bg-gray-600' : 'bg-blue-600 hover:bg-blue-700 transition cursor-pointer'">Submit</button>
      </form>

    </div>
    <!--end  reset password form  -->


    <!--  reset email form  -->
    <div class="max-w-md w-full  p-8 shadow rounded-xl">
      <h3 class="text-blue-900  text-lg font-bold mb-4">
        Change your Email.
      </h3>

      <form @submit.prevent="changeEmail">
        <Input v-model="formEmail.newEmail" label="Your New Email" :error="formEmail.errors.newEmail" name="newEmail"
          type="email" />
        <Input v-model="formEmail.newEmail_confirmation" label="Confirm Your New Email" name="newEmail_confirmation"
          :error="formEmail.errors.newEmail_confirmation" type="email" />
        <button type="submit" :disabled="isEmailEmpty" class=" text-white py-2 px-4 rounded my-3"
          :class="isEmailEmpty ? 'bg-gray-600' : 'bg-blue-600 hover:bg-blue-700 transition cursor-pointer'">Submit</button>
      </form>
    </div>
    <!-- end reset email form  -->


    <!--  delete account form  -->
    <div class="max-w-md w-full  p-8 shadow rounded-xl">

      <h3 class="text-blue-900  text-lg font-bold mb-4">
        Delete your Account.
      </h3>

      <form @submit.prevent="deleteAccount">
        <button type="submit"
          class=" text-white my-3 py-2 px-4 rounded bg-red-600 hover:bg-red-700 transition cursor-pointer">Delete</button>
      </form>
    </div>
    <!--end  delete account form  -->

  </div>
</template>

<script>
import Input from '@/Components/UI/Input.vue';
import { useForm } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

export default {
  components: { Input },
  props: {
    company: Object,
  },

  data() {
    return {
      sending: false,
      formPassword: useForm({
        password: '',
        newPassword: '',
        newPassword_confirmation: '',
      }),
      formEmail: useForm({
        newEmail: '',
        newEmail_confirmation: '',

      }),
      formDelete: useForm({
      }),
    }
  },

  methods: {
    resetPassword() {
      this.formPassword.patch(route('company.account.update.password', { user: this.company }));
      this.formPassword.reset();
    },
    changeEmail() {
      this.formEmail.patch(route('company.account.update.email', { user: this.company }));
      this.formEmail.reset();

    },
    deleteAccount() {
      this.formDelete.delete(route('company.account.destroy', { user: this.company }));

    },
  },
  computed: {
    isPasswordEmpty() {
      return this.formPassword.password.trim() === ''
        || this.formPassword.newPassword.trim() === ''
        || this.formPassword.newPassword_confirmation.trim() === ''
    },
    isEmailEmpty() {
      return this.formEmail.newEmail.trim() === ''
        || this.formEmail.newEmail_confirmation.trim() === ''
    }
  }

}
</script>
