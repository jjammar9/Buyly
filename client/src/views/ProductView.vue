<script setup>
import { ref, computed, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { getProduct, getProducts } from '../api.js'
import { useCart } from '../stores/cart.js'
import { useToast } from '../stores/toast.js'
import NavBar from '../components/NavBar.vue'
import FooterSection from '../components/FooterSection.vue'

const route = useRoute()
const router = useRouter()
const { add: addToCart } = useCart()
const { show } = useToast()

const product = ref(null)
const related = ref([])
const loading = ref(true)
const added = ref(false)
const qty = ref(1)
const error = ref('')

onMounted(load)

async function load() {
  loading.value = true
  error.value = ''
  try {
    product.value = await getProduct(route.params.slug)
    const params = { per_page: 5 }
    if (product.value.category?.slug) params.category = product.value.category.slug
    const data = await getProducts(params)
    related.value = data.data.filter(p => p.id !== product.value.id).slice(0, 4)
  } catch (e) {
    error.value = e.message || 'Failed to load product'
  }
  loading.value = false
}

function add() {
  addToCart(product.value)
  show(`${product.value.name} added to cart`)
  added.value = true
  setTimeout(() => { added.value = false }, 2000)
}
</script>

<template>
  <div>
    <NavBar />
    <div class="w-[71%] max-w-[1200px] mx-auto mt-8 mb-16">
      <button class="text-[14px] text-[#0a8a4a] no-underline mb-6 block cursor-pointer border-0 bg-transparent hover:underline" @click="router.back()">&larr; Back</button>

      <div v-if="loading" class="flex gap-10">
        <div class="w-1/2 h-[400px] bg-[#f0f0f0] rounded-xl animate-pulse" />
        <div class="w-1/2 space-y-4">
          <div class="h-4 bg-[#f0f0f0] rounded w-1/4 animate-pulse" />
          <div class="h-8 bg-[#f0f0f0] rounded w-3/4 animate-pulse" />
          <div class="h-4 bg-[#f0f0f0] rounded w-1/3 animate-pulse" />
          <div class="h-24 bg-[#f0f0f0] rounded animate-pulse" />
        </div>
      </div>

      <div v-else-if="error" class="text-center py-20 text-[#c00]">{{ error }}</div>
      <div v-else-if="product" class="flex gap-10 max-md:flex-col">
        <div class="w-1/2 max-md:w-full">
          <img :src="product.image" :alt="product.name" class="w-full h-[400px] object-contain bg-[#f9f9f9] rounded-xl" />
        </div>
        <div class="w-1/2 max-md:w-full flex flex-col justify-center">
          <div class="text-[13px] text-[#888] font-medium mb-2">{{ product.category?.name }}</div>
          <h1 class="text-[32px] font-bold text-[#222] mb-2">{{ product.name }}</h1>
          <div class="text-[14px] text-[#888] mb-4">{{ product.unit }}</div>
          <div class="flex items-center gap-3 mb-6">
            <span v-if="product.sale_price" class="text-[28px] font-bold text-[#166534]">${{ product.sale_price }}</span>
            <span :class="product.sale_price ? 'text-[18px] text-[#888] line-through' : 'text-[28px] font-bold text-[#222]'">${{ product.price }}</span>
          </div>
          <p v-if="product.description" class="text-[15px] text-[#444] leading-relaxed mb-6">{{ product.description }}</p>

          <div class="flex items-center gap-4 mb-6">
            <div class="flex items-center border border-[#ddd] rounded-lg">
              <button class="w-10 h-10 border-0 bg-transparent text-[20px] cursor-pointer hover:bg-[#f5f5f5] rounded-l-lg" @click="qty = Math.max(1, qty - 1)">-</button>
              <span class="w-12 text-center text-[16px] font-medium">{{ qty }}</span>
              <button class="w-10 h-10 border-0 bg-transparent text-[20px] cursor-pointer hover:bg-[#f5f5f5] rounded-r-lg" @click="qty++">+</button>
            </div>
            <button class="h-10 px-8 bg-[#0a8a4a] text-white text-[15px] font-semibold rounded-lg border-0 cursor-pointer hover:bg-[#097a42] flex items-center gap-2" @click="add">
              {{ added ? 'Added!' : 'Add to cart' }}
            </button>
          </div>
        </div>
      </div>

      <div v-if="related.length" class="mt-14">
        <h2 class="text-[22px] font-bold text-[#222] mb-5">Related products</h2>
        <div class="grid grid-cols-4 gap-5 max-lg:grid-cols-3 max-md:grid-cols-2 max-sm:grid-cols-1">
          <div v-for="p in related" :key="p.id" class="border border-[#e0e0e0] rounded-xl p-4 bg-white flex flex-col cursor-pointer hover:shadow-md transition-shadow" @click="router.push(`/product/${p.slug}`)">
            <div class="h-[140px] bg-[#f5f5f5] rounded-lg mb-3 flex items-center justify-center">
              <img :src="p.image" :alt="p.name" class="max-w-full max-h-full object-contain" />
            </div>
            <div class="text-[13px] text-[#888] font-medium mb-1">{{ p.category?.name }}</div>
            <div class="text-[15px] font-bold text-[#222] mb-1 leading-tight">{{ p.name }}</div>
            <div class="text-[13px] text-[#888] mb-2">{{ p.unit }}</div>
            <div class="mt-auto flex items-center justify-between">
              <div>
                <span v-if="p.sale_price" class="text-[16px] font-bold text-[#166534]">${{ p.sale_price }}</span>
                <span :class="p.sale_price ? 'text-[12px] text-[#888] line-through ml-1' : 'text-[16px] font-bold text-[#222]'">${{ p.price }}</span>
              </div>
              <button class="w-8 h-8 rounded-full bg-[#0a8a4a] text-white border-0 cursor-pointer flex items-center justify-center text-[14px] hover:bg-[#097a42]" @click.stop="addToCart(p)">+</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <FooterSection />
  </div>
</template>
