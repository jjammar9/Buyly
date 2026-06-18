<script setup>
import { ref, computed, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { getOrders, createOrder } from '../api.js'
import { useCart } from '../stores/cart.js'
import { useToast } from '../stores/toast.js'
import NavBar from '../components/NavBar.vue'
import FooterSection from '../components/FooterSection.vue'

const route = useRoute()
const router = useRouter()
const { items, total, clear } = useCart()
const { show } = useToast()
const orders = ref([])
const address = ref({ line1: '', line2: '', city: '', state: '', zip: '', notes: '' })
const submitting = ref(false)
const done = ref(false)
const loading = ref(true)

const isOrdersPage = computed(() => route.name === 'orders')
const cartEmpty = computed(() => items.length === 0)

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
  if (isOrdersPage.value || items.length === 0) {
    orders.value = await getOrders()
  }
  loading.value = false
}

async function placeOrder() {
  submitting.value = true
  try {
    await createOrder({
      items: items.map(i => ({ product_id: i.id, quantity: i.qty })),
      address_line1: address.value.line1,
      address_line2: address.value.line2 || undefined,
      city: address.value.city,
      state: address.value.state,
      zip: address.value.zip,
      notes: address.value.notes || undefined,
    })
    clear()
    show('Order placed!')
    done.value = true
  } catch (e) {
    show(e.message || 'Failed to place order', 'error')
  } finally {
    submitting.value = false
  }
}
</script>

