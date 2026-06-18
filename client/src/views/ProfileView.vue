<script setup>
import { ref, onMounted } from 'vue'
import { useAuth } from '../stores/auth.js'
import { updateUser } from '../api.js'
import { useToast } from '../stores/toast.js'
import NavBar from '../components/NavBar.vue'
import FooterSection from '../components/FooterSection.vue'

const { user } = useAuth()
const { show } = useToast()

const name = ref('')
const email = ref('')
const currentPassword = ref('')
const newPassword = ref('')
const confirmPassword = ref('')
const message = ref('')
const error = ref('')
const saving = ref(false)

onMounted(() => {
  if (user.value) {
    name.value = user.value.name
    email.value = user.value.email
  }
})

async function save() {
  message.value = ''
  error.value = ''
  saving.value = true
  try {
    const body = {}
    if (name.value !== user.value.name) body.name = name.value
    if (email.value !== user.value.email) body.email = email.value
    if (newPassword.value) {
      body.current_password = currentPassword.value
      body.password = newPassword.value
      body.password_confirmation = confirmPassword.value
    }
    const data = await updateUser(body)
    user.value = data.user
    localStorage.setItem('user', JSON.stringify(data.user))
    currentPassword.value = ''
    newPassword.value = ''
    confirmPassword.value = ''
    message.value = 'Profile updated'
    show('Profile updated')
  } catch (e) {
    error.value = e.message
    show(e.message || 'Update failed', 'error')
  }
  saving.value = false
}
</script>

<template>
  <div>
    <NavBar />
    <div class="w-[71%] max-w-[1200px] mx-auto mt-8 mb-16">
      <h1 class="text-[28px] font-bold text-[#222] mb-8">My profile</h1>
      <form @submit.prevent="save" class="max-w-[500px] flex flex-col gap-5">
        <div>
          <label class="text-[13px] font-medium text-[#555] mb-1 block">Full name</label>
          <input v-model="name" class="h-12 w-full px-4 border border-[#ddd] rounded-lg text-[15px] outline-none focus:border-[#0a8a4a]" />
        </div>
        <div>
          <label class="text-[13px] font-medium text-[#555] mb-1 block">Email</label>
          <input v-model="email" type="email" class="h-12 w-full px-4 border border-[#ddd] rounded-lg text-[15px] outline-none focus:border-[#0a8a4a]" />
        </div>
        <hr class="border-t border-[#eee] my-2" />
        <p class="text-[14px] text-[#888] m-0">Change password (leave blank to keep current)</p>
        <div>
          <label class="text-[13px] font-medium text-[#555] mb-1 block">Current password</label>
          <input v-model="currentPassword" type="password" class="h-12 w-full px-4 border border-[#ddd] rounded-lg text-[15px] outline-none focus:border-[#0a8a4a]" />
        </div>
        <div>
          <label class="text-[13px] font-medium text-[#555] mb-1 block">New password</label>
          <input v-model="newPassword" type="password" minlength="8" class="h-12 w-full px-4 border border-[#ddd] rounded-lg text-[15px] outline-none focus:border-[#0a8a4a]" />
        </div>
        <div>
          <label class="text-[13px] font-medium text-[#555] mb-1 block">Confirm new password</label>
          <input v-model="confirmPassword" type="password" class="h-12 w-full px-4 border border-[#ddd] rounded-lg text-[15px] outline-none focus:border-[#0a8a4a]" />
        </div>
        <p v-if="message" class="text-[14px] text-[#0a8a4a] m-0 font-medium">{{ message }}</p>
        <p v-if="error" class="text-[14px] text-[#c00] m-0">{{ error }}</p>
        <button type="submit" :disabled="saving" class="h-12 w-full bg-[#0a8a4a] text-white text-[15px] font-semibold rounded-lg border-0 cursor-pointer hover:bg-[#097a42] disabled:opacity-50">
          {{ saving ? 'Saving...' : 'Save changes' }}
        </button>
      </form>
    </div>
    <FooterSection />
  </div>
</template>
