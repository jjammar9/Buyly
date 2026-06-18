<script setup>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import SearchInput from './SearchInput.vue'
import AppButton from './AppButton.vue'
import { useAuth } from '../stores/auth.js'
import { useCart } from '../stores/cart.js'
import { useToast } from '../stores/toast.js'

const router = useRouter()
const { user, logout, isLoggedIn } = useAuth()
const { count, loadFromServer } = useCart()
const { show } = useToast()

const searchOpen = ref(false)

onMounted(() => { if (isLoggedIn.value) loadFromServer() })

function toggleSearch() { searchOpen.value = !searchOpen.value }
async function handleLogout() { await logout(); show('Logged out'); router.push('/') }
</script>

<template>
  <div>
    <nav class="bg-[#f7f5f0] border-b border-[#e8e8e8]">
      <div class="w-[95%] max-w-[1440px] mx-auto">
        <div class="flex items-center gap-4 py-3 max-md:gap-[10px] max-md:py-2">
          <a href="/" class="flex items-center gap-1.5 no-underline shrink-0 leading-none">
            <svg width="26" height="26" viewBox="0 0 24 24" fill="#166534" aria-hidden="true">
              <path d="M7 18c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59L5.25 14H19v-2H7.42l.94-2H17c.5 0 .95-.28 1.16-.72l3.42-6.99c.14-.29.13-.63-.03-.92A1 1 0 0 0 20.76 2H5.21L4.27 0H1zm6 14h12v-2H7l1.1-2h7.45l1.58-3H8.53L6.27 4H20.7l-2.8 5H8.53L7 16z"/>
            </svg>
            <span class="text-[28px] font-bold text-[#166534]">Buyly</span>
          </a>
          <div class="flex-1 flex max-w-[55%] mx-6 max-md:hidden">
            <SearchInput />
          </div>
          <div class="flex items-center gap-1 shrink-0 ml-auto max-md:gap-1">
            <template v-if="isLoggedIn" class="max-md:hidden">
              <router-link to="/categories" class="px-3 py-1.5 text-[14px] text-[#444] no-underline rounded-lg hover:bg-[#e8e6e1] hover:text-[#166534] font-medium max-md:hidden transition-colors">Categories</router-link>
              <router-link to="/cart" class="relative flex items-center gap-1.5 px-3 py-1.5 text-[14px] text-[#444] no-underline rounded-lg hover:bg-[#e8e6e1] hover:text-[#166534] font-medium max-md:hidden transition-colors">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M7 18c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59L5.25 14H19v-2H7.42l.94-2H17c.5 0 .95-.28 1.16-.72l3.42-6.99c.14-.29.13-.63-.03-.92A1 1 0 0 0 20.76 2H5.21L4.27 0H1zm6 14h12v-2H7l1.1-2h7.45l1.58-3H8.53L6.27 4H20.7l-2.8 5H8.53L7 16z"/></svg>
                Shop
                <span v-if="count > 0" class="ml-0.5 bg-[#0a8a4a] text-white text-[10px] font-bold min-w-[18px] h-[18px] rounded-full inline-flex items-center justify-center px-1">{{ count > 99 ? '99+' : count }}</span>
              </router-link>
              <router-link to="/help" class="px-3 py-1.5 text-[14px] text-[#444] no-underline rounded-lg hover:bg-[#e8e6e1] hover:text-[#166534] font-medium max-md:hidden transition-colors">Help</router-link>
            </template>
            <button
              aria-label="Search"
              class="hidden items-center justify-center w-9 h-9 border-0 bg-transparent cursor-pointer rounded-full hover:bg-[#e8e6e1] max-md:flex"
              @click="toggleSearch"
            >
              <svg width="22" height="22" viewBox="0 0 24 24" fill="#343538" aria-hidden="true">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M15.496 17.618a8 8 0 1 1 2.121-2.121l3.944 3.942-2.122 2.122zM17 11a6 6 0 1 1-12 0 6 6 0 0 1 12 0"/>
              </svg>
            </button>
            <template v-if="isLoggedIn">
              <router-link to="/profile" class="text-[14px] font-medium max-md:hidden no-underline text-[#166534] bg-white border border-[#166534] rounded-lg px-4 py-1.5 hover:bg-[#166534] hover:text-white transition-colors">Account</router-link>
              <button class="text-[14px] font-semibold max-md:hidden cursor-pointer bg-[#166534] text-white rounded-lg px-4 py-1.5 border-0 hover:bg-[#0f4a25] transition-colors" @click="handleLogout">Log out</button>
            </template>
            <template v-else>
              <router-link to="/login" class="max-md:hidden"><AppButton variant="secondary">Log in</AppButton></router-link>
              <router-link to="/register" class="max-md:hidden"><AppButton variant="primary">Sign up</AppButton></router-link>
              <router-link to="/login" class="hidden max-md:block text-[14px] font-semibold text-[#222] no-underline whitespace-nowrap hover:underline">Log in</router-link>
              <router-link to="/register" class="hidden max-md:block text-[14px] font-semibold text-[#0a8a4a] no-underline whitespace-nowrap hover:underline">Sign up</router-link>
            </template>
          </div>
        </div>
        <div class="hidden max-md:block transition-all duration-300 overflow-hidden" :class="searchOpen ? 'max-h-[60px] pb-2' : 'max-h-0 pb-0'">
          <SearchInput />
        </div>
      </div>
    </nav>


  </div>
</template>
