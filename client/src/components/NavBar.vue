<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import BuylyLogo from '../assets/instacart-logo-color-6678cb82d531f8910d5ba270a11a7e9b56fc261371bda42ea7a5abeff3492e1c.svg'
import SearchInput from './SearchInput.vue'
import AppButton from './AppButton.vue'
import SlideDrawer from './SlideDrawer.vue'
import ChevronArrow from './ChevronArrow.vue'
import { useAuth } from '../stores/auth.js'
import { useCart } from '../stores/cart.js'

const router = useRouter()
const { user, logout, isLoggedIn } = useAuth()
const { count } = useCart()

const drawerOpen = ref(false)
const searchOpen = ref(false)

function toggleDrawer() { drawerOpen.value = !drawerOpen.value }
function toggleSearch() { searchOpen.value = !searchOpen.value }
async function handleLogout() { await logout(); router.push('/') }
</script>

<template>
  <nav class="bg-[#f7f5f0] border-b border-[#e8e8e8]">
    <div class="w-[95%] max-w-[1440px] mx-auto">
      <div class="flex items-center gap-4 py-4 max-md:gap-[10px] max-md:py-3">
        <div class="flex items-center gap-1 shrink-0">
          <button
            data-testid="menu-button"
            :aria-label="drawerOpen ? 'Close menu' : 'Open main menu'"
            class="flex items-center justify-center p-1 mt-1 border-0 bg-transparent cursor-pointer shrink-0 rounded hover:bg-[#f0f0f0]"
            @click="toggleDrawer"
          >
            <svg v-if="drawerOpen" width="28" height="28" viewBox="0 0 24 24" fill="#343538" aria-hidden="true">
              <path d="M18 6L6 18M6 6l12 12" stroke="#343538" stroke-width="3" fill="none"/>
            </svg>
            <svg v-else width="28" height="28" viewBox="0 0 24 24" fill="#343538" aria-hidden="true">
              <path d="M20 6H4v2h16zM4 11h16v2H4zM4 16h16v2H4z"/>
            </svg>
          </button>
          <a href="/" class="leading-none shrink-0">
            <img :src="BuylyLogo" alt="Buyly" class="h-6 block" />
          </a>
        </div>
        <div class="flex-1 flex max-w-[61%] ml-6 max-md:hidden">
          <SearchInput />
        </div>
        <div class="flex items-center gap-3 shrink-0 ml-auto max-md:gap-2">
          <router-link to="/cart" class="relative flex items-center justify-center w-9 h-9 rounded-full hover:bg-[#e8e6e1] no-underline">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="#343538" aria-hidden="true">
              <path d="M7 18c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59L5.25 14H19v-2H7.42l.94-2H17c.5 0 .95-.28 1.16-.72l3.42-6.99c.14-.29.13-.63-.03-.92A1 1 0 0 0 20.76 2H5.21L4.27 0H1zm6 14h12v-2H7l1.1-2h7.45l1.58-3H8.53L6.27 4H20.7l-2.8 5H8.53L7 16z"/>
            </svg>
            <span v-if="count > 0" class="absolute -top-1 -right-1 bg-[#0a8a4a] text-white text-[10px] font-bold w-[18px] h-[18px] rounded-full flex items-center justify-center">{{ count > 99 ? '99+' : count }}</span>
          </router-link>
          <router-link to="/catalog" class="text-[14px] font-medium text-[#222] no-underline hover:text-[#0a8a4a] max-md:hidden">Catalog</router-link>
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
            <router-link to="/profile" class="text-[14px] text-[#222] font-medium max-md:hidden no-underline hover:underline">{{ user?.name }}</router-link>
            <button class="text-[14px] text-[#0a8a4a] bg-transparent border-0 cursor-pointer font-semibold max-md:hidden hover:underline" @click="handleLogout">Log out</button>
          </template>
          <template v-else>
            <router-link to="/login" class="max-md:hidden"><AppButton variant="secondary">Log in</AppButton></router-link>
            <router-link to="/register" class="max-md:hidden"><AppButton variant="primary">Sign up</AppButton></router-link>
            <router-link to="/login" class="hidden max-md:block text-[14px] font-semibold text-[#222] no-underline whitespace-nowrap hover:underline">Log in</router-link>
            <router-link to="/register" class="hidden max-md:block text-[14px] font-semibold text-[#0a8a4a] no-underline whitespace-nowrap hover:underline">Sign up</router-link>
          </template>
        </div>
      </div>
      <div class="hidden max-md:block transition-all duration-300 overflow-hidden" :class="searchOpen ? 'max-h-[60px] pb-3' : 'max-h-0 pb-0'">
        <SearchInput />
      </div>
    </div>
  </nav>

  <SlideDrawer :open="drawerOpen" :logoSrc="BuylyLogo" @close="toggleDrawer">
    <router-link to="/categories" class="flex justify-between items-center w-[90%] mx-auto py-3 text-[#222] no-underline text-[15px] font-medium rounded-lg">
      <span>Categories</span>
      <ChevronArrow />
    </router-link>
    <router-link to="/more-ways-to-shop" class="flex justify-between items-center w-[90%] mx-auto py-3 text-[#222] no-underline text-[15px] font-medium rounded-lg">
      <span>More ways to shop</span>
      <ChevronArrow />
    </router-link>
    <router-link to="/help" class="flex justify-between items-center w-[90%] mx-auto py-3 text-[#222] no-underline text-[15px] font-medium rounded-lg">
      <span>Help</span>
      <ChevronArrow />
    </router-link>
  </SlideDrawer>
</template>
