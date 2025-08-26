<template>
  <div class="min-h-screen flex flex-col items-center justify-center px-4 py-12">
    <div class="max-w-md w-full bg-white p-8 shadow rounded-xl">
      <h1 class="text-xl font-semibold text-gray-800 mb-4">Verify Your Email</h1>

      <p class="text-gray-600 mb-4">
        Thanks for signing up! Please check your email for a verification link.
        If you didn’t receive it, we’ll gladly send you another.
      </p>

      <p v-if="timer > 0" class="text-sm text-gray-500 mb-2">
        You can resend in {{ timer }} second<span v-if="timer > 1">s</span>...
      </p>

      <div v-if="status === 'verification-link-sent'" class="mb-4 text-green-600 text-sm">
        A new verification link has been sent to your email address.
      </div>

      <form @submit.prevent="resendVerification">
        <button
          type="submit"
          class="w-full text-white py-2 px-4 rounded"
          :class="timer > 0 ? 'bg-gray-400 pointer-events-none' : 'bg-blue-600 hover:bg-blue-700 transition cursor-pointer'"
          :disabled="sending || timer > 0"
        >
          <span v-if="!sending">Resend Verification Email</span>
          <span v-else>Sending...</span>
        </button>
      </form>

      <!-- <form method="POST" action="/logout" class="mt-4 text-center">
        <button
          type="submit"
          class="text-sm text-gray-500 hover:text-gray-800 underline"
        >
          Log Out
        </button>
      </form> -->
    </div>
  </div>
</template>

<script>
// import { Inertia } from '@inertiajs/inertia'

export default {
  props: {
    status: String,
  },

  // layout: '@/Layouts/Layout.vue', // Corrected from `layouts` to `layout`

  data() {
    return {
      counter: 60,
      timer: 0,
      countdown: null,
      sending: false,
    }
  },

  methods: {
    resendVerification() {
      this.sending = true

    
      this.$inertia.post(this.route('verification.send'), {}, {
        preserveScroll: true,
        preserveState:true,
        
        onSuccess: () => {
          this.sending = false
          this.startCountdown()
        },
        onError: () => {
          this.sending = false
        },
      })
    },

    startCountdown() {
      this.timer = this.counter
      this.clearCountdown()
      this.countdown = setInterval(() => {
        if (this.timer > 0) {
          this.timer--
        } else {
          this.clearCountdown()
        }
      }, 1000)
    },

    clearCountdown() {
      if (this.countdown) {
        clearInterval(this.countdown)
        this.countdown = null
      }
    }
  },

  beforeUnmount() {
    this.clearCountdown()
  }
}
</script>
