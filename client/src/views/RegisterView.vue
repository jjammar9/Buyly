<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { useAuth } from '../stores/auth.js'

const router = useRouter()
const { register } = useAuth()
const name = ref('')
const email = ref('')
const password = ref('')
const confirm = ref('')
const error = ref('')

async function submit() {
  try {
    error.value = ''
    await register(name.value, email.value, password.value, confirm.value)
    router.push('/')
  } catch (e) { error.value = e.message }
}
</script>

<template>
  <div class="min-h-screen flex items-center justify-center bg-[#f9fafb]">
    <div class="w-full max-w-[400px] mx-auto p-8">
      <h1 class="text-[28px] font-bold text-[#222] text-center mb-2">Sign up</h1>
      <p class="text-[14px] text-[#888] text-center mb-8">Create your Buyly account</p>
      <form @submit.prevent="submit" class="flex flex-col gap-4">
        <input v-model="name" type="text" placeholder="Full name" required class="h-12 px-4 border border-[#ddd] rounded-lg text-[15px] outline-none focus:border-[#0a8a4a]" />
        <input v-model="email" type="email" placeholder="Email" required class="h-12 px-4 border border-[#ddd] rounded-lg text-[15px] outline-none focus:border-[#0a8a4a]" />
        <input v-model="password" type="password" placeholder="Password (min 8 characters)" minlength="8" required class="h-12 px-4 border border-[#ddd] rounded-lg text-[15px] outline-none focus:border-[#0a8a4a]" />
        <input v-model="confirm" type="password" placeholder="Confirm password" required class="h-12 px-4 border border-[#ddd] rounded-lg text-[15px] outline-none focus:border-[#0a8a4a]" />
        <p v-if="error" class="text-[13px] text-[#c00] m-0">{{ error }}</p>
        <button type="submit" class="h-12 bg-[#0a8a4a] text-white text-[15px] font-semibold rounded-lg border-0 cursor-pointer hover:bg-[#097a42]">Sign up</button>
      </form>
      <p class="text-[14px] text-[#888] text-center mt-6">Already have an account? <router-link to="/login" class="text-[#0a8a4a] no-underline font-semibold">Log in</router-link></p>
    </div>
  </div>
</template>
