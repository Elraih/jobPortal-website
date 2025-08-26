<template>
  <div class="verify-email-page">
    <h1 class="text-2xl font-bold mb-4">Verify Your Email Address</h1>

    <p class="mb-4">
      Thanks for signing up! Before getting started, please verify your email address by clicking the link we just emailed to you. If you didn’t receive the email, we will gladly send you another.
    </p>

    <div v-if="status === 'verification-link-sent'" class="mb-4 text-green-600">
      A new verification link has been sent to your email address.
    </div>

    <form @submit.prevent="resendVerification">
      <button
        type="submit"
        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
      >
        Resend Verification Email
      </button>
    </form>

    <form @submit.prevent="logout" class="mt-4">
      <button
        type="submit"
        class="text-sm text-gray-600 underline hover:text-gray-900"
      >
        Logout
      </button>
    </form>
  </div>
</template>

<script setup>
import { router, usePage } from '@inertiajs/vue3'
import { ref } from 'vue'

const status = ref(usePage().props.flash.status || '')

const resendVerification = () => {
  router.post(route('verification.send'), {}, {
    onSuccess: () => {
      status.value = 'verification-link-sent'
    },
  })
}

const logout = () => {
  router.post(route('logout'))
}
</script>
