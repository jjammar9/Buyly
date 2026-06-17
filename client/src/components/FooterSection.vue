<script setup>
import BuylyLogo from '../assets/instacart-logo-color-6678cb82d531f8910d5ba270a11a7e9b56fc261371bda42ea7a5abeff3492e1c.svg'
</script>

<template>
  <footer class="bg-[#f7f5f0] border-t border-[#e0e0e0] mt-16">
    <div class="w-[71%] max-w-[1200px] mx-auto py-12">
      <div class="flex gap-10 mb-10 max-md:flex-col max-md:gap-6">
        <div class="flex-1">
          <h4 class="text-[15px] font-bold text-[#222] mb-4">Get to know us</h4>
          <ul class="list-none p-0 m-0 flex flex-col gap-2">
            <li><router-link to="/about" class="text-[13px] text-[#555] no-underline hover:underline">About</router-link></li>
            <li><router-link to="/careers" class="text-[13px] text-[#555] no-underline hover:underline">Careers</router-link></li>
            <li><router-link to="/blog" class="text-[13px] text-[#555] no-underline hover:underline">Blog</router-link></li>
            <li><router-link to="/press" class="text-[13px] text-[#555] no-underline hover:underline">Press</router-link></li>
          </ul>
        </div>
        <div class="flex-1">
          <h4 class="text-[15px] font-bold text-[#222] mb-4">More ways to shop</h4>
          <ul class="list-none p-0 m-0 flex flex-col gap-2">
            <li><router-link to="/gift-cards" class="text-[13px] text-[#555] no-underline hover:underline">Gift cards</router-link></li>
            <li><router-link to="/membership" class="text-[13px] text-[#555] no-underline hover:underline">Buyly+ membership</router-link></li>
            <li><router-link to="/coupons" class="text-[13px] text-[#555] no-underline hover:underline">Coupons & deals</router-link></li>
            <li><router-link to="/accessibility" class="text-[13px] text-[#555] no-underline hover:underline">Accessibility</router-link></li>
          </ul>
        </div>
      </div>
      <div class="pt-8 border-t border-[#e0e0e0]">
        <div class="flex items-center justify-between mb-6 max-md:flex-col max-md:gap-4">
          <img :src="BuylyLogo" alt="Buyly" class="h-6 block" />
          <div class="flex items-center gap-4">
            <a href="#" class="w-9 h-9 rounded-full bg-[#ddd] flex items-center justify-center text-[#555] text-[16px] font-bold no-underline hover:bg-[#ccc]">f</a>
            <a href="#" class="w-9 h-9 rounded-full bg-[#ddd] flex items-center justify-center text-[#555] text-[16px] font-bold no-underline hover:bg-[#ccc]">x</a>
            <a href="#" class="w-9 h-9 rounded-full bg-[#ddd] flex items-center justify-center text-[#555] text-[16px] font-bold no-underline hover:bg-[#ccc]">in</a>
            <a href="#" class="w-9 h-9 rounded-full bg-[#ddd] flex items-center justify-center text-[#555] text-[16px] font-bold no-underline hover:bg-[#ccc]">ig</a>
          </div>
        </div>
        <p class="text-[12px] text-[#888] m-0 text-center">&copy; 2026 Buyly. All rights reserved.</p>
      </div>
    </div>
  </footer>
</template>
