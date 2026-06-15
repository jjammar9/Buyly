<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'

const stores = [
  { name: 'Whole Foods', logo: 'https://www.google.com/s2/favicons?domain=wholefoodsmarket.com&sz=64', time: '1h 30min' },
  { name: 'Trader Joe\'s', logo: 'https://www.google.com/s2/favicons?domain=traderjoes.com&sz=64', time: '45min' },
  { name: 'Costco', logo: 'https://www.google.com/s2/favicons?domain=costco.com&sz=64', time: '2h 15min' },
  { name: 'Walmart', logo: 'https://www.google.com/s2/favicons?domain=walmart.com&sz=64', time: '1h' },
  { name: 'Target', logo: 'https://www.google.com/s2/favicons?domain=target.com&sz=64', time: '50min' },
  { name: 'Aldi', logo: 'https://www.google.com/s2/favicons?domain=aldi.us&sz=64', time: '1h 15min' },
  { name: 'Publix', logo: 'https://www.google.com/s2/favicons?domain=publix.com&sz=64', time: '55min' },
  { name: 'Safeway', logo: 'https://www.google.com/s2/favicons?domain=safeway.com&sz=64', time: '1h 10min' },
]

const currentPage = ref(0)
const viewportEl = ref(null)
const itemsPerPage = ref(4)

const step = 156 // 140 + 16 gap
const totalPages = computed(() => Math.ceil(stores.length / itemsPerPage.value))

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
  <section class="store-carousel">
    <div class="carousel-header">
      <h2 class="carousel-title">Stores to help you save</h2>
      <div class="carousel-arrows">
        <button class="arrow-btn" @click="scrollLeft">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="15 18 9 12 15 6"/>
          </svg>
        </button>
        <button class="arrow-btn" @click="scrollRight">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="9 18 15 12 9 6"/>
          </svg>
        </button>
      </div>
    </div>
    <div ref="viewportEl" class="carousel-viewport">
      <div class="carousel-track" :style="{ transform: `translateX(${offset}px)` }">
        <div v-for="store in stores" :key="store.name" class="store-item">
          <div class="store-card">
            <img class="store-logo" :src="store.logo" :alt="store.name" />
          </div>
          <span class="store-name">{{ store.name }}</span>
          <span class="store-time">By: {{ store.time }}</span>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
.store-carousel {
  width: 71%;
  margin: 32px auto 0;
  font-family: var(--font-sans);
}

.carousel-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
}

.carousel-title {
  font-size: 26px;
  font-weight: 700;
  color: #222;
}

.carousel-arrows {
  display: flex;
  gap: 8px;
}

.arrow-btn {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 36px;
  height: 36px;
  border: 1px solid #ddd;
  background: #fff;
  border-radius: 50%;
  cursor: pointer;
  transition: background 0.15s;
}

.arrow-btn:hover {
  background: #f5f5f5;
}

.carousel-viewport {
  overflow: hidden;
}

.carousel-track {
  display: flex;
  gap: 16px;
  transition: transform 0.3s ease;
}

.store-item {
  display: flex;
  flex-direction: column;
  align-items: center;
  flex-shrink: 0;
  width: 140px;
}

.store-card {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 100%;
  padding: 20px 0;
  background: transparent;
  border: 1px solid #ccc;
  border-radius: 12px;
}

.store-logo {
  width: 52px;
  height: 52px;
  object-fit: contain;
}

.store-name {
  font-size: 15px;
  font-weight: 700;
  color: #000;
  text-align: center;
  line-height: 1.3;
  margin-top: 10px;
}

.store-time {
  font-size: 12px;
  font-weight: 300;
  color: #000;
  text-align: center;
  margin-top: 2px;
}
</style>
