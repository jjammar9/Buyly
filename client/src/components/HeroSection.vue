<template>
  <section class="relative overflow-hidden min-h-[520px] mx-4 mt-4 mb-10 rounded-2xl flex items-center shadow-lg">
    <img alt="Hero" class="absolute inset-0 h-full w-full object-cover" src="https://images.unsplash.com/photo-1542838132-92c53300491e?w=1400&h=600&fit=crop" />
    <div class="absolute inset-0 bg-linear-to-r from-[#1a1a2e]/90 via-[#1a1a2e]/60 to-transparent"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 w-full">
      <div class="max-w-xl xl:pl-10">
        <span class="inline-flex items-center gap-1.5 px-4 py-1.5 text-xs font-semibold text-[#fb923c] bg-[#fb923c]/15 rounded-full mb-6 backdrop-blur-sm uppercase tracking-wider">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-3" aria-hidden="true"><path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"></path><path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"></path></svg>
          Farm-Fresh & Organic
        </span>
        <h1 class="text-4xl sm:text-5xl lg:text-6xl text-white leading-[1.15] mb-5 font-bold tracking-tight">Nourish your home with<br /><span class="text-[#fb923c]">Earth's finest</span></h1>
        <p class="text-[15px] sm:text-[16px] text-white/75 leading-relaxed mb-8 max-w-md">Fresh, organic groceries delivered from local farms to your doorstep. Quality you can taste, convenience you deserve.</p>
        <div class="flex flex-wrap gap-4">
          <router-link to="/catalog" class="group relative px-8 py-3.5 bg-[#fb923c] text-white font-semibold text-[15px] rounded-full hover:bg-[#f97316] transition-all flex items-center gap-2 overflow-hidden">
            <span class="relative z-10">Shop Now</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="size-4 relative z-10 transition-transform duration-200 group-hover:translate-x-1" aria-hidden="true"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
            <div class="absolute inset-0 bg-white/10 translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
          </router-link>
          <router-link to="/categories" class="px-8 py-3.5 text-white text-[15px] font-medium rounded-full border-2 border-white/30 hover:border-white/60 hover:bg-white/10 transition-all backdrop-blur-sm">Browse Categories</router-link>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
</script>
