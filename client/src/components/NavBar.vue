<script setup>
import { ref } from 'vue'
import BuylyLogo from '../assets/instacart-logo-color-6678cb82d531f8910d5ba270a11a7e9b56fc261371bda42ea7a5abeff3492e1c.svg'
import SearchInput from './SearchInput.vue'
import AppButton from './AppButton.vue'
import SlideDrawer from './SlideDrawer.vue'
import ChevronArrow from './ChevronArrow.vue'

const drawerOpen = ref(false)
const searchOpen = ref(false)

function toggleDrawer() {
  drawerOpen.value = !drawerOpen.value
}

function toggleSearch() {
  searchOpen.value = !searchOpen.value
}
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
          <button
            aria-label="Search"
            class="hidden items-center justify-center w-9 h-9 border-0 bg-transparent cursor-pointer rounded-full hover:bg-[#e8e6e1] max-md:flex"
            @click="toggleSearch"
          >
            <svg width="22" height="22" viewBox="0 0 24 24" fill="#343538" aria-hidden="true">
              <path fill-rule="evenodd" clip-rule="evenodd" d="M15.496 17.618a8 8 0 1 1 2.121-2.121l3.944 3.942-2.122 2.122zM17 11a6 6 0 1 1-12 0 6 6 0 0 1 12 0"/>
            </svg>
          </button>
          <AppButton variant="secondary" class="max-md:hidden">Log in</AppButton>
          <AppButton variant="primary" class="max-md:hidden">Sign up</AppButton>
          <a href="#" class="hidden max-md:block text-[14px] font-semibold text-[#222] no-underline whitespace-nowrap hover:underline">Log in</a>
          <a href="#" class="hidden max-md:block text-[14px] font-semibold text-[#0a8a4a] no-underline whitespace-nowrap hover:underline">Sign up</a>
        </div>
      </div>
      <div class="hidden max-md:block transition-all duration-300 overflow-hidden" :class="searchOpen ? 'max-h-[60px] pb-3' : 'max-h-0 pb-0'">
        <SearchInput />
      </div>
    </div>
  </nav>

  <SlideDrawer :open="drawerOpen" :logoSrc="BuylyLogo" @close="toggleDrawer">
    <a href="#" class="flex justify-between items-center w-[90%] mx-auto py-3 text-[#222] no-underline text-[15px] font-medium rounded-lg">
      <span>Departments</span>
      <ChevronArrow />
    </a>
    <a href="#" class="flex justify-between items-center w-[90%] mx-auto py-3 text-[#222] no-underline text-[15px] font-medium rounded-lg">
      <span>More ways to shop</span>
      <ChevronArrow />
    </a>
    <a href="#" class="flex justify-between items-center w-[90%] mx-auto py-3 text-[#222] no-underline text-[15px] font-medium rounded-lg">
      <span>Help</span>
      <ChevronArrow />
    </a>
  </SlideDrawer>
</template>