<template>
  <div>
    <NavBar />
    <div class="w-[71%] max-w-[1200px] mx-auto mt-8 mb-16">
      <button class="text-[14px] text-[#0a8a4a] no-underline mb-6 block cursor-pointer border-0 bg-transparent hover:underline" @click="router.back()">&larr; Back</button>

      <!-- Order history page -->
      <template v-if="isOrdersPage">
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
              </div>
            </div>
            <div class="flex gap-1 mb-3">
              <div v-for="s in ['confirmed', 'preparing', 'shipped', 'delivered']" :key="s" class="flex-1 flex flex-col items-center gap-1.5">
                <div class="w-full h-1 rounded-full" :class="statusIndex(order.status) >= statusIndex(s) ? 'bg-[#166534]' : 'bg-[#e0e0e0]'" />
                <span class="text-[10px] font-medium" :class="statusIndex(order.status) >= statusIndex(s) ? 'text-[#166534]' : 'text-[#bbb]'">{{ s.charAt(0).toUpperCase() + s.slice(1) }}</span>
              </div>
            </div>
            <div v-for="item in order.items" :key="item.id" class="flex items-center justify-between py-1.5 text-[14px]">
              <span class="text-[#555]">{{ item.product_name }} x{{ item.quantity }}</span>
              <span class="text-[#222] font-medium">${{ (item.price * item.quantity).toFixed(2) }}</span>
            </div>
            <div class="flex items-center justify-between pt-2 mt-2 border-t border-[#f0f0f0]">
              <span class="text-[13px] text-[#888] truncate max-w-[60%]">{{ order.address_line1 }}, {{ order.city }}, {{ order.state }} {{ order.zip }}</span>
              <span class="text-[16px] font-bold text-[#166534]">${{ order.total }}</span>
            </div>
          </div>
        </div>
      </template>

      <!-- Checkout page -->
      <template v-else>
        <h1 class="text-[28px] font-bold text-[#222] mb-6">Checkout</h1>

        <div v-if="cartEmpty" class="flex flex-col items-center justify-center py-16 text-center">
          <div class="w-20 h-20 rounded-full bg-[#f7f5f0] flex items-center justify-center mb-5">
            <svg width="34" height="34" viewBox="0 0 24 24" fill="#ccc"><path d="M7 18c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59L5.25 14H19v-2H7.42l.94-2H17c.5 0 .95-.28 1.16-.72l3.42-6.99c.14-.29.13-.63-.03-.92A1 1 0 0 0 20.76 2H5.21L4.27 0H1z"/></svg>
          </div>
          <h2 class="text-[20px] font-bold text-[#222] mb-2">Your cart is empty</h2>
          <p class="text-[14px] text-[#888] mb-6">Add some items before checking out.</p>
          <router-link to="/catalog" class="inline-flex items-center gap-2 h-11 px-5 bg-[#0a8a4a] text-white text-[14px] font-semibold rounded-lg no-underline hover:bg-[#097a42]">Browse products</router-link>
        </div>

        <div v-else-if="done" class="text-center py-16">
          <div class="text-[48px] mb-4">&#10003;</div>
          <h2 class="text-[24px] font-bold text-[#222] mb-2">Order placed!</h2>
          <p class="text-[#888] mb-6">Your order has been confirmed.</p>
          <router-link to="/orders" class="inline-block px-6 py-3 bg-[#0a8a4a] text-white rounded-lg no-underline text-[15px] font-semibold hover:bg-[#097a42]">View orders</router-link>
        </div>

        <div v-else class="flex gap-10 max-md:flex-col">
          <div class="flex-1">
            <h2 class="text-[18px] font-bold text-[#222] mb-4">Delivery address</h2>
            <div class="space-y-3">
              <input v-model="address.line1" placeholder="Address line 1" class="w-full h-12 px-4 border border-[#ddd] rounded-lg text-[15px] outline-none focus:border-[#0a8a4a]" />
              <input v-model="address.line2" placeholder="Address line 2 (optional)" class="w-full h-12 px-4 border border-[#ddd] rounded-lg text-[15px] outline-none focus:border-[#0a8a4a]" />
              <div class="flex gap-3">
                <input v-model="address.city" placeholder="City" class="flex-1 h-12 px-4 border border-[#ddd] rounded-lg text-[15px] outline-none focus:border-[#0a8a4a]" />
                <input v-model="address.state" placeholder="State" class="w-24 h-12 px-4 border border-[#ddd] rounded-lg text-[15px] outline-none focus:border-[#0a8a4a]" />
                <input v-model="address.zip" placeholder="ZIP" class="w-32 h-12 px-4 border border-[#ddd] rounded-lg text-[15px] outline-none focus:border-[#0a8a4a]" />
              </div>
              <textarea v-model="address.notes" placeholder="Delivery notes (optional)" class="w-full h-24 px-4 py-3 border border-[#ddd] rounded-lg text-[15px] outline-none focus:border-[#0a8a4a] resize-none"></textarea>
            </div>
          </div>

          <div class="w-[360px] max-md:w-full">
            <h2 class="text-[18px] font-bold text-[#222] mb-4">Order summary</h2>
            <div class="border border-[#e0e0e0] rounded-xl p-5">
              <div v-for="item in items" :key="item.id" class="flex items-center justify-between py-2 border-b border-[#f0f0f0] last:border-0">
                <div class="flex-1">
                  <div class="text-[14px] font-medium text-[#222]">{{ item.name }}</div>
                  <div class="text-[12px] text-[#888]">{{ item.qty }} x ${{ item.price }}</div>
                </div>
                <div class="text-[14px] font-bold text-[#222]">${{ (item.qty * item.price).toFixed(2) }}</div>
              </div>
              <div class="flex items-center justify-between pt-3 mt-2 border-t border-[#e0e0e0]">
                <span class="text-[16px] font-bold text-[#222]">Total</span>
                <span class="text-[20px] font-bold text-[#166534]">${{ total.toFixed(2) }}</span>
              </div>
              <button
                class="w-full mt-5 h-12 bg-[#0a8a4a] text-white text-[16px] font-semibold rounded-lg border-0 cursor-pointer hover:bg-[#097a42] disabled:opacity-40"
                :disabled="submitting || !address.line1 || !address.city || !address.state || !address.zip"
                @click="placeOrder"
              >{{ submitting ? 'Placing order...' : 'Place order' }}</button>
            </div>
          </div>
        </div>
      </template>
    </div>
    <FooterSection />
  </div>
</template>
