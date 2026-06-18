<script setup>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { getOrders, progressOrder } from '../api.js'
import { useToast } from '../stores/toast.js'
import { useMeta } from '../composables/useMeta.js'
import NavBar from '../components/NavBar.vue'
import FooterSection from '../components/FooterSection.vue'

useMeta('Order History')

const router = useRouter()
const { show } = useToast()
const orders = ref([])
const loading = ref(true)

const statusMap = { confirmed: 0, preparing: 1, shipped: 2, delivered: 3 }

function statusIndex(s) { return statusMap[s] ?? -1 }

function statusClass(s) {
  return s === 'delivered' ? 'bg-[#e8f5e9] text-[#166534]'
    : s === 'shipped' ? 'bg-[#e3f2fd] text-[#1565c0]'
    : s === 'preparing' ? 'bg-[#fff3e0] text-[#e65100]'
    : 'bg-[#f3e5f5] text-[#7b1fa2]'
}

onMounted(load)

async function load() {
  loading.value = true
  try {
    orders.value = await getOrders()
  } catch (e) {
    show(e.message || 'Failed to load orders', 'error')
  }
  loading.value = false
}

async function advanceOrder(order) {
  try {
    const updated = await progressOrder(order.id)
    const idx = orders.value.findIndex(o => o.id === order.id)
    if (idx !== -1) orders.value[idx] = updated
    show(`Order status: ${updated.status}`)
  } catch (e) {
    show(e.message || 'Cannot progress further', 'error')
  }
}
</script>

<template>
  <div>
    <NavBar />
    <div class="w-[71%] max-w-[1200px] mx-auto mt-8 mb-16">
      <button class="text-[14px] text-[#0a8a4a] no-underline mb-6 block cursor-pointer border-0 bg-transparent hover:underline" @click="router.back()">&larr; Back</button>
      <h1 class="text-[28px] font-bold text-[#222] mb-6">Order history</h1>

      <div v-if="loading" class="space-y-4">
        <div v-for="i in 3" :key="i" class="h-32 bg-[#f0f0f0] rounded-xl animate-pulse" />
      </div>

      <div v-else-if="orders.length === 0" class="flex flex-col items-center justify-center py-16 text-center">
        <div class="w-20 h-20 rounded-full bg-[#f7f5f0] flex items-center justify-center mb-5">
          <svg width="34" height="34" viewBox="0 0 24 24" fill="#ccc"><path d="M3 3h18v18H3z"/><polyline points="3 9 12 15 21 9"/></svg>
        </div>
        <h2 class="text-[20px] font-bold text-[#222] mb-2">No orders yet</h2>
        <p class="text-[14px] text-[#888] mb-6">Place your first order and it will appear here.</p>
        <router-link to="/catalog" class="inline-flex items-center gap-2 h-11 px-5 bg-[#0a8a4a] text-white text-[14px] font-semibold rounded-lg no-underline hover:bg-[#097a42]">Start shopping</router-link>
      </div>

      <div v-else>
        <div v-for="order in orders" :key="order.id" class="border border-[#e0e0e0] rounded-xl p-5 mb-4 bg-white">
          <div class="flex items-center justify-between mb-3">
            <div class="flex items-center gap-3">
              <span class="text-[13px] text-[#888]">Order #{{ order.id }}</span>
              <span class="text-[#ccc]">|</span>
              <span class="text-[13px] text-[#888]">{{ new Date(order.created_at).toLocaleDateString() }}</span>
            </div>
            <div class="flex items-center gap-3">
              <span v-if="order.delivery_eta" class="text-[12px] text-[#888]">ETA {{ new Date(order.delivery_eta).toLocaleTimeString([], { hour: 'numeric', minute: '2-digit' }) }}</span>
              <span class="text-[12px] font-semibold uppercase px-2.5 py-1 rounded-full" :class="statusClass(order.status)">{{ order.status }}</span>
              <button v-if="order.status !== 'delivered'" class="text-[11px] text-[#0a8a4a] bg-transparent border border-[#0a8a4a] rounded-full px-2.5 py-0.5 cursor-pointer hover:bg-[#0a8a4a] hover:text-white transition-colors" @click="advanceOrder(order)">Simulate &rarr;</button>
            </div>
          </div>
          <div class="flex gap-1 mb-3">
            <div v-for="s in ['confirmed', 'preparing', 'shipped', 'delivered']" :key="s" class="flex-1 flex flex-col items-center gap-1.5">
              <div class="w-full h-1.5 rounded-full" :class="statusIndex(order.status) >= statusIndex(s) ? 'bg-[#166534]' : 'bg-[#e0e0e0]'" />
              <span class="text-[10px] font-medium" :class="statusIndex(order.status) >= statusIndex(s) ? 'text-[#166534]' : 'text-[#bbb]'">{{ s.charAt(0).toUpperCase() + s.slice(1) }}</span>
            </div>
          </div>
          <div class="text-[12px] text-[#888] mb-3 text-center">Placed {{ new Date(order.created_at).toLocaleTimeString([], { hour: 'numeric', minute: '2-digit' }) }} &middot; ETA {{ order.delivery_eta ? new Date(order.delivery_eta).toLocaleTimeString([], { hour: 'numeric', minute: '2-digit' }) : 'Calculating...' }}</div>
          <div v-for="item in order.items" :key="item.id" class="flex items-center gap-3 py-2 text-[14px]">
            <div class="w-9 h-9 rounded-lg overflow-hidden bg-[#f5f5f5] shrink-0">
              <img :src="item.product_image" :alt="item.product_name" class="w-full h-full object-cover" />
            </div>
            <span class="flex-1 text-[#555] truncate">{{ item.product_name }} <span class="text-[#888]">x{{ item.quantity }}</span></span>
            <span class="text-[#222] font-medium shrink-0">${{ (item.price * item.quantity).toFixed(2) }}</span>
          </div>
          <div class="flex items-center justify-between pt-2 mt-2 border-t border-[#f0f0f0]">
            <span class="text-[13px] text-[#888] truncate max-w-[60%]">{{ order.address_line1 }}, {{ order.city }}, {{ order.state }} {{ order.zip }}</span>
            <span class="text-[16px] font-bold text-[#166534]">${{ order.total }}</span>
          </div>
        </div>
      </div>
    </div>
    <FooterSection />
  </div>
</template>
