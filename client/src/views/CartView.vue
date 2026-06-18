<script setup>
import { useCart } from '../stores/cart.js'
import { useToast } from '../stores/toast.js'
import NavBar from '../components/NavBar.vue'
import FooterSection from '../components/FooterSection.vue'

const { items, remove, updateQty, total, clear } = useCart()
const { show } = useToast()
</script>

<template>
  <div>
    <NavBar />
    <div class="w-[90%] max-w-[1200px] mx-auto mt-8 mb-16 max-md:w-[95%]">
      <h1 class="text-[28px] font-bold text-[#222] mb-8 max-md:text-[22px]">Cart</h1>
      <div v-if="items.length === 0" class="flex flex-col items-center justify-center py-20 text-center">
        <div class="w-24 h-24 rounded-full bg-[#f7f5f0] flex items-center justify-center mb-6">
          <svg width="40" height="40" viewBox="0 0 24 24" fill="#ccc"><path d="M7 18c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59L5.25 14H19v-2H7.42l.94-2H17c.5 0 .95-.28 1.16-.72l3.42-6.99c.14-.29.13-.63-.03-.92A1 1 0 0 0 20.76 2H5.21L4.27 0H1z"/></svg>
        </div>
        <h2 class="text-[22px] font-bold text-[#222] mb-2">Your cart is empty</h2>
        <p class="text-[14px] text-[#888] mb-6 max-w-[360px]">Looks like you haven't added anything yet. Browse our catalog to find fresh groceries.</p>
        <router-link to="/catalog" class="inline-flex items-center gap-2 h-12 px-6 bg-[#0a8a4a] text-white text-[15px] font-semibold rounded-lg no-underline hover:bg-[#097a42] transition-colors">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
          Start shopping
        </router-link>
      </div>
      <div v-else>
        <div v-for="item in items" :key="item.id" class="flex items-center gap-4 py-4 border-b border-[#eee] max-md:flex-wrap max-md:gap-2">
          <div class="flex-1 min-w-0 max-md:w-full">
            <div class="text-[16px] font-bold text-[#222]">{{ item.name }}</div>
            <div class="text-[13px] text-[#888]">{{ item.unit }}</div>
          </div>
          <div class="flex items-center gap-3">
            <button class="w-8 h-8 rounded-full border border-[#ddd] bg-white text-[16px] cursor-pointer flex items-center justify-center" @click="item.qty === 1 ? remove(item.id) : updateQty(item.id, item.qty - 1)">-</button>
            <span class="text-[15px] font-semibold w-6 text-center">{{ item.qty }}</span>
            <button class="w-8 h-8 rounded-full border border-[#ddd] bg-white text-[16px] cursor-pointer flex items-center justify-center" @click="updateQty(item.id, item.qty + 1)">+</button>
          </div>
          <div class="text-[16px] font-bold text-[#222] w-20 text-right max-md:w-auto">${{ (item.price * item.qty).toFixed(2) }}</div>
          <button class="text-[13px] text-[#c00] bg-transparent border-0 cursor-pointer hover:underline shrink-0" @click="remove(item.id)">Remove</button>
        </div>
        <div class="flex justify-between items-center mt-6 max-md:flex-col max-md:gap-4">
          <div class="text-[20px] font-bold text-[#222]">Total: ${{ total.toFixed(2) }}</div>
          <div class="flex gap-3 max-md:w-full max-md:flex-col">
            <button class="px-6 py-3 border border-[#ddd] rounded-lg bg-white text-[14px] cursor-pointer max-md:text-center" @click="clear(); show('Cart cleared')">Clear cart</button>
            <router-link to="/checkout" class="px-6 py-3 bg-[#0a8a4a] text-white text-[14px] font-semibold rounded-lg border-0 cursor-pointer hover:bg-[#097a42] no-underline inline-block">Checkout</router-link>
          </div>
        </div>
      </div>
    </div>
    <FooterSection />
  </div>
</template>
