<template>
  <div class="min-h-screen flex flex-col items-center justify-center px-4 py-12">
    <div class="max-w-md w-full bg-white p-8 shadow rounded-xl ">
      <h1 class="text-xl font-semibold text-gray-800 mb-4">Forgot Your Password?</h1>

      <p class="text-gray-600 mb-4">
        Enter your email address and we'll send you a link to reset your password.
      </p>

      <!-- Only show countdown if still running -->
      <p v-if="remainingTime > 0" class="text-sm text-gray-500 mb-2">
        You can resend the link in {{ remainingTime }} second<span v-if="remainingTime > 1">s</span>...
      </p>

      <div v-if="status === 'password-reset-link-sent'" class="mb-4 text-green-600 text-sm">
        A password reset link has been sent to your email address.
      </div>

      <form @submit.prevent="sendResetLink">
        <Input 
          v-model="form.email"
          type="email"
          label="Email Address"
          name="email"
          placeholder="Email address"
          :error="form.errors.email"
        />

        <button
          type="submit"
          class="w-full text-white py-2 px-4 rounded mt-4"
          :class="remainingTime > 0 ? 'bg-gray-400 pointer-events-none' : 'bg-blue-600 hover:bg-blue-700 transition cursor-pointer'"
          :disabled="sending || remainingTime > 0"
        >
          <span v-if="!sending">Send Reset Link</span>
          <span v-else>Sending...</span>
        </button>
      </form>
    </div>
  </div>
</template>

<script>
import Input from '@/Components/UI/Input.vue'
import { useForm } from '@inertiajs/vue3'

export default {
  components:{Input},
  props: {
    status: String,
  },

  data() {
    return {
      timer: null,
      remainingTime: 0,
      sending: false,
      form:useForm({
        email: '',
      }),
    }
  },

  methods: {
    sendResetLink() {
      this.sending = true

      this.form.post(route('password.sendResetEmail'), {}, {
        preserveScroll: true,
        preserveState: true,

        onSuccess: () => {
          this.sending = false
          localStorage.setItem('lastEmailSent', Date.now())
          this.startCountdown(60)
        },
        onError: () => {
          this.sending = false
        },
      })
    },

    checkRemainingTime() {
      const lastSent = localStorage.getItem('lastEmailSent')
      if (lastSent) {
        const lastSentTime = parseInt(lastSent, 10)
        const diff = Math.floor((Date.now() - lastSentTime) / 1000)
        if (diff < 60) {
          this.startCountdown(60 - diff)
        } else {
          this.remainingTime = 0
        }
      }
    },

    startCountdown(seconds) {
      this.remainingTime = seconds
      clearInterval(this.timer)
      this.timer = setInterval(() => {
        if (this.remainingTime > 0) {
          this.remainingTime--
        } else {
          clearInterval(this.timer)
        }
      }, 1000)
    }
  },

  mounted(){
    this.checkRemainingTime()
  },
  beforeUnmount() {
    clearInterval(this.timer)
  }
}
</script>
