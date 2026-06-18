<script setup>
import { useCart } from '../stores/cart.js'
import NavBar from '../components/NavBar.vue'
import FooterSection from '../components/FooterSection.vue'

const { items, remove, updateQty, total, clear } = useCart()
</script>

<template>
  <div>
    <NavBar />
    <div class="w-[71%] max-w-[1200px] mx-auto mt-8 mb-16">
      <h1 class="text-[28px] font-bold text-[#222] mb-8">Cart</h1>
      <div v-if="items.length === 0" class="text-center py-16 text-[#888] text-[16px]">Your cart is empty.</div>
      <div v-else>
        <div v-for="item in items" :key="item.id" class="flex items-center gap-4 py-4 border-b border-[#eee]">
          <div class="flex-1">
            <div class="text-[16px] font-bold text-[#222]">{{ item.name }}</div>
            <div class="text-[13px] text-[#888]">{{ item.unit }}</div>
          </div>
          <div class="flex items-center gap-3">
            <button class="w-8 h-8 rounded-full border border-[#ddd] bg-white text-[16px] cursor-pointer" @click="updateQty(item.id, item.qty - 1)">-</button>
            <span class="text-[15px] font-semibold w-6 text-center">{{ item.qty }}</span>
            <button class="w-8 h-8 rounded-full border border-[#ddd] bg-white text-[16px] cursor-pointer" @click="updateQty(item.id, item.qty + 1)">+</button>
          </div>
          <div class="text-[16px] font-bold text-[#222] w-20 text-right">${{ (item.price * item.qty).toFixed(2) }}</div>
          <button class="text-[13px] text-[#c00] bg-transparent border-0 cursor-pointer hover:underline" @click="remove(item.id)">Remove</button>
        </div>
        <div class="flex justify-between items-center mt-6">
          <div class="text-[20px] font-bold text-[#222]">Total: ${{ total.toFixed(2) }}</div>
          <div class="flex gap-3">
            <button class="px-6 py-3 border border-[#ddd] rounded-lg bg-white text-[14px] cursor-pointer" @click="clear">Clear</button>
            <router-link to="/checkout" class="px-6 py-3 bg-[#0a8a4a] text-white text-[14px] font-semibold rounded-lg border-0 cursor-pointer hover:bg-[#097a42] no-underline inline-block">Checkout</router-link>
          </div>
        </div>
      </div>
    </div>
    <FooterSection />
  </div>
</template>
