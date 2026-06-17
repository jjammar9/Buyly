<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { useAuth } from '../stores/auth.js'

const router = useRouter()
const { login } = useAuth()
const email = ref('')
const password = ref('')
const error = ref('')

async function submit() {
  try {
    error.value = ''
    await login(email.value, password.value)
    router.push('/')
  } catch (e) { error.value = e.message }
}
</script>

<template>
  <div class="min-h-screen flex items-center justify-center bg-[#f9fafb]">
    <div class="w-full max-w-[400px] mx-auto p-8">
      <h1 class="text-[28px] font-bold text-[#222] text-center mb-2">Log in</h1>
      <p class="text-[14px] text-[#888] text-center mb-8">Welcome back to Buyly</p>
      <form @submit.prevent="submit" class="flex flex-col gap-4">
        <input v-model="email" type="email" placeholder="Email" required class="h-12 px-4 border border-[#ddd] rounded-lg text-[15px] outline-none focus:border-[#0a8a4a]" />
        <input v-model="password" type="password" placeholder="Password" required class="h-12 px-4 border border-[#ddd] rounded-lg text-[15px] outline-none focus:border-[#0a8a4a]" />
        <p v-if="error" class="text-[13px] text-[#c00] m-0">{{ error }}</p>
        <button type="submit" class="h-12 bg-[#0a8a4a] text-white text-[15px] font-semibold rounded-lg border-0 cursor-pointer hover:bg-[#097a42]">Log in</button>
      </form>
      <p class="text-[14px] text-[#888] text-center mt-6">Don't have an account? <router-link to="/register" class="text-[#0a8a4a] no-underline font-semibold">Sign up</router-link></p>
    </div>
  </div>
</template>
