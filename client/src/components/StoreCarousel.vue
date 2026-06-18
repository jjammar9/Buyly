<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'

const logoFiles = import.meta.glob('../assets/*.{png,jpg,jpeg,webp}', { eager: true, query: '?url', import: 'default' })
const allLogos = Object.values(logoFiles).filter(f => !f.includes('Hero') && !f.includes('image'))

const times = Array.from({ length: allLogos.length }, (_, i) => {
  const totalMinutes = 515 + i * 45
  const h = Math.floor(totalMinutes / 60) % 12 || 12
  const m = String(totalMinutes % 60).padStart(2, '0')
  const ampm = totalMinutes % 1440 < 720 ? 'am' : 'pm'
  return `${h}:${m} ${ampm}`
})

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
  <section class="w-[71%] mx-auto mt-16 mb-8">
    <div class="flex justify-between items-end mb-8">
      <div>
        <span class="text-[12px] font-semibold text-[#fb923c] uppercase tracking-[0.12em]">Partner Stores</span>
        <h2 class="text-[30px] font-bold text-[#222] m-0 mt-1">Stores to help you save</h2>
        <p class="text-[14px] text-[#777] mt-1.5 m-0 max-w-[480px]">Shop from top-rated local stores and national retailers — all in one place.</p>
      </div>
      <div class="flex gap-2">
        <button
          :disabled="currentPage === 0"
          class="flex items-center justify-center w-11 h-11 bg-white rounded-full border border-[#e8e8e8] cursor-pointer disabled:opacity-25 disabled:cursor-default hover:bg-[#f7f5f0] hover:border-[#d0d0d0] transition-all duration-150 shadow-sm"
          @click="scrollLeft"
        >
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#333" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="15 18 9 12 15 6"/>
          </svg>
        </button>
        <button
          :disabled="currentPage >= totalPages - 1"
          class="flex items-center justify-center w-11 h-11 bg-white rounded-full border border-[#e8e8e8] cursor-pointer disabled:opacity-25 disabled:cursor-default hover:bg-[#f7f5f0] hover:border-[#d0d0d0] transition-all duration-150 shadow-sm"
          @click="scrollRight"
        >
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#333" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="9 18 15 12 9 6"/>
          </svg>
        </button>
      </div>
    </div>

    <div ref="viewportEl" class="overflow-hidden">
      <div class="flex gap-4 transition-transform duration-300 ease-in-out" :style="{ transform: `translateX(${offset}px)` }">
        <div
          v-for="(logo, i) in allLogos"
          :key="i"
          class="shrink-0 w-[140px]"
        >
          <div class="group cursor-pointer">
            <div class="relative w-full h-[100px] flex items-center justify-center rounded-2xl bg-white border border-[#eee] p-3 group-hover:border-[#ddd] group-hover:shadow-md transition-all duration-200">
              <div v-if="i % 5 === 0 || i % 7 === 0" class="absolute top-2 right-2 z-[1]">
                <div class="flex items-center gap-1 bg-[#fb923c] text-white text-[9px] font-bold px-2 py-0.5 rounded-full shadow-sm">
                  <svg width="8" height="8" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                  <span>15% OFF</span>
                </div>
              </div>
              <img
                :src="logo"
                :alt="'Store ' + (i + 1)"
                class="max-w-full max-h-full object-contain group-hover:scale-105 transition-transform duration-200"
              />
            </div>
            <div class="flex items-center justify-between mt-2.5 px-0.5">
              <span class="text-[14px] font-semibold text-[#222] truncate">Store {{ i + 1 }}</span>
              <span class="text-[11px] text-[#0a8a4a] font-medium shrink-0 ml-2">Open</span>
            </div>
            <span class="text-[12px] text-[#888] px-0.5">Delivery by {{ times[i] }}</span>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
