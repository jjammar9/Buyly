<script setup>
import { ref, computed, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { createOrder } from '../api.js'
import { useCart } from '../stores/cart.js'
import { useToast } from '../stores/toast.js'
import { useMeta } from '../composables/useMeta.js'
import NavBar from '../components/NavBar.vue'
import FooterSection from '../components/FooterSection.vue'

useMeta('Checkout')

const router = useRouter()
const { items, total, clear } = useCart()
const { show } = useToast()
const address = ref({ line1: '', line2: '', city: '', state: '', zip: '', notes: '' })
const submitting = ref(false)
const done = ref(false)

const cartEmpty = computed(() => items.length === 0)

async function placeOrder() {
  if (!address.value.line1.trim() || !address.value.city.trim() || !address.value.state.trim() || !address.value.zip.trim()) {
    show('Please fill in all required address fields', 'error')
    return
  }
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

      <h1 class="text-[28px] font-bold text-[#222] mb-6">Checkout</h1>

      <div v-if="cartEmpty" class="flex flex-col items-center justify-center py-16 text-center">
        <div class="w-20 h-20 rounded-full bg-[#f7f5f0] flex items-center justify-center mb-5">
          <svg width="34" height="34" viewBox="0 0 24 24" fill="#ccc"><path d="M7 18c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59L5.25 14H19v-2H7.42l.94-2H17c.5 0 .95-.28 1.16-.72l3.42-6.99c.14-.29.13-.63-.03-.92A1 1 0 0 0 20.76 2H5.21L4.27 0H1z"/></svg>
        </div>
        <h2 class="text-[20px] font-bold text-[#222] mb-2">Your cart is empty</h2>
        <p class="text-[14px] text-[#888] mb-6">Add some items before checking out.</p>
        <router-link to="/catalog" class="inline-flex items-center gap-2 h-11 px-5 bg-[#0a8a4a] text-white text-[14px] font-semibold rounded-lg no-underline hover:bg-[#097a42]">Browse products</router-link>
      </div>

      <div v-else-if="done" class="max-w-[480px] mx-auto text-center py-12">
        <div class="w-16 h-16 rounded-full bg-[#e8f5e9] flex items-center justify-center mx-auto mb-5">
          <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#166534" stroke-width="2.5" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg>
        </div>
        <h2 class="text-[26px] font-bold text-[#222] mb-2">Order confirmed!</h2>
        <p class="text-[14px] text-[#555] mb-2">Your order will be delivered to <strong>{{ address.line1 }}, {{ address.city }}, {{ address.state }} {{ address.zip }}</strong></p>
        <p class="text-[14px] text-[#555] mb-2">Estimated delivery: <strong>within 1–4 hours</strong></p>
        <p class="text-[13px] text-[#888] mb-6">You can track your order status in real time.</p>
        <router-link to="/orders" class="inline-flex items-center gap-2 h-12 px-6 bg-[#0a8a4a] text-white text-[15px] font-semibold rounded-lg no-underline hover:bg-[#097a42] transition-colors">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
          Track order
        </router-link>
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
            <div v-for="item in items" :key="item.id" class="flex items-center gap-3 py-2.5 border-b border-[#f0f0f0] last:border-0">
              <div class="w-10 h-10 rounded-lg overflow-hidden bg-[#f5f5f5] shrink-0">
                <img :src="item.image" :alt="item.name" class="w-full h-full object-cover" />
              </div>
              <div class="flex-1 min-w-0">
                <div class="text-[14px] font-medium text-[#222] truncate">{{ item.name }}</div>
                <div class="text-[12px] text-[#888]">{{ item.qty }} x ${{ item.price }}</div>
              </div>
              <div class="text-[14px] font-bold text-[#222] shrink-0">${{ (item.qty * item.price).toFixed(2) }}</div>
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
    </div>
    <FooterSection />
  </div>
</template>
