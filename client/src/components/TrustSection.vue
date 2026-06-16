<script setup>
const stats = [
  { title: '1 billion', subtitle: 'products', desc: 'available to shop across the catalog' },
  { title: '80,000', subtitle: 'stores', desc: 'from local grocers to chain stores' },
  { title: '14,000', subtitle: 'cities', desc: 'served across the U.S. & Canada' },
  { title: 'Millions of', subtitle: 'orders', desc: 'delivered or picked up yearly' },
]
</script>

<template>
  <section class="w-[71%] max-w-[1200px] mx-auto mt-[60px]">
    <h2 class="text-center text-[30px] font-bold text-[#222] mb-3">
      The largest online grocery marketplace in North America
    </h2>
    <p class="text-center text-[15px] text-[#555] mb-8 max-w-[600px] mx-auto">
      We connect you with thousands of local stores and deliver fresh groceries straight to your door.
    </p>

    <div class="w-full h-[500px] rounded-xl overflow-hidden bg-[#f0f0f0] mb-12">
      <img
        src="https://images.unsplash.com/photo-1542838132-92c53300491e?w=1200&h=700&fit=crop"
        alt="Grocery shopping"
        class="w-full h-full object-cover"
      />
    </div>

    <div class="flex gap-6">
      <div
        v-for="(stat, i) in stats"
        :key="i"
        class="flex-1 bg-[#f5f5f5] rounded-xl p-6 text-left"
      >
        <div class="text-[28px] font-bold text-[#222] leading-none">{{ stat.title }}<br />{{ stat.subtitle }}</div>
        <div class="text-[13px] text-[#222] mt-1.5">{{ stat.desc }}</div>
      </div>
    </div>
  </section>
</template>
