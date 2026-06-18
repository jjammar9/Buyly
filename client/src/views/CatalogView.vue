<script setup>
import { ref, computed, watch, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { getProducts, getCategories } from '../api.js'
import { useCart } from '../stores/cart.js'
import NavBar from '../components/NavBar.vue'
import FooterSection from '../components/FooterSection.vue'

const route = useRoute()
const router = useRouter()
const { add: addToCart } = useCart()

const products = ref([])
const categories = ref([])
const totalPages = ref(1)
const currentPage = ref(1)
const searchQuery = ref(route.query.search || '')
const selectedCategory = ref(route.params.category || '')
const loading = ref(false)

async function loadProducts() {
  loading.value = true
  const params = { page: currentPage.value, per_page: 20 }
  if (selectedCategory.value) params.category = selectedCategory.value
  if (searchQuery.value) params.search = searchQuery.value
  const data = await getProducts(params)
  products.value = data.data
  totalPages.value = data.last_page
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
  categories.value = await getCategories()
  loadProducts()
})
</script>

<template>
  <div>
    <NavBar />
    <div class="w-[71%] max-w-[1200px] mx-auto mt-8 mb-16">
      <div class="flex items-center gap-4 mb-6">
        <input
          v-model="searchQuery"
          placeholder="Search products..."
          class="flex-1 h-12 px-4 border border-[#ddd] rounded-lg text-[15px] outline-none focus:border-[#0a8a4a]"
          @keyup.enter="search"
        />
        <button class="h-12 px-6 bg-[#0a8a4a] text-white text-[15px] font-semibold rounded-lg border-0 cursor-pointer hover:bg-[#097a42]" @click="search">Search</button>
      </div>

      <div class="flex gap-2 mb-8 flex-wrap">
        <button
          class="px-4 py-2 rounded-full text-[14px] font-medium border border-[#ddd] cursor-pointer hover:bg-[#166534] hover:text-white"
          :class="!selectedCategory ? 'bg-[#166534] text-white border-[#166534]' : 'bg-white text-[#222]'"
          @click="selectCategory('')"
        >All</button>
        <button
          v-for="cat in categories"
          :key="cat.id"
          class="px-4 py-2 rounded-full text-[14px] font-medium border border-[#ddd] cursor-pointer hover:bg-[#166534] hover:text-white"
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

      <div v-else-if="products.length === 0" class="text-center text-[#888] py-16 text-[16px]">
        No products found.
      </div>

      <div v-else class="grid grid-cols-4 gap-5 max-lg:grid-cols-3 max-md:grid-cols-2 max-sm:grid-cols-1">
        <div v-for="p in products" :key="p.id" class="border border-[#e0e0e0] rounded-xl p-4 bg-white flex flex-col cursor-pointer hover:shadow-md transition-shadow" @click="router.push(`/product/${p.slug}`)">
          <div class="h-[160px] bg-[#f5f5f5] rounded-lg mb-3 flex items-center justify-center text-[40px] text-[#ccc]">
            <svg v-if="!p.image" width="48" height="48" viewBox="0 0 24 24" fill="#ddd"><path d="M3 3h18v18H3z"/></svg>
            <img v-else :src="p.image" :alt="p.name" class="max-w-full max-h-full object-contain" />
          </div>
          <div class="text-[13px] text-[#888] font-medium mb-1">{{ p.category?.name }}</div>
          <div class="text-[16px] font-bold text-[#222] mb-1 leading-tight">{{ p.name }}</div>
          <div class="text-[13px] text-[#888] mb-2">{{ p.unit }}</div>
          <div class="mt-auto flex items-center justify-between">
            <div>
              <span v-if="p.sale_price" class="text-[18px] font-bold text-[#166534]">${{ p.sale_price }}</span>
              <span :class="p.sale_price ? 'text-[13px] text-[#888] line-through ml-1' : 'text-[18px] font-bold text-[#222]'">${{ p.price }}</span>
            </div>
            <button class="w-9 h-9 rounded-full bg-[#0a8a4a] text-white border-0 cursor-pointer flex items-center justify-center hover:bg-[#097a42]" @click.stop="addToCart(p)">+</button>
          </div>
        </div>
      </div>

      <div v-if="totalPages > 1" class="flex justify-center gap-2 mt-8">
        <button
          :disabled="currentPage <= 1"
          class="px-4 py-2 border border-[#ddd] rounded-lg bg-white text-[14px] cursor-pointer disabled:opacity-30"
          @click="currentPage--; loadProducts()"
        >Prev</button>
        <span class="px-4 py-2 text-[14px] text-[#888]">Page {{ currentPage }} of {{ totalPages }}</span>
        <button
          :disabled="currentPage >= totalPages"
          class="px-4 py-2 border border-[#ddd] rounded-lg bg-white text-[14px] cursor-pointer disabled:opacity-30"
          @click="currentPage++; loadProducts()"
        >Next</button>
      </div>
    </div>
    <FooterSection />
  </div>
</template>
