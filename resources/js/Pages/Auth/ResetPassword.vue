<template>
  <div class="min-h-screen flex flex-col items-center justify-center px-4 py-12">
    <div class="max-w-md w-full bg-white p-8 shadow rounded-xl">
      <h1 class="text-xl font-semibold text-blue-900 mb-4">Forgot Your Password?</h1>

      <p class="text-gray-600 mb-4">
        Enter your email address and we'll send you a link to reset your password.
      </p>

      <p>{{ form.errors }}</p>
      <form @submit.prevent="resetPassword">
        <Input  v-model="form.email" label="Email" name="email" :error="form.errors.email" type="email" />
        <Input  v-model="form.password" label="Password" :error="form.errors.password"  type="password"/>
        <Input  v-model="form.password_confirmation" label="Confirm Password" :error="form.errors.password_confirmation"  type="password"/>

        <button
          type="submit"
          class="w-full text-white py-2 px-4 rounded"
          :class="sending ? 'bg-gray-400 pointer-events-none' : 'bg-blue-600 hover:bg-blue-700 transition cursor-pointer'"
          :disabled="sending"
        >
          <span v-if="!sending">Send Reset Link</span>
          <span v-else>Sending...</span>
        </button>
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
    token: String,
  },

  data() {
    return {
      sending: false,
      form:useForm({
        email: '',
        token: this.token || '',
        password: '',
        password_confirmation: '',
      }),
    }
  },

  methods:{
    resetPassword(){
      this.sending = true;
      this.form.post(route('password.reset'));
    }
  },

}
</script>
