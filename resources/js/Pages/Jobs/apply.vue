<template>
    <div class="min-h-screen bg-gray-50 py-8">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6 p-6">
          <div class="flex items-start space-x-4">
            <img 
              
              alt="job.company.name"
              class="w-16 h-16 rounded-lg object-cover border border-gray-200"
            >
            <div class="flex-1">
              <h1 class="text-2xl font-bold text-gray-900">Senior Frontend Developer</h1>
              <p class="text-lg text-gray-600 mt-1">TechCorp Solutions</p>
              <div class="flex items-center space-x-4 mt-2 text-sm text-gray-500">
                <span class="flex items-center">
                  <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                  </svg>
                  Cairo, Egypt
                </span>
                <span class="flex items-center">
                  <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                  </svg>
                  Full-time
                </span>
                <span class="flex items-center">
                  <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                  </svg>
                  15,000 - 25,000 EGP
                </span>
              </div>
            </div>
          </div>
        </div>
  
        <!-- Application Form -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
          <div class="p-6 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-900">Apply for this Position</h2>
            <p class="text-gray-600 mt-1">Please fill out the application form below. All fields marked with * are required.</p>
          </div>
  
          <form  class="p-6 space-y-6">
           
            <!-- Application Questions -->
            <div>
              <h3 class="text-lg font-medium text-gray-900 mb-4">Additional Questions</h3>
              <div class="space-y-6">
                
                <!-- Question 1: Why do you want to join us? -->
                <div class="space-y-2">
                  <label for="question_1" class="block text-sm font-medium text-gray-700">
                    Why do you want to join our company?
                    <span class="text-red-500">*</span>
                  </label>
                  <textarea
                    id="question_1"
                    v-model="form.answers.question_1"
                    rows="4"
                    placeholder="Tell us about your motivation and what attracts you to our company..."
                    required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  ></textarea>
                  <!-- <p v-if="errors.question_1" class="text-red-600 text-sm">This field is required</p> -->
                </div>
  
                <!-- Question 2: When can you start? -->
                <div class="space-y-2">
                  <label for="question_2" class="block text-sm font-medium text-gray-700">
                    When can you start?
                    <span class="text-red-500">*</span>
                  </label>
                  <input
                    type="date"
                    id="question_2"
                    v-model="form.answers.question_2"
                    required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  >
                  <!-- <p v-if="errors.question_2" class="text-red-600 text-sm">This field is required</p> -->
                </div>
  
                <!-- Question 3: Tell us about yourself -->
              
  
              </div>
            </div>
  
            <!-- Terms and Conditions -->
            <div class="flex items-start space-x-3">
              <input
                id="terms"
                type="checkbox"
                v-model="form.terms_accepted"
                required
                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded mt-0.5"
              >
              <label for="terms" class="text-sm text-gray-700">
                I agree to the 
                <a href="/terms" target="_blank" class="text-blue-600 hover:text-blue-800 underline">terms and conditions</a>
                and 
                <a href="/privacy" target="_blank" class="text-blue-600 hover:text-blue-800 underline">privacy policy</a>
                *
              </label>
            </div>
  
            <!-- Submit Button -->
            <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
              <button
                type="button"
               
                class="px-6 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 transition-colors"
              >
                Cancel
              </button>
              <button
                type="submit"
                :disabled="processing"
                class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed transition-colors flex items-center space-x-2"
              >
                
               
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
</template>
  
<script>
import layout from '../../Layouts/layout.vue'

  export default {
    layout : layout,
    name: 'JobApplicationForm',
    props: {
      job: {
        type: Object,
        required: true
      },
      errors: {
        type: Object,
        default: () => ({})
      }
    },
    data() {
      return {
        processing: false,
        form: {
          resume: null,
          cover_letter: '',
          answers: {},
          terms_accepted: false
        }
      }
    },
    mounted() {
      // Initialize answers object for dynamic questions
      if (this.job.application_questions) {
        this.job.application_questions.forEach(question => {
          this.$set(this.form.answers, question.id, '')
        })
      }
    },
    methods: {
      handleResumeUpload(event) {
        const file = event.target.files[0]
        if (file) {
          // Validate file size (10MB max)
          if (file.size > 10 * 1024 * 1024) {
            alert('File size must be less than 10MB')
            return
          }
          
          // Validate file type
          const allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document']
          if (!allowedTypes.includes(file.type)) {
            alert('Please upload a PDF, DOC, or DOCX file')
            return
          }
          
          this.form.resume = file
        }
      },
      
      removeResume() {
        this.form.resume = null
        this.$refs.resumeInput.value = ''
      },
      
      submitApplication() {
        this.processing = true
        
        // Create FormData for file upload
        const formData = new FormData()
        
        // Add resume file
        if (this.form.resume) {
          formData.append('resume', this.form.resume)
        }
        
        // Add other form fields
        formData.append('cover_letter', this.form.cover_letter)
        formData.append('terms_accepted', this.form.terms_accepted ? '1' : '0')
        
        // Add answers to dynamic questions
        Object.keys(this.form.answers).forEach(questionId => {
          formData.append(`answers[${questionId}]`, this.form.answers[questionId])
        })
        
        // Submit using Inertia
        this.$inertia.post(route('jobs.apply', this.job.id), formData, {
          forceFormData: true,
          onFinish: () => {
            this.processing = false
          },
          onSuccess: () => {
            // Reset form on success
            this.form = {
              resume: null,
              cover_letter: '',
              answers: {},
              terms_accepted: false
            }
            this.$refs.resumeInput.value = ''
            
            // Reinitialize answers
            if (this.job.application_questions) {
              this.job.application_questions.forEach(question => {
                this.$set(this.form.answers, question.id, '')
              })
            }
          }
        })
      }
    }
  }
  </script>