<script setup>
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
          <div class="flex items-center gap-1.5">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="#166534" aria-hidden="true">
              <path d="M7 18c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59L5.25 14H19v-2H7.42l.94-2H17c.5 0 .95-.28 1.16-.72l3.42-6.99c.14-.29.13-.63-.03-.92A1 1 0 0 0 20.76 2H5.21L4.27 0H1zm6 14h12v-2H7l1.1-2h7.45l1.58-3H8.53L6.27 4H20.7l-2.8 5H8.53L7 16z"/>
            </svg>
            <span class="text-[22px] font-bold text-[#166534]">Buyly</span>
          </div>
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
