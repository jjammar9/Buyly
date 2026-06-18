<script setup>
import { ref, computed, watch, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { getProducts, getCategories } from '../api.js'
import { useCart } from '../stores/cart.js'
import { useToast } from '../stores/toast.js'
import NavBar from '../components/NavBar.vue'
import FooterSection from '../components/FooterSection.vue'

const route = useRoute()
const router = useRouter()
const { add: addToCart } = useCart()
const { show } = useToast()

const products = ref([])
const categories = ref([])
const totalPages = ref(1)
const currentPage = ref(1)
const searchQuery = ref(route.query.search || '')
const selectedCategory = ref(route.params.category || '')
const loading = ref(false)
const error = ref('')

const sortBy = ref(route.query.sort || 'newest')

async function loadProducts() {
  loading.value = true
  error.value = ''
  try {
    const params = { page: currentPage.value, per_page: 20, sort: sortBy.value }
    if (selectedCategory.value) params.category = selectedCategory.value
    if (searchQuery.value) params.search = searchQuery.value
    const data = await getProducts(params)
    products.value = data.data
    totalPages.value = data.last_page
  } catch (e) {
    error.value = e.message || 'Failed to load products'
  }
  loading.value = false
}

function selectCategory(slug) {
  selectedCategory.value = slug
  currentPage.value = 1
  searchQuery.value = ''
  if (slug) router.push({ name: 'catalog-category', params: { category: slug } })
  else router.push({ name: 'catalog' })
  loadProducts()
}

function search() {
  currentPage.value = 1
  router.push({ path: '/catalog', query: searchQuery.value ? { search: searchQuery.value } : {} })
  loadProducts()
}

watch(() => route.params.category, (slug) => {
  selectedCategory.value = slug || ''
  loadProducts()
})

watch(() => route.query.search, (q) => {
  searchQuery.value = q || ''
  loadProducts()
})

onMounted(async () => {
  try {
    categories.value = await getCategories()
  } catch {}
  loadProducts()
})
</script>

<template>
  <div>
    <NavBar />
    <div class="w-[90%] max-w-[1200px] mx-auto mt-8 mb-16 max-md:w-[95%]">
      <div class="flex items-center gap-4 mb-6 max-md:flex-col max-md:gap-3">
        <input
          v-model="searchQuery"
          placeholder="Search products..."
          class="flex-1 h-12 px-4 border border-[#ddd] rounded-lg text-[15px] outline-none focus:border-[#0a8a4a] max-md:w-full"
          @keyup.enter="search"
        />
        <div class="flex items-center gap-3 max-md:w-full max-md:justify-between">
          <button class="h-12 px-6 bg-[#0a8a4a] text-white text-[15px] font-semibold rounded-lg border-0 cursor-pointer hover:bg-[#097a42]" @click="search">Search</button>
          <div class="relative">
            <select v-model="sortBy" @change="loadProducts" class="h-12 px-4 pr-10 border border-[#ddd] rounded-lg text-[14px] text-[#444] bg-white outline-none focus:border-[#0a8a4a] appearance-none cursor-pointer">
              <option value="newest">Newest</option>
              <option value="price_asc">Price: Low to High</option>
              <option value="price_desc">Price: High to Low</option>
              <option value="name_asc">Name: A-Z</option>
              <option value="name_desc">Name: Z-A</option>
            </select>
            <svg class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none w-4 h-4 text-[#888]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
          </div>
        </div>
      </div>

      <div class="flex gap-2 mb-8 flex-wrap max-md:gap-1.5">
        <button
          class="px-4 py-2 rounded-full text-[14px] font-medium border border-[#ddd] cursor-pointer hover:bg-[#166534] hover:text-white max-md:text-[12px] max-md:px-3 max-md:py-1.5"
          :class="!selectedCategory ? 'bg-[#166534] text-white border-[#166534]' : 'bg-white text-[#222]'"
          @click="selectCategory('')"
        >All</button>
        <button
          v-for="cat in categories"
          :key="cat.id"
          class="px-4 py-2 rounded-full text-[14px] font-medium border border-[#ddd] cursor-pointer hover:bg-[#166534] hover:text-white max-md:text-[12px] max-md:px-3 max-md:py-1.5"
          :class="selectedCategory === cat.slug ? 'bg-[#166534] text-white border-[#166534]' : 'bg-white text-[#222]'"
          @click="selectCategory(cat.slug)"
        >{{ cat.name }}</button>
      </div>

      <div v-if="loading" class="grid grid-cols-4 gap-5 max-lg:grid-cols-3 max-md:grid-cols-2 max-sm:grid-cols-1">
        <div v-for="i in 8" :key="i" class="border border-[#e0e0e0] rounded-xl p-4 bg-white flex flex-col">
          <div class="h-[160px] bg-[#f0f0f0] rounded-lg mb-3 animate-pulse" />
          <div class="h-3 bg-[#f0f0f0] rounded w-1/3 mb-2 animate-pulse" />
          <div class="h-4 bg-[#f0f0f0] rounded w-3/4 mb-2 animate-pulse" />
          <div class="h-3 bg-[#f0f0f0] rounded w-1/4 mb-3 animate-pulse" />
          <div class="flex items-center justify-between mt-auto">
            <div class="h-5 bg-[#f0f0f0] rounded w-1/4 animate-pulse" />
            <div class="w-9 h-9 rounded-full bg-[#f0f0f0] animate-pulse" />
          </div>
        </div>
      </div>

      <div v-else-if="error" class="text-center py-16 text-[#c00]">{{ error }}</div>
      <div v-else-if="products.length === 0" class="flex flex-col items-center justify-center py-20 text-center">
        <div class="w-20 h-20 rounded-full bg-[#f7f5f0] flex items-center justify-center mb-5">
          <svg width="34" height="34" viewBox="0 0 24 24" fill="#ccc"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        </div>
        <h2 class="text-[20px] font-bold text-[#222] mb-2">No products found</h2>
        <p class="text-[14px] text-[#888] mb-6 max-w-[360px]">Try adjusting your search or filter to find what you're looking for.</p>
        <button class="h-11 px-5 bg-[#166534] text-white text-[14px] font-semibold rounded-lg border-0 cursor-pointer hover:bg-[#0f4a25]" @click="selectCategory(''); searchQuery = ''; search()">Clear filters</button>
      </div>

      <div v-else class="grid grid-cols-4 gap-5 max-lg:grid-cols-3 max-md:grid-cols-2 max-sm:grid-cols-1">
        <div v-for="p in products" :key="p.id" class="border border-[#e0e0e0] rounded-xl p-4 bg-white flex flex-col cursor-pointer hover:shadow-md transition-shadow" @click="router.push(`/product/${p.slug}`)">
          <div class="h-[160px] bg-[#f5f5f5] rounded-lg mb-3 flex items-center justify-center text-[40px] text-[#ccc]">
            <svg v-if="!p.image" width="48" height="48" viewBox="0 0 24 24" fill="#ddd"><path d="M3 3h18v18H3z"/></svg>
            <img v-else :src="p.image" :alt="p.name" loading="lazy" class="max-w-full max-h-full object-contain" />
          </div>
          <div class="text-[13px] text-[#888] font-medium mb-1">{{ p.category?.name }}</div>
          <div class="text-[16px] font-bold text-[#222] mb-1 leading-tight">{{ p.name }}</div>
          <div class="text-[13px] text-[#888] mb-2">{{ p.unit }}</div>
          <div class="mt-auto flex items-center justify-between">
            <div>
              <span v-if="p.sale_price" class="text-[18px] font-bold text-[#166534]">${{ p.sale_price }}</span>
              <span :class="p.sale_price ? 'text-[13px] text-[#888] line-through ml-1' : 'text-[18px] font-bold text-[#222]'">${{ p.price }}</span>
            </div>
            <button class="w-9 h-9 rounded-full bg-[#0a8a4a] text-white border-0 cursor-pointer flex items-center justify-center hover:bg-[#097a42]" @click.stop="addToCart(p); show(`${p.name} added to cart`)">+</button>
          </div>
        </div>
      </div>

      <div v-if="totalPages > 1" class="flex justify-center gap-2 mt-8 max-md:gap-1">
        <button
          :disabled="currentPage <= 1"
          class="px-4 py-2 border border-[#ddd] rounded-lg bg-white text-[14px] cursor-pointer disabled:opacity-30 max-md:text-[12px] max-md:px-3"
          @click="currentPage--; loadProducts()"
        >Prev</button>
        <span class="px-4 py-2 text-[14px] text-[#888] max-md:text-[12px]">Page {{ currentPage }} of {{ totalPages }}</span>
        <button
          :disabled="currentPage >= totalPages"
          class="px-4 py-2 border border-[#ddd] rounded-lg bg-white text-[14px] cursor-pointer disabled:opacity-30 max-md:text-[12px] max-md:px-3"
          @click="currentPage++; loadProducts()"
        >Next</button>
      </div>
    </div>
    <FooterSection />
  </div>
</template>
