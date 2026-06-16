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
  <section class="carousel-section">
    <div class="carousel-top">
      <div>
        <h2 class="carousel-heading">Stores to help you save</h2>
        <p class="carousel-subtitle">Offers subject to terms and eligibility</p>
      </div>
      <div class="carousel-arrows">
        <button
          :disabled="currentPage === 0"
          class="arrow-btn"
          @click="scrollLeft"
        >
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="15 18 9 12 15 6"/>
          </svg>
        </button>
        <button
          :disabled="currentPage >= totalPages - 1"
          class="arrow-btn"
          @click="scrollRight"
        >
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="9 18 15 12 9 6"/>
          </svg>
        </button>
      </div>
    </div>
    <div ref="viewportEl" class="carousel-viewport">
      <div class="carousel-track" :style="{ transform: `translateX(${offset}px)` }">
        <div
          v-for="(logo, i) in allLogos"
          :key="i"
          class="carousel-item"
        >
          <div class="carousel-card">
            <div v-if="i % 5 === 0 || i % 7 === 0" class="star-badge">
              <svg viewBox="0 0 56 64" class="star-svg">
                <path d="m25.36 58.016-6.14 4.569-.6-7.687-7.18 2.634 1.566-7.561-7.628.498 3.602-6.803-7.438-1.695 5.355-5.49-6.678-3.762 6.678-3.762-5.359-5.49 7.442-1.695-3.602-6.803 7.628.498-1.567-7.562 7.184 2.634.596-7.686 6.14 4.569L28.092.219l4.628 6.152L37.344.219l2.731 7.203 6.14-4.57.6 7.687L54 7.905l-1.567 7.562 7.625-.498-3.602 6.803 7.442 1.694-5.359 5.491 6.681 3.762-6.68 3.761 5.358 5.491-7.442 1.695 3.602 6.803-7.625-.498 1.564 7.561-7.18-2.634-.6 7.687-6.14-4.57-2.732 7.204-4.625-6.152-4.628 6.152z" fill="#FFCC00" stroke="#fff" stroke-width="2.5" stroke-linejoin="round" />
              </svg>
              <span class="star-text">15%<br/>OFF</span>
            </div>
            <img
              :src="logo"
              :alt="'Store ' + (i + 1)"
              class="carousel-logo"
            />
          </div>
          <span class="carousel-name">Store {{ i + 1 }}</span>
          <span class="carousel-time">By {{ times[i] }}</span>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
.carousel-section {
  width: 71%;
  margin: 32px auto 0;
  font-family: DM Sans, sans-serif;
}

.carousel-top {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
}

.carousel-heading {
  margin: 0;
  font-size: 26px;
  font-weight: 700;
  color: #222;
}

.carousel-subtitle {
  margin: 4px 0 0 0;
  font-size: 13px;
  color: #888;
}

.carousel-arrows {
  display: flex;
  gap: 8px;
  margin-top: 4px;
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

.arrow-btn:disabled {
  opacity: 0.3;
  cursor: default;
}

.carousel-viewport {
  overflow: hidden;
  padding-top: 20px;
}

.carousel-track {
  display: flex;
  gap: 12px;
  transition: transform 0.3s ease-in-out;
}

.carousel-item {
  flex-shrink: 0;
  width: 120px;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.carousel-card {
  position: relative;
  width: 120px;
  height: 90px;
  display: flex;
  align-items: center;
  justify-content: center;
  border: 1px solid rgba(0, 0, 0, 0.12);
  border-radius: 8px;
  background: #fff;
  padding: 10px;
}

.carousel-name {
  font-size: 13px;
  font-weight: 700;
  color: #222;
  text-align: center;
  margin-top: 6px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  max-width: 100%;
}

.carousel-time {
  font-size: 11px;
  font-weight: 300;
  color: #1a1a1a;
  text-align: center;
  margin-top: 4px;
  background: #FFCC00;
  padding: 1px 8px;
  border-radius: 4px;
  display: inline-block;
}

.star-badge {
  position: absolute;
  top: -20px;
  right: -8px;
  width: 56px;
  height: 56px;
  transform: rotate(-12deg);
  z-index: 1;
  filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
  display: flex;
  align-items: center;
  justify-content: center;
}

.star-svg {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  display: block;
  pointer-events: none;
}

.star-text {
  position: relative;
  font-size: 9px;
  font-weight: 900;
  color: #1a1a1a;
  line-height: 1.1;
  text-align: center;
  z-index: 1;
  transform: translateX(1.5px);
}

.carousel-logo {
  max-width: 100%;
  max-height: 100%;
  object-fit: contain;
}
</style>
