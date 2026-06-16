<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'

const logoFiles = import.meta.glob('../assets/*.{png,jpg,jpeg,webp}', { eager: true, query: '?url', import: 'default' })
const allLogos = Object.values(logoFiles).filter(f => !f.includes('Hero') && !f.includes('image'))

const times = ['8:35 am', '9:15 am', '10:00 am', '10:45 am', '11:20 am', '12:05 pm', '12:50 pm', '1:25 pm', '2:10 pm', '2:55 pm', '3:40 pm', '4:15 pm', '5:00 pm', '5:45 pm', '6:30 pm', '7:05 pm', '7:50 pm', '8:35 pm', '9:10 pm', '9:55 pm', '10:40 pm', '11:15 pm', '12:00 pm', '12:45 pm', '1:30 pm', '2:15 pm']

const currentPage = ref(0)
const viewportEl = ref(null)
const itemsPerPage = ref(4)

const step = 132
const totalPages = computed(() => Math.ceil(allLogos.length / itemsPerPage.value))
const offset = computed(() => -(currentPage.value * itemsPerPage.value * step))

function recalcItemsPerPage() {
  if (viewportEl.value) {
    const vw = viewportEl.value.clientWidth
    itemsPerPage.value = Math.max(1, Math.floor(vw / step))
  }
}

function scrollLeft() {
  if (currentPage.value > 0) currentPage.value--
}

function scrollRight() {
  if (currentPage.value < totalPages.value - 1) currentPage.value++
}

onMounted(() => {
  recalcItemsPerPage()
  window.addEventListener('resize', recalcItemsPerPage)
})

onUnmounted(() => {
  window.removeEventListener('resize', recalcItemsPerPage)
})
</script>

<template>
  <section class="w-[71%] mx-auto mt-8" style="font-family: DM Sans, sans-serif">
    <div class="flex justify-between items-start">
      <div>
        <h2 class="text-[26px] font-bold text-[#222] m-0">Stores to help you save</h2>
        <p class="text-[13px] text-[#888] mt-1 m-0">Offers subject to terms and eligibility</p>
      </div>
      <div class="flex gap-2 mt-1">
        <button
          :disabled="currentPage === 0"
          class="flex items-center justify-center w-9 h-9 border border-[#ddd] bg-white rounded-full cursor-pointer disabled:opacity-30 disabled:cursor-default hover:bg-[#f5f5f5] transition-colors duration-150"
          @click="scrollLeft"
        >
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="15 18 9 12 15 6"/>
          </svg>
        </button>
        <button
          :disabled="currentPage >= totalPages - 1"
          class="flex items-center justify-center w-9 h-9 border border-[#ddd] bg-white rounded-full cursor-pointer disabled:opacity-30 disabled:cursor-default hover:bg-[#f5f5f5] transition-colors duration-150"
          @click="scrollRight"
        >
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="9 18 15 12 9 6"/>
          </svg>
        </button>
      </div>
    </div>
    <div ref="viewportEl" class="overflow-hidden pt-5">
      <div class="flex gap-3 transition-transform duration-300 ease-in-out" :style="{ transform: `translateX(${offset}px)` }">
        <div
          v-for="(logo, i) in allLogos"
          :key="i"
          class="shrink-0 w-[120px] flex flex-col items-center"
        >
          <div class="relative w-[120px] h-[90px] flex items-center justify-center border border-[rgba(0,0,0,0.12)] rounded-lg bg-white p-2.5">
            <div v-if="i % 5 === 0 || i % 7 === 0" class="absolute top-[-20px] right-[-8px] w-14 h-14 z-[1] flex items-center justify-center" style="transform: rotate(-12deg); filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2))">
              <svg viewBox="0 0 56 64" class="absolute top-0 left-0 w-full h-full block pointer-events-none">
                <path d="m25.36 58.016-6.14 4.569-.6-7.687-7.18 2.634 1.566-7.561-7.628.498 3.602-6.803-7.438-1.695 5.355-5.49-6.678-3.762 6.678-3.762-5.359-5.49 7.442-1.695-3.602-6.803 7.628.498-1.567-7.562 7.184 2.634.596-7.686 6.14 4.569L28.092.219l4.628 6.152L37.344.219l2.731 7.203 6.14-4.57.6 7.687L54 7.905l-1.567 7.562 7.625-.498-3.602 6.803 7.442 1.694-5.359 5.491 6.681 3.762-6.68 3.761 5.358 5.491-7.442 1.695 3.602 6.803-7.625-.498 1.564 7.561-7.18-2.634-.6 7.687-6.14-4.57-2.732 7.204-4.625-6.152-4.628 6.152z" fill="#FFCC00" stroke="#fff" stroke-width="2.5" stroke-linejoin="round" />
              </svg>
              <span class="relative text-[9px] font-black text-[#1a1a1a] leading-[1.1] text-center z-[1]" style="transform: translateX(1.5px)">15%<br/>OFF</span>
            </div>
            <img
              :src="logo"
              :alt="'Store ' + (i + 1)"
              class="max-w-full max-h-full object-contain"
            />
          </div>
          <span class="text-[13px] font-bold text-[#222] text-center mt-1.5 truncate max-w-full">Store {{ i + 1 }}</span>
          <span class="text-[11px] font-light text-[#1a1a1a] text-center mt-1 bg-[#FFCC00] px-2 py-[1px] rounded inline-block">By {{ times[i] }}</span>
        </div>
      </div>
    </div>
  </section>
</template>
